UPDATE `pss_v1`.`queries` SET `details` = 'UPDATE users SET 
first_name=''_FIRST_NAME_'', last_name=''_LAST_NAME_'', _organization_id=''_ORGANIZATION_ID_'', email_verified=''Y'', status=''_STATUS_'', _entered_by=''_USER_ID_'', last_updated=NOW(), _last_updated_by=''_USER_ID_'',
 _permission_group_id = (SELECT id FROM permission_groups WHERE type=''_ORGANIZATION_TYPE_'' AND is_removable=''N'' LIMIT 1)

 WHERE id=''_USER_ID_''' WHERE `queries`.`id` =20;





INSERT INTO `pss_v1`.`message_templates` (
`id` ,
`message_type` ,
`subject` ,
`details` ,
`sms` ,
`copy_admin` ,
`date_entered` ,
`_entered_by` ,
`last_updated` ,
`_last_updated_by`
)
VALUES (
NULL , 'activate_new_pde', 'A new PDE has been submitted', 'A new Procuring/Disposing Entity named _ORGANIZATIONNAME_ has been submitted by _FIRSTNAME_ _LASTNAME_ for your approval.
<br>
<br>
Regards,
<br>
<br>_SITETITLE_
<br>_LOGINLINK_
<br>MESSAGE ID: _MESSAGEID_', 'A new PDE named _ORGANIZATIONNAME_ has been submitted for your approval.', 'Y', '2015-11-21 00:00:00', '1', '2015-11-21 00:00:00', '1'
);








DROP TABLE IF EXISTS business_categories;
CREATE TABLE IF NOT EXISTS business_categories (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO business_categories (id, name) VALUES
(1, 'Goods'),
(2, 'Services'),
(3, 'Works');





UPDATE organizations SET _category_id= IF(_category_id='0','2',IF(_category_id > 3, '3', _category_id));




UPDATE `pss_v1`.`queries` SET `details` = 'INSERT INTO users (email_address, telephone, otherphone, country, user_name, password, secret_answer, secret_question, date_entered, last_updated) 
(SELECT ''_EMAIL_ADDRESS_'' AS email_address, ''_TELEPHONE_'' AS telephone, ''_OTHERPHONE_'' AS otherphone, ''_COUNTRY_'' AS country, ''_USER_NAME_'' AS user_name, ''_PASSWORD_'' AS password, ''_SECRET_ANSWER_'' AS secret_answer, 
(SELECT question FROM secret_questions WHERE id=''_SECRET_QUESTION_ID_'') AS secret_question, 
NOW() AS date_entered, NOW() AS last_updated) 

ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id), telephone=VALUES(telephone), password=VALUES(password), secret_answer=VALUES(secret_answer), secret_question=VALUES(secret_question), last_updated=NOW()' WHERE `queries`.`id` =16;




ALTER TABLE `users` ADD `otherphone` VARCHAR( 20 ) NOT NULL AFTER `_telephone_carrier_id` ;





UPDATE `pss_v1`.`queries` SET `details` = 'SELECT U.id, U._organization_id AS organization_id, U.user_name, U.id AS user_id, U.first_name, U.last_name, U.email_address, U.email_verified, U.telephone, U.otherphone, U._telephone_carrier_id AS carrier_id, U.photo_url, U.address_line_1 AS address, U.city, U.state, U.zipcode, U.country AS country_id, U.secret_question, U._permission_group_id AS permission_group_id, U.status, 
(SELECT name FROM countries WHERE id=U.country LIMIT 1) AS country,   
(SELECT id FROM secret_questions WHERE question=U.secret_question LIMIT 1) AS secret_question_id,
(SELECT carrier_name FROM telephone_carriers WHERE id=U._telephone_carrier_id LIMIT 1) AS telephone_carrier, 
(SELECT type FROM permission_groups WHERE id=U._permission_group_id LIMIT 1) AS group_type, 
(SELECT name FROM organizations WHERE id=U._organization_id LIMIT 1) AS organization_name,
IF((SELECT id FROM organizations WHERE _owner_user_id=U.id AND id=U._organization_id LIMIT 1) IS NOT NULL, ''Y'', ''N'') AS is_owner

FROM users U 
WHERE id=''_USER_ID_''' WHERE `queries`.`id` = 3;








UPDATE `pss_v1`.`queries` SET `details` = 'UPDATE users SET 
photo_url = IF(''_PHOTO_URL_'' <> '''', ''_PHOTO_URL_'', photo_url), 
password = IF(''_PASSWORD_'' <> '''', ''_PASSWORD_'', password), 
telephone = ''_TELEPHONE_'', 
otherphone = ''_OTHERPHONE_'', 
secret_question = (SELECT question FROM secret_questions WHERE id = ''_SECRET_QUESTION_ID_'' LIMIT 1), 
secret_answer = ''_SECRET_ANSWER_'', 
address_line_1 = ''_ADDRESS_LINE_1_'', 
city = ''_CITY_'', 
state = ''_STATE_'', 
zipcode = ''_ZIPCODE_'', 
country = ''_COUNTRY_'', 
last_updated = NOW(), 
_last_updated_by = ''_USER_ID_''

WHERE id=''_USER_ID_''' WHERE `queries`.`id` =72;





