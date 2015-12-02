INSERT INTO `pss_v1`.`message_templates` (`id`, `message_type`, `subject`, `details`, `sms`, `copy_admin`, `date_entered`, `_entered_by`, `last_updated`, `_last_updated_by`) VALUES (NULL, 'password_recovery_notification', 'Your Temporary Password for TIMIS', '
Your PSS password has been reset.  <br>
You will need the following details to login: <br> Your user name: _EMAILADDRESS_ <br>Your Temporary Password: _PASSWORD_ <br>For your security, you are encouraged to change this password the first time you login on your profile page. <br> <br>
In case you closed the PSS website, go to the link below to login: <br>
_LOGIN_LINK_ <br> <br>If you did not request this password change, please contact us at security@timis.go.ug <br> <br>Regards, <br>
Your PSS Admin Team <br>', '', 'Y', CURRENT_DATE(), NULL, CURRENT_DATE(), '1');
