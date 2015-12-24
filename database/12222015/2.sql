ALTER TABLE `event_attendance` ADD `certificate_url` VARCHAR( 300 ) NOT NULL AFTER `notes` ,
ADD `certificate_number` VARCHAR( 100 ) NOT NULL AFTER `certificate_url` ;

ALTER TABLE `forum_comments` CHANGE `_entered_by` `entered_by` VARCHAR( 100 ) NOT NULL ;



INSERT INTO `message_templates` (`id`, `message_type`, `subject`, `details`, `sms`, `copy_admin`, `date_entered`, `_entered_by`, `last_updated`, `_last_updated_by`) VALUES (NULL, 'invitation_to_bid', 'You Are Invited To Bid: _REFERENCENUMBER_', 'You are invited to submit a bid on the Tender Notice below: 
<br>
<br><b>Subject:</b> _TENDERSUBJECT_ 
<br><b>Reference Number:</b> _REFERENCENUMBER_
<br><b>Procurement Method:</b> _METHOD_
<br><b>Procurement/Disposal Entity:</b> _PDE_
<br><b>Deadline:</b> _DEADLINE_
<br>
<br><b>Note:</b> _NOTE_
<br>
<br>
Regards,
<br>
<br>_SITETITLE_
<br>_LOGINLINK_
<br>MESSAGE ID: _MESSAGEID_', 'You Are Invited To Bid: _REFERENCENUMBER_', 'Y', '2015-12-02 00:00:00', '1', '2015-12-02 00:00:00', '1');



ALTER TABLE `tender_invitations` ADD UNIQUE (
`_tender_id` ,
`_provider_id`
);





ALTER TABLE `tender_invitations` ADD `last_updated` DATETIME NOT NULL ,
ADD `_last_updated_by` BIGINT NOT NULL ;




