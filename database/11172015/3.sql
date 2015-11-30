ALTER TABLE `tender_notices` CHANGE `status` `status` ENUM( 'saved', 'published', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';

ALTER TABLE `procurement_plans` ADD FULLTEXT (`title`);




