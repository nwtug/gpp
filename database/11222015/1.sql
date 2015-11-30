DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS project_status;
DROP TABLE IF EXISTS project_status_documents;



DROP TABLE IF EXISTS contracts;
CREATE TABLE IF NOT EXISTS contracts (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _tender_id bigint(20) NOT NULL,
  _organization_id bigint(20) NOT NULL,
  _pde_id bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  contract_currency varchar(10) NOT NULL,
  contract_amount float NOT NULL,
  progress_percent float NOT NULL,
  date_started date NOT NULL,
  `status` enum('saved','active','complete','terminated','archived') NOT NULL DEFAULT 'saved',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;




DROP TABLE IF EXISTS contract_status;
CREATE TABLE IF NOT EXISTS contract_status (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _contract_id bigint(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  document_urls varchar(300) NOT NULL,
  notes varchar(600) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;




ALTER TABLE `bids` ADD `_last_updated_by` BIGINT NOT NULL ;



