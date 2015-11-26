ALTER TABLE `bids` ADD `final_contract_amount` FLOAT NOT NULL AFTER `bid_currency` ,
ADD `final_amount_currency` VARCHAR( 10 ) NOT NULL AFTER `final_contract_amount` ;



DROP TABLE IF EXISTS procurement_methods;
CREATE TABLE IF NOT EXISTS procurement_methods (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(400) NOT NULL,
  method varchar(400) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

INSERT INTO procurement_methods (id, code, method) VALUES
(1, 'open_competitive_tendering', 'Open Competitive Tendering'),
(2, 'two_stage_tendering', 'Two Stage Tendering'),
(3, 'selective_tendering', 'Selective Tendering'),
(4, 'request_for_quotations', 'Request for quotations'),
(5, 'single_sourcing_procurement', 'Single Sourcing Procurement'),
(6, 'national_competitive_tendering', 'National Competitive Tendering'),
(7, 'international_competitive_tendering', 'International Competitive Tendering');


ALTER TABLE `procurement_plans` ADD `status` ENUM( 'saved', 'published', 'archived' ) NOT NULL DEFAULT 'saved' AFTER `document_url` ;







