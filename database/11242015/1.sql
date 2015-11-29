RENAME TABLE system_links TO links;

ALTER TABLE `documents` ADD `category` VARCHAR( 100 ) NOT NULL AFTER `document_type` ;
ALTER TABLE `documents` ADD `_entered_by_organization` BIGINT NOT NULL AFTER `_entered_by` ;
ALTER TABLE `documents` ADD `size` BIGINT NOT NULL AFTER `url` ;
ALTER TABLE `documents` ADD `status` ENUM( 'active', 'inactive' ) NOT NULL DEFAULT 'active' AFTER `parent_type` ;
ALTER TABLE `documents` ADD `last_updated` DATETIME NOT NULL , ADD `_last_updated_by` BIGINT NOT NULL ;



DROP TABLE IF EXISTS links;
CREATE TABLE IF NOT EXISTS links (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  url varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  open_type varchar(100) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  _entered_by_organization bigint(20) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS training;
CREATE TABLE IF NOT EXISTS training (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `subject` varchar(300) NOT NULL,
  category varchar(100) NOT NULL,
  description text NOT NULL,
  duration int(11) NOT NULL,
  event_time datetime NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  _entered_by_organization bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;














