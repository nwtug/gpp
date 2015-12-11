<<<<<<< HEAD
INSERT INTO `pss_v1`.`message_templates` (`id`, `message_type`, `subject`, `details`, `sms`, `copy_admin`, `date_entered`, `_entered_by`, `last_updated`, `_last_updated_by`) VALUES (NULL, 'password_recovery_notification', 'Your Temporary Password for TIMIS', '
Your PSS password has been reset.  <br>
You will need the following details to login: <br> Your user name: _EMAILADDRESS_ <br>Your Temporary Password: _PASSWORD_ <br>For your security, you are encouraged to change this password the first time you login on your profile page. <br> <br>
In case you closed the PSS website, go to the link below to login: <br>
_LOGIN_LINK_ <br> <br>If you did not request this password change, please contact us at security@timis.go.ug <br> <br>Regards, <br>
Your PSS Admin Team <br>', '', 'Y', CURRENT_DATE(), NULL, CURRENT_DATE(), '1');
=======
ALTER TABLE `tender_notices` ADD `reference_number` VARCHAR( 300 ) NOT NULL AFTER `name` ;
ALTER TABLE `procurement_plans` DROP `reference_number` ;

ALTER TABLE `tender_notices` ADD `source_of_funds` VARCHAR( 300 ) NOT NULL AFTER `reference_number` ;
ALTER TABLE `contracts` CHANGE `status` `status` ENUM( 'saved', 'active', 'endorsed','cancelled', 'commenced', 'complete', 'terminated', 'final_payment', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';


ALTER TABLE `contract_status` ADD `amount_paid` BIGINT NOT NULL AFTER `amount_spent` ;
ALTER TABLE `tender_notices` CHANGE `type` `type` ENUM( 'works', 'services', 'goods' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;

>>>>>>> 574772ae450f0b4fe0209fdd98fe9e4fa7520f95
