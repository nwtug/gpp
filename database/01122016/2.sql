UPDATE `pss_v1`.`queries` SET `details` = 'SELECT T.id AS tender_id, T.name AS subject, T.reference_number, T.type AS procurement_type, (SELECT name FROM procurement_categories WHERE id=T._category_id LIMIT 1) AS  procurement_category, T.method AS procurement_method, T.deadline, T.display_start_date, T.display_end_date, T.status, T.date_entered AS date_created, T._procurement_plan_id AS plan_id, 

IFNULL((SELECT id FROM bids WHERE _tender_notice_id=T.id AND _organization_id=''_ORGANIZATION_ID_'' AND status IN (''submitted'',''under_review'',''won'',''awarded'',''complete'') LIMIT 1), '''') AS bid_id, 

IFNULL((SELECT status FROM bids WHERE _tender_notice_id=T.id AND _organization_id=''_ORGANIZATION_ID_'' LIMIT 1), '''') AS my_bid_status, 

IFNULL((SELECT id FROM bids WHERE _tender_notice_id=T.id AND _organization_id=''_ORGANIZATION_ID_'' AND status=''saved'' LIMIT 1), '''') AS draft_bid_id, 

(SELECT CONCAT(title,'' '', DATE_FORMAT(financial_year_start, ''%Y''),''-'',DATE_FORMAT(financial_year_end, ''%Y'')) FROM procurement_plans WHERE id=T._procurement_plan_id LIMIT 1) AS procurement_plan, 

(SELECT _organization_id FROM procurement_plans WHERE T._procurement_plan_id=id LIMIT 1) AS pde_id, 

(SELECT O.name FROM procurement_plans P LEFT JOIN organizations O ON (P._organization_id=O.id) WHERE T._procurement_plan_id=P.id LIMIT 1) AS pde, 

(SELECT COUNT(*) FROM bids WHERE _tender_notice_id=T.id) AS bid_count,

(SELECT COUNT(_provider_id) FROM tender_invitations WHERE _tender_id=T.id) AS invite_count

FROM tender_notices T 

WHERE 1=1 _DISPLAY_CONDITION_ _METHOD_CONDITION_ _TYPE_CONDITION_ _STATUS_CONDITION_ _OWNER_CONDITION_ _PHRASE_CONDITION_ _DEADLINE_CONDITION_ 
_PDE_CONDITION_ 
ORDER BY last_updated DESC 
_LIMIT_TEXT_ ' WHERE `queries`.`id` = 29;









UPDATE `pss_v1`.`queries` SET `details` = 'SELECT B.id AS bid_id, B.date_submitted, B.summary, B.bid_amount, B.bid_currency, B.final_contract_amount, B.final_amount_currency, B.valid_start_date, B.valid_end_date, B.status, B.last_updated, B._organization_id AS provider_id, B._tender_notice_id AS tender_id,  

(SELECT name FROM organizations WHERE id = B._organization_id LIMIT 1) AS provider, 

(SELECT O.name FROM tender_notices N LEFT JOIN organizations O ON (N._organization_id=O.id) WHERE N.id=B._tender_notice_id LIMIT 1) AS pde, 

(SELECT N._organization_id FROM tender_notices N WHERE N.id=B._tender_notice_id LIMIT 1) AS pde_id, 

(SELECT CONCAT(P.title,'' '', DATE_FORMAT(P.financial_year_start, ''%Y''),''-'',DATE_FORMAT(P.financial_year_end, ''%Y'')) FROM tender_notices N LEFT JOIN procurement_plans P ON (P.id=N._procurement_plan_id) WHERE N.id=B._tender_notice_id LIMIT 1) AS procurement_plan, 

(SELECT GROUP_CONCAT(document_url) FROM bid_documents WHERE _bid_id=B.id) AS documents, 

(SELECT name FROM tender_notices WHERE id = B._tender_notice_id LIMIT 1) AS tender_notice,

IFNULL((SELECT id FROM contracts WHERE _tender_id=B._tender_notice_id AND  _organization_id=B._organization_id LIMIT 1), 0) AS contract_id 

FROM bids B 

WHERE 1=1 _PROVIDER_CONDITION_ _STATUS_CONDITION_ _PHRASE_CONDITION_ _PDE_CONDITION_ 
ORDER BY last_updated DESC 
_LIMIT_TEXT_' WHERE `queries`.`id` = 31;








UPDATE `pss_v1`.`queries` SET `details` = 'SELECT B.id AS bid_id, B.date_submitted, B.summary, B.bid_amount, B.bid_currency, B.final_contract_amount, B.final_amount_currency, B.valid_start_date, B.valid_end_date, B.status, B.last_updated, B._organization_id AS provider_id, B._tender_notice_id AS tender_id, 

(SELECT name FROM organizations WHERE id = B._organization_id LIMIT 1) AS provider, 

(SELECT O.name FROM tender_notices N LEFT JOIN organizations O ON (N._organization_id=O.id) WHERE N.id=B._tender_notice_id LIMIT 1) AS pde, 

(SELECT N._organization_id FROM tender_notices N WHERE N.id=B._tender_notice_id LIMIT 1) AS pde_id, 

(SELECT CONCAT(P.title,'' '', DATE_FORMAT(P.financial_year_start, ''%Y''),''-'',DATE_FORMAT(P.financial_year_end, ''%Y'')) FROM tender_notices N LEFT JOIN procurement_plans P ON (P.id=N._procurement_plan_id) WHERE N.id=B._tender_notice_id LIMIT 1) AS procurement_plan, 

(SELECT name FROM tender_notices WHERE id = B._tender_notice_id LIMIT 1) AS tender_notice, 

(SELECT GROUP_CONCAT(document_url) FROM bid_documents WHERE _bid_id=B.id) AS documents, 

(SELECT GROUP_CONCAT(CONCAT(UPPER(status),'' ('',DATE_FORMAT(date_entered,''%d/%m/%Y''),'' TO '',IF(end_date <> ''0000-00-00'', DATE_FORMAT(end_date,''%d/%m/%Y''),''NOW''),'')'') SEPARATOR ''<BR>'') 
FROM bid_status WHERE _bid_id=B.id ORDER BY date_entered DESC) AS status_trail 

FROM bids B 

WHERE 1=1 _STATUS_CONDITION_
HAVING 1=1 _PDE_CONDITION_ _PHRASE_CONDITION_ 
ORDER BY B.last_updated DESC 
_LIMIT_TEXT_' WHERE `queries`.`id` = 43;










UPDATE `pss_v1`.`queries` SET `details` = 'SELECT id AS plan_id, CONCAT(''&#x25FE; '', (SELECT name FROM organizations WHERE id=P._organization_id LIMIT 1),'' ['', title,'' - '', DATE_FORMAT(financial_year_start,''%Y''),'' TO '',DATE_FORMAT(financial_year_end,''%Y''), '']'') AS name 
FROM procurement_plans P 
WHERE status=''published'' _ORGANIZATION_CONDITION_ 
HAVING name LIKE ''%_PHRASE_%'' 
_LIMIT_TEXT_' WHERE `queries`.`id` =35;








UPDATE `pss_v1`.`queries` SET `details` = 'SELECT N.id AS tender_id, N.name, N.reference_number, N._procurement_plan_id AS plan_id, N.subject_id, N.details AS description, N.type, (SELECT name FROM procurement_categories WHERE id=N._category_id LIMIT 1) AS category, N.method, N.document_url, N.deadline, N.display_start_date, N.display_end_date, N.status, N.date_entered, N.last_updated, 
(SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=N._entered_by LIMIT 1) AS entered_by, 
(SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=N._last_updated_by LIMIT 1) AS last_updated_by, 
(SELECT name FROM organizations WHERE id = N._organization_id LIMIT 1) AS pde, 
(SELECT CONCAT(title,'' '', DATE_FORMAT(financial_year_start, ''%Y''),''-'',DATE_FORMAT(financial_year_end, ''%Y'')) FROM procurement_plans WHERE id=N._procurement_plan_id LIMIT 1) AS procurement_plan, 
(SELECT B FROM procurement_plan_details WHERE id=N.subject_id LIMIT 1) AS subject

FROM tender_notices N 
WHERE N.id = ''_TENDER_ID_''' WHERE `queries`.`id` = 39;


UPDATE `pss_v1`.`queries` SET `details` = 'SELECT T.id AS tender_id, T.name AS subject, T.reference_number, T.type AS procurement_type, (SELECT name FROM procurement_categories WHERE id=T._category_id LIMIT 1) AS  procurement_category, T.method AS procurement_method, T.deadline, T.display_start_date, T.display_end_date, T.date_entered AS date_created, T._procurement_plan_id AS plan_id, 
IF(T.status=''published'',IF(T.method LIKE ''%_competitive%'', ''published'',''issued''), T.status) AS status, 

IFNULL((SELECT id FROM bids WHERE _tender_notice_id=T.id AND _organization_id=''_ORGANIZATION_ID_'' AND status IN (''submitted'',''under_review'',''won'',''awarded'',''complete'') LIMIT 1), '''') AS bid_id, 

IFNULL((SELECT status FROM bids WHERE _tender_notice_id=T.id AND _organization_id=''_ORGANIZATION_ID_'' LIMIT 1), '''') AS my_bid_status, 

IFNULL((SELECT id FROM bids WHERE _tender_notice_id=T.id AND _organization_id=''_ORGANIZATION_ID_'' AND status=''saved'' LIMIT 1), '''') AS draft_bid_id, 

(SELECT CONCAT(title,'' '', DATE_FORMAT(financial_year_start, ''%Y''),''-'',DATE_FORMAT(financial_year_end, ''%Y'')) FROM procurement_plans WHERE id=T._procurement_plan_id LIMIT 1) AS procurement_plan, 

(SELECT _organization_id FROM procurement_plans WHERE T._procurement_plan_id=id LIMIT 1) AS pde_id, 

(SELECT O.name FROM procurement_plans P LEFT JOIN organizations O ON (P._organization_id=O.id) WHERE T._procurement_plan_id=P.id LIMIT 1) AS pde, 

(SELECT COUNT(*) FROM bids WHERE _tender_notice_id=T.id) AS bid_count,

(SELECT COUNT(_provider_id) FROM tender_invitations WHERE _tender_id=T.id) AS invite_count

FROM tender_notices T 

WHERE 1=1 _DISPLAY_CONDITION_ _METHOD_CONDITION_ _TYPE_CONDITION_ _STATUS_CONDITION_ _OWNER_CONDITION_ _PHRASE_CONDITION_ _DEADLINE_CONDITION_ 
_PDE_CONDITION_ 
ORDER BY last_updated DESC 
_LIMIT_TEXT_ ' WHERE `queries`.`id` = 29;









UPDATE `pss_v1`.`queries` SET `details` = 'SELECT id AS subject_id, B AS name, C AS display_method 
FROM procurement_plan_details 
WHERE D <> '''' AND _plan_id=''_PLAN_ID_'' AND B LIKE ''%_PHRASE_%'' _LIMIT_TEXT_' WHERE `queries`.`id` =133;


















