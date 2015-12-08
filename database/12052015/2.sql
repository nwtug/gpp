DROP TABLE IF EXISTS suspension_reasons;
CREATE TABLE IF NOT EXISTS suspension_reasons (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _provider_id bigint(20) NOT NULL,
  expiry_date date NOT NULL,
  reason varchar(500) NOT NULL,
  date_entered bigint(20) NOT NULL,
  _entered_by int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



ALTER TABLE `tender_notices` DROP `source_of_funds` ;

ALTER TABLE `contracts` ADD `source_of_funds` VARCHAR( 300 ) NOT NULL AFTER `contract_amount` ;





