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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO message_templates (id, message_type, subject, details, sms, copy_admin, date_entered, _entered_by, last_updated, _last_updated_by) VALUES
(1, 'website_contact_message', 'Website Message Sent By _YOURNAME_', 'A message was sent by _YOURNAME_ at _SENDTIME_. \n<BR>Details:\n<BR>\n<BR>NAME: _YOURNAME_\n<BR>EMAIL: _SENDEREMAILADDRESS_\n<BR>TELEPHONE: _SENDERTELEPHONE_\n<BR>SUBJECT: _MESSAGESUBJECT_\n<BR>MESSAGE: _MESSAGEDETAILS_\n<BR><BR>\nRegards,\n<BR><BR>\n_SITETITLE_\n<BR>_LOGINLINK_\n<BR>MESSAGE ID: _MESSAGEID_', 'A website message was sent by _YOURNAME_', 'Y', '2015-11-10 00:00:00', 1, '2015-11-10 00:00:00', 1),
(2, 'account_verification_code', 'Your Procurement Account Verification Code', 'Thank you for registering with the Public Procurement Portal.\r\nYour verification code is:\r\n<BR>_VERIFICATIONCODE_\r\n<BR>\r\n<BR>Your registration details:\r\n<BR>Email Address: _EMAILADDRESS_\r\n<BR>Telephone: _TELEPHONE_\r\n<BR>User Name: _USERNAME_\r\n<BR>Organization Name: _BUSINESSNAME_\r\n<BR>\r\n<BR>\r\nRegards,\r\n<BR><BR>\r\n_SITETITLE_\r\n<BR>_LOGINLINK_\r\n<BR>MESSAGE ID: _MESSAGEID_', 'Your Public Procurement Portal verification code is:\r\n<BR>_VERIFICATIONCODE_', 'Y', '2015-11-10 00:00:00', 1, '2015-11-10 00:00:00', 1),
(3, 'bid_status_changed', 'The Status of Your Bid Has Changed to _NEWSTATUS_', 'The bid whose details are included below and was submitted to _PDE_ has changed status to _NEWSTATUS_. \r\n<br>\r\n<br>Bid Details:\r\n<br><b>Tender Notice:</b> _TENDERNOTICE_ \r\n<br><b>Procurement/Disposal Entity:</b> _PDE_\r\n<br><b>Date Submitted:</b> _DATESUBMITTED_\r\n<br><b>Summary:</b> _SUMMARY_\r\n<br>\r\n<br>\r\nRegards,\r\n<br>\r\n<br>_SITETITLE_\r\n<br>_LOGINLINK_\r\n<br>MESSAGE ID: _MESSAGEID_', 'The Status of Your Bid Has Changed to _NEWSTATUS_', 'N', '2015-11-21 00:00:00', 1, '2015-11-21 00:00:00', 1),
(4, 'custom_internal_message', 'Message From RSS Procurement Portal: _SUBJECT_', '_DETAILS_\r\n<BR>\r\n<BR>\r\nRegards,\r\n<BR><BR>\r\n_SITETITLE_\r\n<BR>_LOGINLINK_\r\n<BR>MESSAGE ID: _MESSAGEID_', '_DETAILS_', 'N', '2015-12-02 00:00:00', 1, '2015-12-02 00:00:00', 1),
(5, 'changed_item_status', 'The status of your organization _ITEM_ has changed', 'The _ITEM_ named below has changed status to _STATUS_.\r\n<br>_ITEM_ name: _NAME_\r\n<br>\r\n<br>\r\nRegards,\r\n<br>\r\n<br>_SITETITLE_\r\n<br>_LOGINLINK_\r\n<br>MESSAGE ID: _MESSAGEID_', 'The _ITEM_ (_NAME_) has changed to _STATUS_', 'N', '2015-12-02 00:00:00', 1, '2015-12-02 00:00:00', 1);