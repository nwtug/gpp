UPDATE `pss_v1`.`queries` SET `details` = 'SELECT C.id AS contract_id, C._tender_id AS tender_id, C.name, C.contract_currency, C.contract_amount, C.progress_percent, C.date_started, C.status, C.last_updated,

(SELECT name FROM organizations WHERE id = C._organization_id LIMIT 1) AS provider, 

(SELECT O.name FROM tender_notices N LEFT JOIN organizations O ON (N._organization_id=O.id) WHERE N.id=C._tender_id LIMIT 1) AS pde,

(SELECT N._organization_id FROM tender_notices N WHERE N.id=C._tender_id LIMIT 1) AS pde_id,

(SELECT N.name FROM tender_notices N WHERE N.id=C._tender_id LIMIT 1) AS tender_notice,

IF((SELECT id FROM contract_status WHERE _contract_id=C.id LIMIT 1) IS NOT NULL, ''Y'', ''N'') AS has_notes,

(SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=C._last_updated_by LIMIT 1) AS last_updated_by, 

IFNULL((SELECT DATE_FORMAT(CS.date_entered, ''%d/%m/%Y'') FROM contract_status CS 
WHERE CS._contract_id=C.id AND CS.status=''commenced'' ORDER BY CS.date_entered LIMIT 1), 
IFNULL((SELECT DATE_FORMAT(CS.date_entered, ''%d/%m/%Y'') FROM contract_status CS 
WHERE CS._contract_id=C.id AND CS.status=''active'' ORDER BY CS.date_entered LIMIT 1), '''')) AS date_commenced, 

IFNULL((SELECT DATE_FORMAT(CS.date_entered, ''%d/%m/%Y'') FROM contract_status CS 
WHERE CS._contract_id=C.id AND CS.status=''active'' ORDER BY CS.date_entered LIMIT 1), '''') AS date_signed

FROM contracts C 
WHERE 1=1 _TENDER_CONDITION_ _PDE_CONDITION_ _STATUS_CONDITION_ _OWNER_CONDITION_ _PHRASE_CONDITION_ 

ORDER BY last_updated DESC 
 _LIMIT_TEXT_' WHERE `queries`.`id` = 53;




INSERT INTO `pss_v1`.`queries` (`id`, `code`, `details`) VALUES (NULL, 'search_contract_awards', 'SELECT id AS contract_id, _tender_id AS tender_id, name

FROM contracts 
WHERE status IN (''active'',''complete'',''endorsed'',''commenced'') AND name LIKE ''%_PHRASE_%''
GROUP BY name 
ORDER BY last_updated DESC 
 _LIMIT_TEXT_');