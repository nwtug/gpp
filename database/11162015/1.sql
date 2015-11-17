DROP TABLE IF EXISTS bids;
CREATE TABLE IF NOT EXISTS bids (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _organization_id bigint(20) NOT NULL,
  _submitted_by bigint(20) NOT NULL,
  date_submitted datetime NOT NULL,
  _tender_notice_id bigint(20) NOT NULL,
  bid_amount float NOT NULL,
  bid_currency varchar(10) NOT NULL,
  summary text NOT NULL,
  valid_start_date date NOT NULL,
  valid_end_date date NOT NULL,
  `status` enum('saved','submitted','under_review','won','complete','archived') NOT NULL DEFAULT 'saved',
  last_updated datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;




ALTER TABLE `bids` CHANGE `status` `status` ENUM( 'saved', 'submitted', 'under_review', 'won', 'awarded', 'complete', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';









