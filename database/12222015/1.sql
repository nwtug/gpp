
DROP TABLE IF EXISTS tender_invitations;
CREATE TABLE IF NOT EXISTS tender_invitations (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  _tender_id bigint(20) NOT NULL,
  _provider_id bigint(20) NOT NULL,
  note varchar(500) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  date_entered datetime NOT NULL,
  _entered_by bigint(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



INSERT INTO `message_templates` (`id`, `message_type`, `subject`, `details`, `sms`, `copy_admin`, `date_entered`, `_entered_by`, `last_updated`, `_last_updated_by`) VALUES (NULL, 'password_recovery_notification', 'Your New Public Procurement Portal Password', 'Your new public procurement portal password is: _PASSWORD_ 
<br>
<br>Login at: _DIRECTIONLINK_
<br>
<br>
Regards,
<br>
<br>_SITETITLE_
<br>_LOGINLINK_
<br>MESSAGE ID: _MESSAGEID_', 'Your New Public Procurement Portal Password is ', 'N', '2015-12-22 00:00:00', '1', '2015-12-22 00:00:00', '1');




