
--
-- Table structure for table `queries`
--

CREATE TABLE IF NOT EXISTS `queries` (
`id` bigint(20) NOT NULL,
  `code` varchar(300) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`code`, `details`)
 
 VALUES
( 
  'get_procurement_plans', 
  'SELECT \r\n  PP.title,\r\n  PP.document_url,\r\n  PP.details,\r\n  PP.date_entered,\r\n  PP._entered_by,\r\n  PP.last_updated,\r\n  PP._last_updated_by,\r\n  ORG.name,\r\n  ORG.logo_url,\r\n  ORG._owner_user_id ,\r\n (SELECT CONCAT(users.first_name, users.middle_name,users.last_name ) FROM users   WHERE users._organization_id = ORG'),
( 'get_providers',
  '  SELECT\r\n  ORG.name,\r\n  ORG.logo_url,\r\n  ORG.description,\r\n  ORG.tax_id,\r\n  ORG.registration_number,\r\n  ORG._category_id,\r\n  ORG._registration_country_id,\r\n  (SELECT COUNT(*) FROM bids WHERE bids._organization_id = ORG.id) AS num_bids_submited,\r\n  RST.status as ORG_STATUS,\r\n  RST.start_date,\r\n  RST.end_date\r\n  \r\n  FROM organizations ORG\r\n\r\n  LEFT OUTER  JOIN bids  \r\n  ON ORG.id = bids._organization_id\r\n\r\n  LEFT OUTER JOIN registration_status_track RST\r\n  \r\n  ON ORG.id = RST._organization_id\r\n\r\n  WHERE RST.status =''_STATUS_''\r\n\r\n  AND  ( ''_DATE_'' BETWEEN RST.start_date AND RST.end_date )\r\n\r\n  _SEARCHSTRING_\r\n\r\n  ORDER BY _ORDERBY_\r\n\r\n  _LIMIT_TEXT_\r\n\r\n\r\n'),
('get_certificate',   
  '  SELECT \r\n  CE.document_url,\r\n  CE.status,\r\n  CE.certificate_type,\r\n  CE.certificate_id,\r\n  ORG.name,\r\n  ORG._owner_user_id,\r\n  ORG.registration_number,\r\n  ORG.tax_id\r\n  FROM certificate CE\r\n  INNER JOIN organizations ORG\r\n  ON CE._organization_id = ORG.id\r\n\r\n  WHERE \r\n\r\n  _SEARCHSTRING_\r\n')
('get_user',
  'SELECT * FROM users WHERE _SEARCHSTRING_');


