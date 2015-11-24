-- GET CONTRACTS LIST --

INSERT INTO `pss_v1`.`queries` (`id`, `code`, `details`) VALUES (NULL, 'get_contracts_list', 'SELECT 
  C.id AS contract_id,  
  C.contract_currency , 
  C.contract_amount,
  C.progress_percent ,
  C.date_started,
  C.status,
  C.date_entered,
  B.valid_end_date,
  N.id AS tender_id,
  N.name, N.details AS description,
  N.category AS type, N.method,
  N.document_url, N.deadline,
  N.display_start_date,
  N.display_end_date, N.status,
  N.date_entered,
  N.last_updated, 
  PP.title AS procurement_plan,
  PP.financial_year_start,
  PP.financial_year_end,
  (SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=C._entered_by LIMIT 1) AS entered_by, 
  (SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=C._last_updated_by LIMIT 1) AS last_updated_by, 
  (SELECT name FROM organizations WHERE id = C._pde_id LIMIT 1) AS pde,
  (SELECT name FROM organizations WHERE id = C._organization_id LIMIT 1) AS provider
  
    
FROM contracts C
INNER JOIN   bids B
ON C._tender_id = B.id
INNER JOIN  tender_notices N 
ON B._tender_notice_id = N.id
INNER JOIN procurement_plans PP
ON N._procurement_plan_id = PP.id
INNER JOIN organizations ORG 
ON pp._organization_id  = ORG.id

C.status like =''_STATUS_''
'


  ORDER BY _ORDERBY_
  _LIMIT_TEXT_ 
  );




-- PROCUREMENT PLANS LIST --

INSERT INTO `pss_v1`.`queries` (`id`, `code`, `details`) VALUES (NULL, 'procurement_plans_list', '  SELECT 
  PP.financial_year_start,
  PP.financial_year_end,
  PP.title,
  PP.document_url,
  PP.details,
  PP.date_entered,
  PP._entered_by,
  PP.last_updated,
  PP._last_updated_by,
  CONCAT(users.first_name,'' '', users.middle_name,users.last_name) AS entereb_by_names
 
  FROM procurement_plans PP
  INNER JOIN organizations ORG
  ON PP._organization_id = ORG.id
  INNER JOIN users ON ORG._entered_by = users.id
  
  WHERE _SEARCHSTRING_'
  
  ORDER BY _ORDERBY_
  _LIMIT_TEXT_ );
  
  -- FETCH BEST EVALUATED BIDDERS -- 
  
  INSERT INTO `pss_v1`.`queries` (`id`, `code`, `details`) VALUES (NULL, 'get_bestevaluated_bidders', 'SELECT 
  
  B.id AS bid_id,  
  B.bid_amount , 
  B.bid_currency,
  B.date_submitted ,
  B.final_contract_amount,
  B.final_amount_currency,
  B.valid_start_date,
  B.valid_end_date,
  N.id AS tender_id,
  N.name, N.details AS description,
  N.category AS type, N.method,
  N.document_url, N.deadline,
  N.display_start_date,
  N.display_end_date, N.status,
  N.date_entered,
  N.last_updated, 
  PP.title AS procurement_plan,
  PP.financial_year_start,
  PP.financial_year_end,
(SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=B._submitted_by LIMIT 1) AS submitted_by, 
(SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=B._last_updated_by LIMIT 1) AS last_updated_by, 
(SELECT name FROM organizations WHERE id = N._organization_id LIMIT 1) AS pde,
(SELECT name FROM organizations WHERE id = B._organization_id LIMIT 1) AS provider

  
FROM bids B
  INNER JOIN  tender_notices N 
  ON B._tender_notice_id = N.id
INNER JOIN procurement_plans PP
ON N._procurement_plan_id = PP.id
INNER JOIN organizations ORG 
ON pp._organization_id  = ORG.id
 
  WHERE b.status LIKE ''_STATUS_''
  _SEARCHSTRING_'
  
   ORDER BY _ORDERBY_
  _LIMIT_TEXT_
  );