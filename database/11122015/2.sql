
--
-- Table structure for table `tender_notice`
--

CREATE TABLE IF NOT EXISTS `tender_notice` (
`id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `_bussiness_category_id` bigint(20) NOT NULL,
  `_owner_organization_id` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `bidder_scope` text NOT NULL,
  `pre_notified_bidders` varchar(200) NOT NULL,
  `document_url` varchar(200) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `_entered_by` bigint(20) NOT NULL,
  `last_updated` date NOT NULL,
  `_last_updated_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




--
-- Table structure for table `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
`id` bigint(20) NOT NULL,
  `_organization_id` bigint(20) NOT NULL,
  `document_url` varchar(200) NOT NULL,
  `certificate_type` varchar(200) NOT NULL,
  `certificate_id` bigint(20) NOT NULL,
  `status` enum('active') NOT NULL,
  `valid_start_date` date NOT NULL,
  `valid_end_date` date NOT NULL,
  `date_entered` date NOT NULL,
  `_entered_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

