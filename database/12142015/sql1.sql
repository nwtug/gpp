UPDATE `pss_v1`.`queries` SET `details` = 'SELECT P._organization_id AS pde_id, P.id AS procurement_plan_id, P.reference_number, P.title AS name, P.financial_year_start, P.financial_year_end, P.status, P.date_entered AS date_created, (SELECT name FROM organizations WHERE id=P._organization_id LIMIT 1) AS pde FROM procurement_plans P WHERE 1=1 _PDE_CONDITION_ _STATUS_CONDITION_ _PHRASE_CONDITION_ _YEAR_CONDITION_ _LIMIT_TEXT_ ' WHERE `queries`.`id` = 30;



UPDATE `pss_v1`.`queries` SET `details` = 'SELECT B.id AS bid_id, B.date_submitted, B.summary, B.bid_amount, B.bid_currency, B.final_contract_amount, B.final_amount_currency, B.valid_start_date, B.valid_end_date, B.status, B.last_updated, B._organization_id AS provider_id, B._tender_notice_id AS tender_id,  

(SELECT name FROM organizations WHERE id = B._organization_id LIMIT 1) AS provider, 

(SELECT O.name FROM tender_notices N LEFT JOIN organizations O ON (N._organization_id=O.id) WHERE N.id=B._tender_notice_id LIMIT 1) AS pde, 

(SELECT N._organization_id FROM tender_notices N WHERE N.id=B._tender_notice_id LIMIT 1) AS pde_id, 

(SELECT P.title FROM tender_notices N LEFT JOIN procurement_plans P ON (P.id=N._procurement_plan_id) WHERE N.id=B._tender_notice_id LIMIT 1) AS procurement_plan, 

(SELECT GROUP_CONCAT(document_url) FROM bid_documents WHERE _bid_id=B.id) AS documents, 

(SELECT name FROM tender_notices WHERE id = B._tender_notice_id LIMIT 1) AS tender_notice,

(SELECT method FROM tender_notices WHERE id = B._tender_notice_id LIMIT 1) AS procurement_method,

(SELECT type FROM tender_notices WHERE id = B._tender_notice_id LIMIT 1) AS procurement_type,



IFNULL((SELECT id FROM contracts WHERE _tender_id=B._tender_notice_id AND  _organization_id=B._organization_id LIMIT 1), 0) AS contract_id 

FROM bids B 

WHERE 1=1 _STATUS_CONDITION_ _PHRASE_CONDITION_ _PDE_CONDITION_ _PROCUREMENT_TYPE_CONDITION_  _PROCUREMENT_METHOD_CONDITION_ _PROVIDER_CONDITION_
ORDER BY last_updated DESC 
_LIMIT_TEXT_' WHERE `queries`.`id` = 31;



-- get contract list



UPDATE `pss_v1`.`queries` SET `details` = 'SELECT C.id AS contract_id, C._tender_id AS tender_id, C.name, C.contract_currency, C.contract_amount, C.progress_percent, C.date_started, C.status, C.last_updated,

(SELECT name FROM organizations WHERE id = C._organization_id LIMIT 1) AS provider, 

(SELECT O.name FROM tender_notices N LEFT JOIN organizations O ON (N._organization_id=O.id) WHERE N.id=C._tender_id LIMIT 1) AS pde,

(SELECT N._organization_id FROM tender_notices N WHERE N.id=C._tender_id LIMIT 1) AS pde_id,

(SELECT N.name FROM tender_notices N WHERE N.id=C._tender_id LIMIT 1) AS tender_notice,

IF((SELECT id FROM contract_status WHERE _contract_id=C.id LIMIT 1) IS NOT NULL, ''Y'', ''N'') AS has_notes,
(SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=C._last_updated_by LIMIT 1) AS last_updated_by

FROM contracts C 
INNER JOIN tender_notices T
ON C._tender_id = T.id

  WHERE 1=1 _TENDER_CONDITION_ _PDE_CONDITION_ _STATUS_CONDITION_ _OWNER_CONDITION_ _PHRASE_CONDITION_  _PROCUREMENT_TYPE_CONDITION_ _PROCUREMENT_METHOD_CONDITION_

 ORDER BY last_updated DESC 
 _LIMIT_TEXT_    ' WHERE `queries`.`id` = 53;
 
 