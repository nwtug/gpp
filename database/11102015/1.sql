DROP TABLE IF EXISTS activity_trail;
CREATE TABLE IF NOT EXISTS activity_trail (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _user_id bigint(20) NOT NULL,
  activity_code varchar(100) NOT NULL,
  result varchar(100) NOT NULL,
  uri varchar(300) NOT NULL,
  log_details text NOT NULL,
  ip_address varchar(100) NOT NULL,
  event_time datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

INSERT INTO activity_trail (id, _user_id, activity_code, result, uri, log_details, ip_address, event_time) VALUES
(1, 1, 'login', 'SUCCESS', 'account/login', 'username=azziwa@gmail.com|device=Other|browser=Firefox', '127.0.0.1', '2015-11-04 23:15:06'),
(2, 1, 'login', 'SUCCESS', 'account/login', 'username=azziwa@gmail.com|device=Other|browser=Firefox', '127.0.0.1', '2015-11-04 23:16:46'),
(3, 0, '', 'success', 'account/logout', '', '127.0.0.1', '2015-11-04 23:20:25'),
(4, 0, 'user_logout', 'success', 'account/logout', 'userid=|email=', '127.0.0.1', '2015-11-04 23:22:53'),
(5, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-04 23:23:11'),
(6, 1, 'user_logout', 'success', 'account/logout', 'userid=1|email=admin@pss.gov', '127.0.0.1', '2015-11-04 23:23:21'),
(7, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-05 07:25:31'),
(8, 1, 'user_logout', 'success', 'account/logout', 'userid=1|email=admin@pss.gov', '127.0.0.1', '2015-11-05 07:25:46'),
(9, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-05 07:37:19'),
(10, 1, 'user_logout', 'success', 'account/logout', 'userid=1|email=admin@pss.gov', '127.0.0.1', '2015-11-05 07:37:45'),
(11, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-05 07:37:55'),
(12, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-05 07:39:09'),
(13, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-05 07:39:39'),
(14, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-05 07:41:14'),
(15, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-05 07:42:06'),
(16, 1, 'user_logout', 'success', 'account/logout', 'userid=1|email=admin@pss.gov', '127.0.0.1', '2015-11-05 07:45:49'),
(17, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-05 07:46:34'),
(18, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-05 22:30:05'),
(19, 1, 'user_logout', 'success', 'account/logout', 'userid=1|email=admin@pss.gov', '127.0.0.1', '2015-11-05 22:30:33'),
(20, 0, 'user_logout', 'success', 'account/logout', 'userid=|email=', '127.0.0.1', '2015-11-05 23:05:02'),
(21, 1, 'login', 'SUCCESS', 'account/login', 'username=admin@pss.gov|device=Other|browser=Firefox', '127.0.0.1', '2015-11-06 20:53:13'),
(22, 1, 'user_logout', 'success', 'account/logout', 'userid=1|email=admin@pss.gov', '127.0.0.1', '2015-11-06 20:53:17'),
(23, 0, 'email__message_sent', 'SUCCESS', 'page/contact_us', 'message=Website Message Sent From Almond|sent_to=|sent_by= ()', '127.0.0.1', '2015-11-10 09:15:17'),
(24, 0, 'email__message_sent', 'SUCCESS', 'page/contact_us', 'message=Website Message Sent From Almond|sent_to=|sent_by=noreply@rssprocurement.org (Public Procurement Portal)', '127.0.0.1', '2015-11-10 09:16:41');

DROP TABLE IF EXISTS bids;
CREATE TABLE IF NOT EXISTS bids (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _organization_id bigint(20) NOT NULL,
  _submitted_by bigint(20) NOT NULL,
  _tender_notice_id bigint(20) NOT NULL,
  bid_amount float NOT NULL,
  summary text NOT NULL,
  valid_start_date date NOT NULL,
  valid_end_date date NOT NULL,
  `status` enum('saved','submitted','under_review','won','complete','archived') NOT NULL DEFAULT 'saved',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS bid_documents;
CREATE TABLE IF NOT EXISTS bid_documents (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _bid_id bigint(20) NOT NULL,
  document_url varchar(300) NOT NULL,
  description varchar(500) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS bid_status;
CREATE TABLE IF NOT EXISTS bid_status (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _bid_id bigint(20) NOT NULL,
  `status` varchar(100) NOT NULL,
  notes varchar(500) NOT NULL,
  end_date datetime NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS business_categories;
CREATE TABLE IF NOT EXISTS business_categories (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO business_categories (id, name) VALUES
(1, 'Arts, crafts, and collectibles'),
(2, 'Baby'),
(3, 'Beauty and fragrances'),
(4, 'Books and magazines'),
(5, 'Business to business'),
(6, 'Clothing, accessories, and shoes'),
(7, 'Computers, accessories, and services'),
(8, 'Education'),
(9, 'Electronics and telecom'),
(10, 'Entertainment and media'),
(11, 'Financial services and products'),
(12, 'Food retail and service'),
(13, 'Gifts and flowers'),
(14, 'Government'),
(15, 'Health and personal care'),
(16, 'Home and garden'),
(17, 'Nonprofit'),
(18, 'Pets and animals'),
(19, 'Religion and spirituality (for profit)'),
(20, 'Retail (not elsewhere classified)'),
(21, 'Services - other'),
(22, 'Sports and outdoors'),
(23, 'Toys and hobbies'),
(24, 'Travel'),
(25, 'Vehicle sales'),
(26, 'Vehicle service and accessories');

DROP TABLE IF EXISTS contacts;
CREATE TABLE IF NOT EXISTS contacts (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  contact_type varchar(100) NOT NULL,
  carrier_id varchar(100) NOT NULL,
  details varchar(300) NOT NULL,
  parent_id varchar(100) NOT NULL,
  parent_type varchar(100) NOT NULL,
  date_added datetime NOT NULL,
  is_primary enum('Y','N') NOT NULL DEFAULT 'Y',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS countries;
CREATE TABLE IF NOT EXISTS countries (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  short_code varchar(10) NOT NULL,
  display_order int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=257 ;

INSERT INTO countries (id, name, short_code, display_order) VALUES
(1, 'Aruba', 'ABW', 3),
(2, 'Afghanistan', 'AFG', 3),
(3, 'Angola', 'AGO', 3),
(4, 'Anguilla', 'AIA', 3),
(5, 'Albania', 'ALB', 3),
(6, 'Andorra', 'AND', 3),
(7, 'Netherlands Antilles', 'ANT', 3),
(8, 'United Arab Emirates', 'ARE', 3),
(9, 'Argentina', 'ARG', 3),
(10, 'Armenia', 'ARM', 3),
(11, 'American Samoa', 'ASM', 3),
(12, 'Antarctica', 'ATA', 3),
(13, 'French Southern territories', 'ATF', 3),
(14, 'Antigua and Barbuda', 'ATG', 3),
(15, 'Australia', 'AUS', 3),
(16, 'Austria', 'AUT', 3),
(17, 'Azerbaijan', 'AZE', 3),
(18, 'Burundi', 'BDI', 2),
(19, 'Belgium', 'BEL', 3),
(20, 'Benin', 'BEN', 3),
(21, 'Burkina Faso', 'BFA', 3),
(22, 'Bangladesh', 'BGD', 3),
(23, 'Bulgaria', 'BGR', 3),
(24, 'Bahrain', 'BHR', 3),
(25, 'Bahamas', 'BHS', 3),
(26, 'Bosnia and Herzegovina', 'BIH', 3),
(27, 'Belarus', 'BLR', 3),
(28, 'Belize', 'BLZ', 3),
(29, 'Bermuda', 'BMU', 3),
(30, 'Bolivia', 'BOL', 3),
(31, 'Brazil', 'BRA', 3),
(32, 'Barbados', 'BRB', 3),
(33, 'Brunei', 'BRN', 3),
(34, 'Bhutan', 'BTN', 3),
(35, 'Bouvet Island', 'BVT', 3),
(36, 'Botswana', 'BWA', 3),
(37, 'Central African Republic', 'CAF', 3),
(38, 'Canada', 'CAN', 3),
(39, 'Cocos (Keeling) Islands', 'CCK', 3),
(40, 'Switzerland', 'CHE', 3),
(41, 'Chile', 'CHL', 3),
(42, 'China', 'CHN', 3),
(43, 'Cte dIvoire', 'CIV', 3),
(44, 'Cameroon', 'CMR', 3),
(45, 'Congo, The Democratic Republic of the', 'COD', 2),
(46, 'Congo', 'COG', 3),
(47, 'Cook Islands', 'COK', 3),
(48, 'Colombia', 'COL', 3),
(49, 'Comoros', 'COM', 3),
(50, 'Cape Verde', 'CPV', 3),
(51, 'Costa Rica', 'CRI', 3),
(52, 'Cuba', 'CUB', 3),
(53, 'Christmas Island', 'CXR', 3),
(54, 'Cayman Islands', 'CYM', 3),
(55, 'Cyprus', 'CYP', 3),
(56, 'Czech Republic', 'CZE', 3),
(57, 'Germany', 'DEU', 3),
(58, 'Djibouti', 'DJI', 3),
(59, 'Dominica', 'DMA', 3),
(60, 'Denmark', 'DNK', 3),
(61, 'Dominican Republic', 'DOM', 3),
(62, 'Algeria', 'DZA', 3),
(63, 'Ecuador', 'ECU', 3),
(64, 'Egypt', 'EGY', 3),
(65, 'Eritrea', 'ERI', 3),
(66, 'Western Sahara', 'ESH', 3),
(67, 'Spain', 'ESP', 3),
(68, 'Estonia', 'EST', 3),
(69, 'Ethiopia', 'ETH', 2),
(70, 'Finland', 'FIN', 3),
(71, 'Fiji Islands', 'FJI', 3),
(72, 'Falkland Islands', 'FLK', 3),
(73, 'France', 'FRA', 3),
(74, 'Faroe Islands', 'FRO', 3),
(75, 'Micronesia, Federated States of', 'FSM', 3),
(76, 'Gabon', 'GAB', 3),
(77, 'United Kingdom', 'GBR', 3),
(78, 'Georgia', 'GEO', 3),
(79, 'Ghana', 'GHA', 3),
(80, 'Gibraltar', 'GIB', 3),
(81, 'Guinea', 'GIN', 3),
(82, 'Guadeloupe', 'GLP', 3),
(83, 'Gambia', 'GMB', 3),
(84, 'Guinea-Bissau', 'GNB', 3),
(85, 'Equatorial Guinea', 'GNQ', 3),
(86, 'Greece', 'GRC', 3),
(87, 'Grenada', 'GRD', 3),
(88, 'Greenland', 'GRL', 3),
(89, 'Guatemala', 'GTM', 3),
(90, 'French Guiana', 'GUF', 3),
(91, 'Guam', 'GUM', 3),
(92, 'Guyana', 'GUY', 3),
(93, 'Hong Kong', 'HKG', 3),
(94, 'Heard Island and McDonald Islands', 'HMD', 3),
(95, 'Honduras', 'HND', 3),
(96, 'Croatia', 'HRV', 3),
(97, 'Haiti', 'HTI', 3),
(98, 'Hungary', 'HUN', 3),
(99, 'Indonesia', 'IDN', 3),
(100, 'India', 'IND', 3),
(101, 'British Indian Ocean Territory', 'IOT', 3),
(102, 'Ireland', 'IRL', 3),
(103, 'Iran', 'IRN', 3),
(104, 'Iraq', 'IRQ', 3),
(105, 'Iceland', 'ISL', 3),
(106, 'Israel', 'ISR', 3),
(107, 'Italy', 'ITA', 3),
(108, 'Jamaica', 'JAM', 3),
(109, 'Jordan', 'JOR', 3),
(110, 'Japan', 'JPN', 3),
(111, 'Kazakstan', 'KAZ', 3),
(112, 'Kenya', 'KEN', 2),
(113, 'Kyrgyzstan', 'KGZ', 3),
(114, 'Cambodia', 'KHM', 3),
(115, 'Kiribati', 'KIR', 3),
(116, 'Saint Kitts and Nevis', 'KNA', 3),
(117, 'South Korea', 'KOR', 3),
(118, 'Kuwait', 'KWT', 3),
(119, 'Laos', 'LAO', 3),
(120, 'Lebanon', 'LBN', 3),
(121, 'Liberia', 'LBR', 3),
(122, 'Libyan Arab Jamahiriya', 'LBY', 3),
(123, 'Saint Lucia', 'LCA', 3),
(124, 'Liechtenstein', 'LIE', 3),
(125, 'Sri Lanka', 'LKA', 3),
(126, 'Lesotho', 'LSO', 3),
(127, 'Lithuania', 'LTU', 3),
(128, 'Luxembourg', 'LUX', 3),
(129, 'Latvia', 'LVA', 3),
(130, 'Macao', 'MAC', 3),
(131, 'Morocco', 'MAR', 3),
(132, 'Monaco', 'MCO', 3),
(133, 'Moldova', 'MDA', 3),
(134, 'Madagascar', 'MDG', 3),
(135, 'Maldives', 'MDV', 3),
(136, 'Mexico', 'MEX', 3),
(137, 'Marshall Islands', 'MHL', 3),
(138, 'Macedonia', 'MKD', 3),
(139, 'Mali', 'MLI', 3),
(140, 'Malta', 'MLT', 3),
(141, 'Myanmar', 'MMR', 3),
(142, 'Mongolia', 'MNG', 3),
(143, 'Northern Mariana Islands', 'MNP', 3),
(144, 'Mozambique', 'MOZ', 3),
(145, 'Mauritania', 'MRT', 3),
(146, 'Montserrat', 'MSR', 3),
(147, 'Martinique', 'MTQ', 3),
(148, 'Mauritius', 'MUS', 3),
(149, 'Malawi', 'MWI', 3),
(150, 'Malaysia', 'MYS', 3),
(151, 'Mayotte', 'MYT', 3),
(152, 'Namibia', 'NAM', 3),
(153, 'New Caledonia', 'NCL', 3),
(154, 'Niger', 'NER', 3),
(155, 'Norfolk Island', 'NFK', 3),
(156, 'Nigeria', 'NGA', 3),
(157, 'Nicaragua', 'NIC', 3),
(158, 'Niue', 'NIU', 3),
(159, 'Netherlands', 'NLD', 3),
(160, 'Norway', 'NOR', 3),
(161, 'Nepal', 'NPL', 3),
(162, 'Nauru', 'NRU', 3),
(163, 'New Zealand', 'NZL', 3),
(164, 'Oman', 'OMN', 3),
(165, 'Pakistan', 'PAK', 3),
(166, 'Panama', 'PAN', 3),
(167, 'Pitcairn', 'PCN', 3),
(168, 'Peru', 'PER', 3),
(169, 'Philippines', 'PHL', 3),
(170, 'Palau', 'PLW', 3),
(171, 'Papua New Guinea', 'PNG', 3),
(172, 'Poland', 'POL', 3),
(173, 'Puerto Rico', 'PRI', 3),
(174, 'North Korea', 'PRK', 3),
(175, 'Portugal', 'PRT', 3),
(176, 'Paraguay', 'PRY', 3),
(177, 'Palestine', 'PSE', 3),
(178, 'French Polynesia', 'PYF', 3),
(179, 'Qatar', 'QAT', 3),
(180, 'Runion', 'REU', 3),
(181, 'Romania', 'ROM', 3),
(182, 'Russian Federation', 'RUS', 3),
(183, 'Rwanda', 'RWA', 2),
(184, 'Saudi Arabia', 'SAU', 3),
(185, 'Sudan', 'SDN', 2),
(186, 'Senegal', 'SEN', 3),
(187, 'Singapore', 'SGP', 3),
(188, 'South Georgia and the South Sandwich Islands', 'SGS', 3),
(189, 'Saint Helena', 'SHN', 3),
(190, 'Svalbard and Jan Mayen', 'SJM', 3),
(191, 'Solomon Islands', 'SLB', 3),
(192, 'Sierra Leone', 'SLE', 3),
(193, 'El Salvador', 'SLV', 3),
(194, 'San Marino', 'SMR', 3),
(195, 'Somalia', 'SOM', 3),
(196, 'Saint Pierre and Miquelon', 'SPM', 3),
(197, 'Sao Tome and Principe', 'STP', 3),
(198, 'Suriname', 'SUR', 3),
(199, 'Slovakia', 'SVK', 3),
(200, 'Slovenia', 'SVN', 3),
(201, 'Sweden', 'SWE', 3),
(202, 'Swaziland', 'SWZ', 3),
(203, 'Seychelles', 'SYC', 3),
(204, 'Syria', 'SYR', 3),
(205, 'Turks and Caicos Islands', 'TCA', 3),
(206, 'Chad', 'TCD', 3),
(207, 'Togo', 'TGO', 3),
(208, 'Thailand', 'THA', 3),
(209, 'Tajikistan', 'TJK', 3),
(210, 'Tokelau', 'TKL', 3),
(211, 'Turkmenistan', 'TKM', 3),
(212, 'East Timor', 'TMP', 3),
(213, 'Tonga', 'TON', 3),
(214, 'Trinidad and Tobago', 'TTO', 3),
(215, 'Tunisia', 'TUN', 3),
(216, 'Turkey', 'TUR', 3),
(217, 'Tuvalu', 'TUV', 3),
(218, 'Taiwan', 'TWN', 3),
(219, 'Tanzania', 'TZA', 2),
(220, 'Uganda', 'UGA', 2),
(221, 'Ukraine', 'UKR', 3),
(222, 'United States Minor Outlying Islands', 'UMI', 3),
(223, 'Uruguay', 'URY', 3),
(224, 'United States', 'USA', 3),
(225, 'Uzbekistan', 'UZB', 3),
(226, 'Holy See (Vatican City State)', 'VAT', 3),
(227, 'Saint Vincent and the Grenadines', 'VCT', 3),
(228, 'Venezuela', 'VEN', 3),
(229, 'Virgin Islands, British', 'VGB', 3),
(230, 'Virgin Islands, U.S.', 'VIR', 3),
(231, 'Vietnam', 'VNM', 3),
(232, 'Vanuatu', 'VUT', 3),
(233, 'Wallis and Futuna', 'WLF', 3),
(234, 'Samoa', 'WSM', 3),
(235, 'Yemen', 'YEM', 3),
(236, 'Yugoslavia', 'YUG', 3),
(237, 'South Africa', 'ZAF', 3),
(238, 'Zambia', 'ZMB', 3),
(239, 'Zimbabwe', 'ZWE', 3),
(256, 'Republic of South Sudan', 'SSD', 1);

DROP TABLE IF EXISTS event_attendance;
CREATE TABLE IF NOT EXISTS event_attendance (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _event_id bigint(20) NOT NULL,
  _user_id bigint(20) NOT NULL,
  _organization_id bigint(20) NOT NULL,
  is_confirmed enum('Y','N') NOT NULL DEFAULT 'N',
  notes varchar(500) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS event_notifications;
CREATE TABLE IF NOT EXISTS event_notifications (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  description text NOT NULL,
  start_date datetime NOT NULL,
  end_date datetime NOT NULL,
  location varchar(300) NOT NULL,
  event_type varchar(200) NOT NULL,
  `status` enum('saved','published','active','archived') NOT NULL DEFAULT 'saved',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS experience;
CREATE TABLE IF NOT EXISTS experience (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _owner_organization_id bigint(20) NOT NULL,
  client_organization_name varchar(300) NOT NULL,
  client_rop_organization_id bigint(20) NOT NULL,
  project_title varchar(300) NOT NULL,
  project_details text NOT NULL,
  project_start_date datetime NOT NULL,
  project_end_date datetime NOT NULL,
  project_current_status varchar(100) NOT NULL DEFAULT 'pending',
  reference_link varchar(300) NOT NULL,
  reference_information varchar(500) NOT NULL,
  client_contact_telephone varchar(20) NOT NULL,
  _project_country_id bigint(20) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS faqs;
CREATE TABLE IF NOT EXISTS faqs (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  question varchar(300) NOT NULL,
  answer varchar(500) NOT NULL,
  number_of_views bigint(20) NOT NULL,
  document_url varchar(300) NOT NULL,
  `status` enum('submitted','active','archived') NOT NULL DEFAULT 'submitted',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS help;
CREATE TABLE IF NOT EXISTS `help` (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  help_code varchar(100) NOT NULL,
  title varchar(300) NOT NULL,
  details text NOT NULL,
  _entered_by bigint(20) DEFAULT NULL,
  is_active enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS lines_of_business;
CREATE TABLE IF NOT EXISTS lines_of_business (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _organization_id bigint(20) NOT NULL,
  _business_category_id bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS line_of_business_products;
CREATE TABLE IF NOT EXISTS line_of_business_products (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _business_line_id bigint(20) NOT NULL,
  _product_id bigint(20) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS message_exchange;
CREATE TABLE IF NOT EXISTS message_exchange (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _template_id bigint(20) DEFAULT NULL,
  details text NOT NULL,
  `subject` varchar(300) NOT NULL,
  attachment_url varchar(300) NOT NULL,
  _sender_id bigint(20) DEFAULT NULL,
  _recipient_id bigint(20) DEFAULT NULL,
  date_entered datetime NOT NULL,
  PRIMARY KEY (id),
  FULLTEXT KEY subject_index (`subject`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO message_exchange (id, _template_id, details, subject, attachment_url, _sender_id, _recipient_id, date_entered) VALUES
(1, 1, 'A message was sent from Almond on 10/Nov/2015 09:15AM. Details:\r\n&lt;BR&gt;&lt;BR&gt;\r\nNAME: Almond\r\nEMAIL: azziwa@gmail.com\r\nTELEPHONE: 7897354325\r\nSUBJECT: Can Not Find Document\r\n&lt;BR&gt;MESSAGE: This is a test\r\n&lt;BR&gt;&lt;BR&gt;\r\nRegards,\r\n&lt;BR&gt;&lt;BR&gt;\r\n_SITETITLE_\r\n&lt;BR&gt;http://www.rssprocurement.org\r\n&lt;BR&gt;MESSAGE ID: 2015111091516', 'Website Message Sent From Almond', '', 1, 1, '2015-11-10 09:15:16'),
(2, 1, 'A message was sent from Almond on 10/Nov/2015 09:16AM. Details:\r\n&lt;BR&gt;&lt;BR&gt;\r\nNAME: Almond\r\nEMAIL: azziwa@gmail.com\r\nTELEPHONE: 7897354325\r\nSUBJECT: Can Not Find Document\r\n&lt;BR&gt;MESSAGE: This is a test\r\n&lt;BR&gt;&lt;BR&gt;\r\nRegards,\r\n&lt;BR&gt;&lt;BR&gt;\r\n_SITETITLE_\r\n&lt;BR&gt;http://www.rssprocurement.org\r\n&lt;BR&gt;MESSAGE ID: 2015111091640', 'Website Message Sent From Almond', '', 1, 1, '2015-11-10 09:16:40');

DROP TABLE IF EXISTS message_status;
CREATE TABLE IF NOT EXISTS message_status (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _exchange_id bigint(20) DEFAULT NULL,
  _user_id bigint(20) DEFAULT NULL,
  `status` enum('received','read','replied','archived') NOT NULL DEFAULT 'received',
  date_entered datetime NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY _exchange_id (_exchange_id,_user_id,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS message_templates;
CREATE TABLE IF NOT EXISTS message_templates (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  message_type varchar(100) NOT NULL,
  `subject` varchar(300) NOT NULL,
  details text NOT NULL,
  sms varchar(160) NOT NULL,
  copy_admin enum('Y','N') NOT NULL DEFAULT 'N',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) DEFAULT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO message_templates (id, message_type, subject, details, sms, copy_admin, date_entered, _entered_by, last_updated, _last_updated_by) VALUES
(1, 'website_contact_message', 'Website Message Sent From _YOURNAME_', 'A message was sent from _YOURNAME_ on _SENDTIME_. Details:\r\n<BR><BR>\r\nNAME: _YOURNAME_\r\nEMAIL: _SENDEREMAILADDRESS_\r\nTELEPHONE: _SENDERTELEPHONE_\r\nSUBJECT: _MESSAGESUBJECT_\r\n<BR>MESSAGE: _MESSAGEDETAILS_\r\n<BR><BR>\r\nRegards,\r\n<BR><BR>\r\n_SITETITLE_\r\n<BR>_LOGINLINK_\r\n<BR>MESSAGE ID: _MESSAGEID_', 'A website message was sent from _YOURNAME_', 'Y', '2015-11-10 00:00:00', 1, '2015-11-10 00:00:00', 1);

DROP TABLE IF EXISTS ministries;
CREATE TABLE IF NOT EXISTS ministries (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

INSERT INTO ministries (id, name) VALUES
(1, 'Cabinet Affairs'),
(2, 'Defence and Veterans Affairs'),
(3, 'Justice'),
(4, 'Foreign Affairs and International Cooperation'),
(5, 'Office of the President'),
(6, 'National Security Service'),
(7, 'Interior & Wildlife Conservation'),
(8, 'Finance, Commerce and Economic Planning'),
(9, 'Labour, Public Service and Human Resource Management'),
(10, 'Health'),
(11, 'Information & Broadcasting'),
(12, 'Agriculture, Forestry, Tourism, Animal Resources and Fisheries'),
(13, 'Education, Science and Technology'),
(14, 'Housing'),
(15, 'Electricy & Dams'),
(16, 'Roads & Bridges'),
(17, 'Petroleum & Mining'),
(18, 'Environment'),
(19, 'Youth,Culture & Sports'),
(20, 'Gender'),
(21, 'Telecommunications');

DROP TABLE IF EXISTS organizations;
CREATE TABLE IF NOT EXISTS organizations (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  _owner_user_id bigint(20) NOT NULL,
  logo_url varchar(300) NOT NULL,
  description text NOT NULL,
  tax_id varchar(300) NOT NULL,
  registration_number varchar(300) NOT NULL,
  _registration_country_id bigint(20) NOT NULL,
  rop_number varchar(200) NOT NULL,
  rop_certificate_url varchar(200) NOT NULL,
  date_established date NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO organizations (id, name, _owner_user_id, logo_url, description, tax_id, registration_number, _registration_country_id, rop_number, rop_certificate_url, date_established, date_entered, _entered_by, last_updated, _last_updated_by) VALUES
(1, 'South Sudan Procurement', 1, '', 'The government of the republic of South Sudan.', 'T9098032423', '89R08982344', 256, '634523452345', '634523452345.pdf', '2010-11-30', '2015-11-04 00:00:00', 1, '2015-11-04 00:00:00', 1);

DROP TABLE IF EXISTS payment_status;
CREATE TABLE IF NOT EXISTS payment_status (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _user_id int(11) NOT NULL,
  payment_method varchar(100) NOT NULL,
  _payment_option bigint(20) NOT NULL,
  paid_amount float NOT NULL,
  payment_code varchar(300) NOT NULL,
  is_payment_waivered enum('Y','N') NOT NULL DEFAULT 'N',
  transaction_status enum('pending','complete','deleted') NOT NULL DEFAULT 'pending',
  transaction_start_date datetime NOT NULL,
  transaction_end_date datetime NOT NULL,
  date_entered datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS permissions;
CREATE TABLE IF NOT EXISTS permissions (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  display varchar(300) NOT NULL,
  details varchar(300) NOT NULL,
  category varchar(200) NOT NULL,
  url varchar(300) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (id),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO permissions (id, code, display, details, category, url, status) VALUES
(1, 'can_send_email', 'Can Send Email', '', '', '', 'active'),
(2, 'can_edit_users', 'Can Edit Users', '', '', 'user/edit', 'active');

DROP TABLE IF EXISTS permission_groups;
CREATE TABLE IF NOT EXISTS permission_groups (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `type` varchar(100) NOT NULL,
  notes text NOT NULL,
  _default_permission bigint(20) NOT NULL,
  is_removable enum('Y','N') NOT NULL DEFAULT 'Y',
  is_system_only enum('Y','N') NOT NULL DEFAULT 'N',
  date_added datetime NOT NULL,
  added_by varchar(100) NOT NULL,
  last_updated datetime NOT NULL,
  last_updated_by varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO permission_groups (id, name, type, notes, _default_permission, is_removable, is_system_only, date_added, added_by, last_updated, last_updated_by) VALUES
(1, 'Default Admin', 'admin', 'The default administrator group', 1, 'N', 'Y', '2015-11-04 00:00:00', '1', '2015-11-04 00:00:00', '1');

DROP TABLE IF EXISTS permission_group_mapping;
CREATE TABLE IF NOT EXISTS permission_group_mapping (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _group_id bigint(20) NOT NULL,
  _permission_id bigint(20) NOT NULL,
  date_added datetime NOT NULL,
  added_by varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO permission_group_mapping (id, _group_id, _permission_id, date_added, added_by) VALUES
(1, 1, 1, '2015-11-04 00:00:00', '1'),
(2, 1, 2, '2015-11-04 00:00:00', '1');

DROP TABLE IF EXISTS procurement_plans;
CREATE TABLE IF NOT EXISTS procurement_plans (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _organization_id bigint(20) NOT NULL,
  title varchar(300) NOT NULL,
  details text NOT NULL,
  document_url varchar(300) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  _business_category_id bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS projects;
CREATE TABLE IF NOT EXISTS projects (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _source_bid_id bigint(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  description text NOT NULL,
  _pde_contact_id bigint(20) NOT NULL,
  _contractor_contact_id bigint(20) NOT NULL,
  expected_start_date date NOT NULL,
  expected_end_date date NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS project_status;
CREATE TABLE IF NOT EXISTS project_status (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _project_id bigint(20) NOT NULL,
  `status` varchar(100) NOT NULL,
  notes varchar(500) NOT NULL,
  end_date datetime NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS project_status_documents;
CREATE TABLE IF NOT EXISTS project_status_documents (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _project_status_id bigint(20) NOT NULL,
  document_url varchar(300) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS queries;
CREATE TABLE IF NOT EXISTS queries (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(300) NOT NULL,
  details text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

INSERT INTO queries (id, code, details) VALUES
(1, 'add_event_log', 'INSERT INTO activity_trail (_user_id, activity_code, result, uri, log_details, ip_address, event_time)\nVALUES (''_USER_ID_'', ''_ACTIVITY_CODE_'', ''_RESULT_'', ''_URI_'', ''_LOG_DETAILS_'', ''_IP_ADDRESS_'', NOW())'),
(2, 'get_user_by_name_and_pass', 'SELECT id AS user_id, user_name, email_address, first_name  FROM users WHERE user_name=''_LOGIN_NAME_'' AND password=''_LOGIN_PASSWORD_'' AND status=''active'''),
(3, 'get_user_by_id', 'SELECT U.id, U.id AS user_id, U.first_name, U.last_name, U.email_address, U.email_verified, U.telephone, U._telephone_carrier_id AS carrier_id, U.photo_url, \n(SELECT carrier_name FROM telephone_carriers WHERE id=U._telephone_carrier_id LIMIT 1) AS telephone_carrier, \n(SELECT type FROM permission_groups WHERE id=U._permission_group_id LIMIT 1) AS group_type\n\nFROM users U \nWHERE id=''_USER_ID_'''),
(4, 'get_user_permissions', 'SELECT P.code AS permission_code FROM users U  \nLEFT JOIN permission_group_mapping PM ON (U._permission_group_id=PM._group_id) \nLEFT JOIN permissions P ON (PM._permission_id=P.id) \nWHERE U.id=''_USER_ID_'' AND P.code IS NOT NULL'),
(5, 'get_user_group_type', 'SELECT G.type AS group_type FROM users U \nLEFT JOIN permission_groups G ON (G.id=U._permission_group_id) \nWHERE U.id=''_USER_ID_'''),
(6, 'get_business_categories', 'SELECT * FROM business_categories'),
(7, 'get_countries_list', 'SELECT * FROM countries ORDER BY display_order ASC, name ASC'),
(8, 'get_secret_questions', 'SELECT * FROM secret_questions ORDER BY question ASC'),
(9, 'check_user_name', 'SELECT * FROM users WHERE user_name=''_USER_NAME_'''),
(10, 'get_government_ministries', 'SELECT * FROM ministries ORDER BY name'),
(11, 'get_best_evaluated_bidders', 'SELECT N.name AS notice_name, N.category, N.note, N.display_start_date AS posted_date, \n(SELECT name FROM organizations WHERE id=B._organization_id LIMIT 1) AS entity_name, \n(SELECT name FROM organizations WHERE id=B._submitted_by LIMIT 1) AS provider_name, \nN.deadline\n\nFROM bids B\nLEFT JOIN tender_notices N ON (B._tender_notice_id=N.id)\nLEFT JOIN bid_status BS ON (B.id=BS._bid_id AND BS.status=''won'')\n\nWHERE BS._bid_id IS NOT NULL \nORDER BY BS.date_entered DESC \n_LIMIT_TEXT_'),
(12, 'get_message_template', 'SELECT *, copy_admin AS copyadmin FROM message_templates WHERE message_type=''_MESSAGE_TYPE_'''),
(13, 'record_message_exchange', 'INSERT INTO message_exchange (_template_id, details, `subject`, attachment_url, _sender_id, _recipient_id, date_entered)\r\n\r\n(SELECT T.id AS _template_id, ''_DETAILS_'' AS details, ''_SUBJECT_'' AS `subject`, ''_ATTACHMENT_URL_'' AS attachment_url, \r\n''_SENDER_ID_'' AS _sender_id, \r\nU.id AS _recipient_id, NOW() AS date_entered\r\nFROM message_templates T LEFT JOIN users U ON (U.id IN (''_RECIPIENT_ID_'')) WHERE T.message_type=''_TEMPLATE_CODE_'')\r\n\r\nON DUPLICATE KEY UPDATE `subject`=VALUES(`subject`), details=VALUES(details), attachment_url=VALUES(attachment_url), date_entered=VALUES(date_entered)'),
(14, 'get_accounts_of_type', 'SELECT U.id AS _user_id FROM users U \r\nLEFT JOIN permission_groups G ON (U._permission_group_id=G.id) \r\nWHERE G.type=''_ACCOUNT_TYPE_'' \r\nGROUP BY U.id ');

DROP TABLE IF EXISTS registration_status_track;
CREATE TABLE IF NOT EXISTS registration_status_track (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _organization_id bigint(20) NOT NULL,
  `status` varchar(100) NOT NULL,
  reason varchar(500) NOT NULL,
  start_date datetime NOT NULL,
  end_date datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS secret_questions;
CREATE TABLE IF NOT EXISTS secret_questions (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  question varchar(500) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

INSERT INTO secret_questions (id, question) VALUES
(1, 'What was your childhood nickname?'),
(2, 'In what city did you meet your spouse/significant other?'),
(3, 'What is the name of your favorite childhood friend?'),
(4, 'What street did you live on when you were 10 years old?'),
(5, 'What is your oldest sibling''s birthday month and year? (e.g., January 1900)'),
(6, 'What is the middle name of your oldest child?'),
(7, 'What is your oldest cousin''s first and last name?'),
(8, 'In what city or town did your mother and father meet?'),
(9, 'What was the last name of your best childhood teacher?'),
(10, 'In what city does your nearest sibling live?'),
(11, 'What is your mother''s maiden name?'),
(12, 'In what city or town was your first job?'),
(13, 'What is the name of a college you first applied to?');

DROP TABLE IF EXISTS status_change_suggestion;
CREATE TABLE IF NOT EXISTS status_change_suggestion (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _organization_id bigint(20) NOT NULL,
  _suggesting_organization_id bigint(20) NOT NULL,
  _submitted_by bigint(20) NOT NULL,
  reason text NOT NULL,
  `status` varchar(100) NOT NULL,
  date_entered datetime NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS system_documents;
CREATE TABLE IF NOT EXISTS system_documents (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  document_url varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  description varchar(500) NOT NULL,
  document_type varchar(100) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS system_links;
CREATE TABLE IF NOT EXISTS system_links (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  link_url varchar(500) NOT NULL,
  description varchar(500) NOT NULL,
  link_type varchar(100) NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS telephone_carriers;
CREATE TABLE IF NOT EXISTS telephone_carriers (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  carrier_name varchar(100) NOT NULL,
  _country_id bigint(20) NOT NULL,
  carrier_logo_url varchar(200) NOT NULL,
  sms_email_domain varchar(250) NOT NULL,
  mms_email_domain varchar(250) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO telephone_carriers (id, carrier_name, _country_id, carrier_logo_url, sms_email_domain, mms_email_domain) VALUES
(1, 'MTN Uganda', 220, '', '', 'mms@mtn.co.ug'),
(2, 'Airtel Uganda', 220, '', '', 'mms@airtel.ug'),
(3, 'Uganda Telecom', 220, '', '', 'mms@utl.co.ug'),
(4, 'Africell Uganda', 220, '', '', 'mms@africell.ug'),
(5, 'Smile Telecom', 220, '', '', 'mms@smile.co.ug'),
(6, 'Sure Telecom', 220, '', '', 'mms@ug.smarteastafrica.com'),
(7, 'K2 Telecom', 220, '', '', 'mms@k2telecom.ug'),
(8, 'Smart Telecom', 220, '', '', 'mms@ug.smarteastafrica.com'),
(9, 'Vodafone Uganda', 220, '', '', 'mms@vodafone.ug');

DROP TABLE IF EXISTS tender_notices;
CREATE TABLE IF NOT EXISTS tender_notices (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  details text NOT NULL,
  category enum('works','services','supplies') NOT NULL,
  _organization_id bigint(20) NOT NULL,
  note varchar(300) NOT NULL,
  deadline date NOT NULL,
  display_start_date date NOT NULL,
  display_end_date date NOT NULL,
  `status` enum('pending','active','inactive') NOT NULL DEFAULT 'pending',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS turnover;
CREATE TABLE IF NOT EXISTS turnover (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _organization_id bigint(20) NOT NULL,
  financial_year varchar(10) NOT NULL,
  amount bigint(20) NOT NULL,
  is_verified enum('Y','N') NOT NULL DEFAULT 'N',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _organization_id bigint(20) NOT NULL,
  first_name varchar(300) NOT NULL,
  middle_name varchar(200) NOT NULL,
  last_name varchar(300) NOT NULL,
  position varchar(300) NOT NULL,
  gender enum('male','female','unknown') NOT NULL DEFAULT 'unknown',
  birthday date NOT NULL,
  email_address varchar(300) NOT NULL,
  telephone varchar(20) NOT NULL,
  _telephone_carrier_id bigint(20) NOT NULL,
  email_verified enum('Y','N') NOT NULL DEFAULT 'N',
  phone_verified enum('Y','N') NOT NULL DEFAULT 'N',
  photo_url varchar(300) NOT NULL,
  address_line_1 varchar(300) NOT NULL,
  address_line_2 varchar(300) NOT NULL,
  city varchar(300) NOT NULL,
  state varchar(250) NOT NULL,
  country varchar(300) NOT NULL,
  zipcode varchar(10) NOT NULL,
  user_name varchar(300) NOT NULL,
  `password` varchar(500) NOT NULL,
  _permission_group_id bigint(20) NOT NULL,
  secret_question varchar(500) NOT NULL,
  secret_answer varchar(200) NOT NULL,
  `status` enum('pending','active','inactive','deleted') NOT NULL DEFAULT 'pending',
  registration_start_date date NOT NULL,
  registration_end_date date NOT NULL,
  password_needs_reset enum('Y','N') NOT NULL DEFAULT 'N',
  activation_email_sent enum('Y','N') NOT NULL DEFAULT 'N',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email_address (email_address),
  FULLTEXT KEY first_name_index (first_name),
  FULLTEXT KEY last_name_index (last_name)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO users (id, _organization_id, first_name, middle_name, last_name, position, gender, birthday, email_address, telephone, _telephone_carrier_id, email_verified, phone_verified, photo_url, address_line_1, address_line_2, city, state, country, zipcode, user_name, password, _permission_group_id, secret_question, secret_answer, status, registration_start_date, registration_end_date, password_needs_reset, activation_email_sent, date_entered, _entered_by, last_updated, _last_updated_by) VALUES
(1, 1, 'John', 'S', 'Dolres', 'Minister', 'male', '1974-02-23', 'admin@pss.gov', '2324234233', 1, 'Y', 'N', '', '', '', '', '', '', '', 'admin@pss.gov', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1, 'Whats your first pet?', 'Parrot', 'active', '2015-09-08', '2016-05-31', 'N', 'N', '2015-11-04 00:00:00', 1, '2015-11-04 00:00:00', 1);
