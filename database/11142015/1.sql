ALTER TABLE `organizations` ADD `status` ENUM( 'active', 'inactive', 'suspended' ) NOT NULL DEFAULT 'active' AFTER `date_entered` ;

ALTER TABLE `organizations` ADD FULLTEXT (`name`);

ALTER TABLE `tender_notices` ADD `method` VARCHAR( 250 ) NOT NULL AFTER `category` ;



