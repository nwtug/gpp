DELIMITER $$
DROP PROCEDURE IF EXISTS `match_transactions_to_store_using_search`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `match_transactions_to_store_using_search`(IN raw_transaction_ids TEXT)
    READS SQL DATA
BEGIN

	-- The variables to be tested before matching a transaction
	DECLARE r_id, r_payee_name, r_address, r_city, r_state, r_zipcode, r_user_id VARCHAR(255);
    DECLARE matched_eol BOOLEAN;
    DECLARE matched_cursor CURSOR FOR SELECT DISTINCT id, payee_name, address, city, state, zipcode, _user_id FROM transactions_raw WHERE raw_transaction_ids LIKE id 
	OR raw_transaction_ids LIKE CONCAT(id,',%') OR raw_transaction_ids LIKE CONCAT('%,', id,',%') OR raw_transaction_ids LIKE CONCAT('%,', id);

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET matched_eol = TRUE;


	-- Now match the stores from the rules
    OPEN matched_cursor;
    matched_loop_handle: LOOP
        FETCH matched_cursor INTO r_id, r_payee_name, r_address, r_city, r_state, r_zipcode, r_user_id;

		IF matched_eol THEN 
            CLOSE matched_cursor;
            LEAVE matched_loop_handle;
        END IF;

		-- Add the matched history
		SET @match_sql := CONCAT("INSERT INTO match_history_stores (attempted_by, _matched_store_id, _raw_transaction_id, _transaction_id, _rule_id, confidence, match_result, attempt_date) ",
									"(SELECT 'system' AS attempted_by, store_id AS _matched_store_id, '",r_id,"' AS _raw_transaction_id, (SELECT id FROM transactions WHERE _raw_id='",r_id,"' LIMIT 1) AS _transaction_id, ",
									"'0' AS _rule_id, M.confidence, 'auto_matched' AS match_result, NOW() AS attempt_date ",
									"FROM temp__",r_user_id,"_stores M WHERE '",r_payee_name,"' LIKE CONCAT(search_name,'%') AND zipcode='",r_zipcode,"' AND '",r_address,"' LIKE CONCAT(search_address,'%') )");                                
		PREPARE match_stmt FROM @match_sql;                                
		EXECUTE match_stmt;  
		DEALLOCATE PREPARE match_stmt;

		-- Update the transaction as automatched
		SET @store_record_sql := CONCAT("UPDATE transactions T, (SELECT S.store_id FROM temp__",r_user_id,"_stores S ",
								"LEFT JOIN transactions_raw R ON (R.id='",r_id,"' AND '",r_payee_name,"' LIKE CONCAT(S.search_name,'%') AND S.zipcode='",r_zipcode,"' AND '",r_address,"' LIKE CONCAT(S.search_address,'%') LIMIT 1) SR ",
								"SET T._store_id=SR.store_id, T.match_status='auto_matched' WHERE T._raw_id='",r_id,"' AND SR.store_id IS NOT NULL");                                
		PREPARE store_record_stmt FROM @store_record_sql;                                
		EXECUTE store_record_stmt;  
		DEALLOCATE PREPARE store_record_stmt;

		 

    END LOOP matched_loop_handle;


END$$
DELIMITER ;