UPDATE `pss_v1`.`queries` SET `details` = 'SELECT B.id AS bid_id, B.date_submitted, B.summary, B.bid_amount, B.bid_currency, B.final_contract_amount, B.final_amount_currency, B.valid_start_date, B.valid_end_date, B.status, B.last_updated, B._organization_id AS provider_id, B._tender_notice_id AS tender_id,  

(SELECT name FROM organizations WHERE id = B._organization_id LIMIT 1) AS provider, 

(SELECT O.name FROM tender_notices N LEFT JOIN organizations O ON (N._organization_id=O.id) WHERE N.id=B._tender_notice_id LIMIT 1) AS pde, 

(SELECT N._organization_id FROM tender_notices N WHERE N.id=B._tender_notice_id LIMIT 1) AS pde_id, 

(SELECT CONCAT(P.title,'' '', DATE_FORMAT(P.financial_year_start, ''%Y''),''-'',DATE_FORMAT(P.financial_year_end, ''%Y'')) FROM tender_notices N LEFT JOIN procurement_plans P ON (P.id=N._procurement_plan_id) WHERE N.id=B._tender_notice_id LIMIT 1) AS procurement_plan, 

(SELECT GROUP_CONCAT(document_url) FROM bid_documents WHERE _bid_id=B.id) AS documents, 

(SELECT name FROM tender_notices WHERE id = B._tender_notice_id LIMIT 1) AS tender_notice,

(SELECT reference_number FROM tender_notices WHERE id = B._tender_notice_id LIMIT 1) AS reference_number,

IFNULL((SELECT id FROM contracts WHERE _tender_id=B._tender_notice_id AND  _organization_id=B._organization_id LIMIT 1), 0) AS contract_id 

FROM bids B 

WHERE 1=1 _PROVIDER_CONDITION_ _STATUS_CONDITION_ _PHRASE_CONDITION_ _PDE_CONDITION_ 
ORDER BY last_updated DESC 
_LIMIT_TEXT_' WHERE `queries`.`id` = 31;