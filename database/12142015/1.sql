ALTER TABLE `tender_notices` ADD `subject_id` BIGINT NOT NULL AFTER `name` ;

ALTER TABLE `tender_notices` CHANGE `status` `status` ENUM( 'saved', 'cancelled', 'extended', 'published', 'complete', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';


ALTER TABLE `tender_notices` CHANGE `deadline` `deadline` DATETIME NOT NULL ;


