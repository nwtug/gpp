ALTER TABLE `tender_notices` ADD `reference_number` VARCHAR( 300 ) NOT NULL AFTER `name` ;
ALTER TABLE `procurement_plans` DROP `reference_number` ;

ALTER TABLE `tender_notices` ADD `source_of_funds` VARCHAR( 300 ) NOT NULL AFTER `reference_number` ;
ALTER TABLE `contracts` CHANGE `status` `status` ENUM( 'saved', 'active', 'endorsed','cancelled', 'commenced', 'complete', 'terminated', 'final_payment', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';


ALTER TABLE `contract_status` ADD `amount_paid` BIGINT NOT NULL AFTER `amount_spent` ;
ALTER TABLE `tender_notices` CHANGE `type` `type` ENUM( 'works', 'services', 'goods' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;

