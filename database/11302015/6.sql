INSERT INTO `pss`.`message_templates` (`id`, `message_type`, `subject`, `details`, `sms`, `copy_admin`, `date_entered`, `_entered_by`, `last_updated`, `_last_updated_by`) VALUES (NULL, 'custom_internal_message', 'Message From RSS Procurement Portal: _SUBJECT_', '_DETAILS_
<BR>
<BR>
Regards,
<BR><BR>
_SITETITLE_
<BR>_LOGINLINK_
<BR>MESSAGE ID: _MESSAGEID_', '_DETAILS_', 'N', '2015-12-02 00:00:00', '1', '2015-12-02 00:00:00', '1');


DROP TABLE IF EXISTS pde_categories;
CREATE TABLE IF NOT EXISTS pde_categories (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO pde_categories (id, name) VALUES
(1, 'Ministry'),
(2, 'National Corporation'),
(3, 'Commission or Authority');


ALTER TABLE `contract_status` ADD `amount_spent` BIGINT NOT NULL AFTER `percentage` ;



