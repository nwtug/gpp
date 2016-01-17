UPDATE `pss_v1`.`queries` SET `details` = 'INSERT INTO training (subject, category, description, duration, event_time, venue, url, documents, date_entered, _entered_by, _entered_by_organization, last_updated, _last_updated_by) 
VALUES 
(''_SUBJECT_'', ''_CATEGORY_'', ''_DESCRIPTION_'', ''_DURATION_'', ''_EVENT_TIME_'', ''_VENUE_'', ''_URL_'', ''_DOCUMENTS_'', NOW(), ''_USER_ID_'', ''_ORGANIZATION_ID_'', NOW(), ''_USER_ID_'')' WHERE `queries`.`id` =69;


UPDATE `pss_v1`.`queries` SET `details` = 'SELECT id AS training_id, subject, category, description, duration, event_time, venue, url, documents, date_entered, status, 
(SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=T._entered_by LIMIT 1) AS entered_by, 
(SELECT name FROM organizations WHERE id=T._entered_by_organization LIMIT 1) AS entered_by_organization

FROM training T WHERE 1=1 _PHRASE_CONDITION_ _STATUS_CONDITION_ _CATEGORY_CONDITION_ _OWNER_CONDITION_ 
ORDER BY status ASC, date_entered DESC 
_LIMIT_TEXT_' WHERE `queries`.`id` =68;




ALTER TABLE `training` ADD `venue` VARCHAR( 200 ) NOT NULL AFTER `event_time` ,
ADD `url` VARCHAR( 500 ) NOT NULL AFTER `venue` ,
ADD `documents` TEXT NOT NULL AFTER `url` ;

