
DROP TABLE IF EXISTS bid_evaluation_reasons;
CREATE TABLE IF NOT EXISTS bid_evaluation_reasons (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _tender_notice_id bigint(20) NOT NULL,
  _bid_id bigint(20) NOT NULL,
  reason varchar(500) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY _bid_id (_bid_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


ALTER TABLE `bid_evaluation_reasons` ADD UNIQUE (
`_bid_id`
);




ALTER TABLE `tender_notices` ADD `winner_bid_price` FLOAT NOT NULL AFTER `budget_amount` ,
ADD `winner_bid_currency` VARCHAR( 10 ) NOT NULL AFTER `winner_bid_price` ;


ALTER TABLE `tender_notices` 
CHANGE `document_url` `document_url` VARCHAR( 500 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;










