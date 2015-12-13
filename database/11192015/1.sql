UPDATE `pss`.`organizations` SET `_category_id` = '0',`name` = 'Ministry of Education, Science and Technology', `_ministry_id` = '13' WHERE `organizations`.`id` =2;

ALTER TABLE `tender_notices` CHANGE `note` `document_url` VARCHAR( 300 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;

ALTER TABLE `tender_notices` ADD `last_updated` DATETIME NOT NULL ,
ADD `_last_updated_by` BIGINT NOT NULL ;







