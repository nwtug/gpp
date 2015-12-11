<<<<<<< HEAD
INSERT INTO `pss_v1`.`queries` (`id`, `code`, `details`) VALUES (NULL, 'verify_document', 'SELECT id AS document_id, url, size, tracking_number, name, description, document_type, category, is_removable, date_entered, status,
(SELECT CONCAT(first_name, '' '', last_name) FROM users WHERE id=D._entered_by LIMIT 1) AS entered_by,
(SELECT name FROM organizations WHERE id=D._entered_by_organization LIMIT 1) AS entered_by_organization

FROM documents D WHERE 1=1
AND D.document_type like ''_DOCUMENT_TYPE_''

AND D.tracking_number = ''_TRACKING_NUMBER_''
');
=======
ALTER TABLE `tender_notices` ADD FULLTEXT (`name`);
ALTER TABLE `bids` CHANGE `status` `status` ENUM( 'saved', 'submitted', 'rejected', 'under_review', 'short_list', 'won', 'awarded', 'complete', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';





>>>>>>> 574772ae450f0b4fe0209fdd98fe9e4fa7520f95
