DROP TABLE IF EXISTS forum_comments;
CREATE TABLE IF NOT EXISTS forum_comments (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _forum_id bigint(20) NOT NULL,
  `comment` varchar(500) NOT NULL,
  _responding_to bigint(20) NOT NULL,
  date_added datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


ALTER TABLE `organizations` ADD `registration_fee` BIGINT NOT NULL AFTER `rop_certificate_url` ,
ADD `expiry_date` DATE NOT NULL AFTER `registration_fee` ;

`ALTER TABLE bid_status DROP INDEX _bid_id;`








