ALTER TABLE `tender_notices` ADD `_procurement_plan_id` BIGINT NOT NULL AFTER `_organization_id` ;


ALTER TABLE `procurement_plans` ADD `financial_year_start` DATE NOT NULL AFTER `_organization_id` ,
ADD `financial_year_end` DATE NOT NULL AFTER `financial_year_start` ;


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
  _category_id bigint(20) NOT NULL,
  _ministry_id bigint(20) NOT NULL,
  rop_number varchar(200) NOT NULL,
  rop_certificate_url varchar(200) NOT NULL,
  contact_address varchar(500) NOT NULL,
  contact_city varchar(200) NOT NULL,
  contact_region varchar(200) NOT NULL,
  contact_zipcode varchar(10) NOT NULL,
  contact_country_id bigint(20) NOT NULL,
  date_established date NOT NULL,
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  last_updated datetime NOT NULL,
  _last_updated_by bigint(20) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY `name` (`name`,tax_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO organizations (id, name, _owner_user_id, logo_url, description, tax_id, registration_number, _registration_country_id, _category_id, _ministry_id, rop_number, rop_certificate_url, contact_address, contact_city, contact_region, contact_zipcode, contact_country_id, date_established, date_entered, _entered_by, last_updated, _last_updated_by) VALUES
(1, 'South Sudan Procurement', 1, '', 'The government of the republic of South Sudan.', 'T9098032423', '89R08982344', 256, 0, 0, '634523452345', '634523452345.pdf', '', '', '', '', 0, '2010-11-30', '2015-11-04 00:00:00', 1, '2015-11-04 00:00:00', 1),
(2, 'Tinga Ltd.', 2, '', 'We supply education materials.', '', '', 220, 8, 0, '', '', '34 Regan Str', 'Moroto', 'Moroto', '256', 220, '0000-00-00', '2015-11-11 10:06:20', 2, '2015-11-11 10:13:59', 2),
(10, 'General Supply Ltd', 10, '', 'We supply road construction material.', '', '', 256, 16, 0, '', '', 'Plot 345 Tinga Str', 'Moto', 'South Moto', '234', 256, '0000-00-00', '2015-11-11 23:38:55', 10, '2015-11-11 23:38:55', 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO permissions (id, code, display, details, category, url, status) VALUES
(1, 'can_send_email', 'Can Send Email', '', '', '', 'active'),
(2, 'can_edit_users', 'Can Edit Users', '', '', 'user/edit', 'active'),
(3, 'can_submit_bids', 'Can Submit Bids', '', 'bids', 'bids/add', 'active'),
(4, 'can_submit_tenders', 'Can Submit Tenders', '', 'tenders', 'tenders/add', 'active');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO permission_groups (id, name, type, notes, _default_permission, is_removable, is_system_only, date_added, added_by, last_updated, last_updated_by) VALUES
(1, 'Default Admin', 'admin', 'The default administrator group', 1, 'N', 'Y', '2015-11-04 00:00:00', '1', '2015-11-04 00:00:00', '1'),
(2, 'Default Provider', 'provider', 'The default Provider group', 3, 'N', 'Y', '2015-11-11 00:00:00', '1', '2015-11-11 00:00:00', '1'),
(3, 'Default PDE', 'pde', 'Default PDE permission group', 4, 'N', 'Y', '2015-11-11 00:00:00', '1', '2015-11-11 00:00:00', '1');

DROP TABLE IF EXISTS permission_group_mapping;
CREATE TABLE IF NOT EXISTS permission_group_mapping (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _group_id bigint(20) NOT NULL,
  _permission_id bigint(20) NOT NULL,
  date_added datetime NOT NULL,
  added_by varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO permission_group_mapping (id, _group_id, _permission_id, date_added, added_by) VALUES
(1, 1, 1, '2015-11-04 00:00:00', '1'),
(2, 1, 2, '2015-11-04 00:00:00', '1'),
(3, 2, 3, '2015-11-11 00:00:00', '1'),
(4, 3, 4, '2015-11-11 00:00:00', '1');

DROP TABLE IF EXISTS queries;
CREATE TABLE IF NOT EXISTS queries (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(300) NOT NULL,
  details text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

INSERT INTO queries (id, code, details) VALUES
(1, 'add_event_log', 'INSERT INTO activity_trail (_user_id, activity_code, result, uri, log_details, ip_address, event_time)\nVALUES (''_USER_ID_'', ''_ACTIVITY_CODE_'', ''_RESULT_'', ''_URI_'', ''_LOG_DETAILS_'', ''_IP_ADDRESS_'', NOW())'),
(2, 'get_user_by_name_and_pass', 'SELECT id AS user_id, user_name, email_address, first_name  FROM users WHERE user_name=''_LOGIN_NAME_'' AND password=''_LOGIN_PASSWORD_'' AND status=''active'''),
(3, 'get_user_by_id', 'SELECT U.id, U.user_name, U.id AS user_id, U.first_name, U.last_name, U.email_address, U.email_verified, U.telephone, U._telephone_carrier_id AS carrier_id, U.photo_url, \n(SELECT carrier_name FROM telephone_carriers WHERE id=U._telephone_carrier_id LIMIT 1) AS telephone_carrier, \n(SELECT type FROM permission_groups WHERE id=U._permission_group_id LIMIT 1) AS group_type\n\nFROM users U \nWHERE id=''_USER_ID_'''),
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
(14, 'get_accounts_of_type', 'SELECT U.id AS _user_id FROM users U \r\nLEFT JOIN permission_groups G ON (U._permission_group_id=G.id) \r\nWHERE G.type=''_ACCOUNT_TYPE_'' \r\nGROUP BY U.id '),
(15, 'save_temp_organization', 'INSERT INTO organizations (name, description, _owner_user_id,  _registration_country_id, registration_number, tax_id, _category_id, _ministry_id, date_established, date_entered, _entered_by, last_updated, _last_updated_by) VALUES \n(''_NAME_'', ''_DESCRIPTION_'', ''_USER_ID_'', ''_REGISTRATION_COUNTRY_ID_'', ''_REGISTRATION_NUMBER_'', ''_TAX_ID_'', ''_CATEGORY_ID_'', ''_MINISTRY_ID_'', ''_DATE_ESTABLISHED_'', NOW(), ''_USER_ID_'', NOW(), ''_USER_ID_'')\n\nON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id), _registration_country_id=VALUES(_registration_country_id), registration_number=VALUES(registration_number),_category_id=VALUES(_category_id), _ministry_id=VALUES(_ministry_id), date_established=VALUES(date_established), last_updated=NOW(), _last_updated_by=''_USER_ID_'''),
(16, 'save_temp_user', 'INSERT INTO users (email_address, telephone, country, user_name, password, secret_answer, secret_question, date_entered, last_updated) \n(SELECT ''_EMAIL_ADDRESS_'' AS email_address, ''_TELEPHONE_'' AS telephone, ''_COUNTRY_'' AS country, ''_USER_NAME_'' AS user_name, ''_PASSWORD_'' AS password, ''_SECRET_ANSWER_'' AS secret_answer, \n(SELECT question FROM secret_questions WHERE id=''_SECRET_QUESTION_ID_'') AS secret_question, \nNOW() AS date_entered, NOW() AS last_updated) \n\nON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id), telephone=VALUES(telephone), password=VALUES(password), secret_answer=VALUES(secret_answer), secret_question=VALUES(secret_question), last_updated=NOW()'),
(17, 'remove_temp_user', 'DELETE FROM users WHERE id=''_USER_ID_'''),
(18, 'remove_temp_organization', 'DELETE FROM organizations WHERE id=''_ORGANIZATION_ID_'''),
(19, 'update_organization_contact', 'UPDATE organizations SET contact_address=''_CONTACT_ADDRESS_'', contact_city=''_CONTACT_CITY_'', contact_region=''_CONTACT_REGION_'', contact_zipcode=''_CONTACT_ZIPCODE_'', contact_country_id=''_CONTACT_COUNTRY_ID_''\r\n\r\nWHERE id=''_ORGANIZATION_ID_'''),
(20, 'activate_user_account', 'UPDATE users SET \nfirst_name=''_FIRST_NAME_'', last_name=''_LAST_NAME_'', _organization_id=''_ORGANIZATION_ID_'', email_verified=''Y'', status=''active'', _entered_by=''_USER_ID_'', last_updated=NOW(), _last_updated_by=''_USER_ID_'',\n _permission_group_id = (SELECT id FROM permission_groups WHERE type=''_ORGANIZATION_TYPE_'' AND is_removable=''N'' LIMIT 1)\n\n WHERE id=''_USER_ID_''');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO users (id, _organization_id, first_name, middle_name, last_name, position, gender, birthday, email_address, telephone, _telephone_carrier_id, email_verified, phone_verified, photo_url, address_line_1, address_line_2, city, state, country, zipcode, user_name, password, _permission_group_id, secret_question, secret_answer, status, registration_start_date, registration_end_date, password_needs_reset, activation_email_sent, date_entered, _entered_by, last_updated, _last_updated_by) VALUES
(1, 1, 'John', 'S', 'Dolres', 'Minister', 'male', '1974-02-23', 'admin@pss.gov', '2324234233', 1, 'Y', 'N', '', '', '', '', '', '', '', 'admin@pss.gov', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1, 'Whats your first pet?', 'Parrot', 'active', '2015-09-08', '2016-05-31', 'N', 'N', '2015-11-04 00:00:00', 1, '2015-11-04 00:00:00', 1),
(2, 2, 'Peter', '', 'Mobior', '', 'unknown', '0000-00-00', 'pde@pss.gov', '3452342343', 0, 'Y', 'N', '', '', '', '', '', '220', '', 'pde@pss.gov', 'f865b53623b121fd34ee5426c792e5c33af8c227', 2, 'In what city did you meet your spouse/significant other?', 'los angeles', 'active', '0000-00-00', '0000-00-00', 'N', 'N', '2015-11-11 10:06:20', 2, '2015-11-11 10:14:45', 2),
(10, 10, 'Almond', '', 'Great', '', 'unknown', '0000-00-00', 'provider@pss.gov', '1231231233', 0, 'Y', 'N', '', '', '', '', '', '256', '', 'provider@pss.gov', 'f865b53623b121fd34ee5426c792e5c33af8c227', 2, 'In what city does your nearest sibling live?', 'kampala', 'active', '0000-00-00', '0000-00-00', 'N', 'N', '2015-11-11 23:38:55', 10, '2015-11-11 23:40:12', 10);