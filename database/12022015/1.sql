<<<<<<< HEAD
INSERT INTO `pss_v1`.`queries` (`id`, `code`, `details`) VALUES (NULL, 'get_user_by_email', 'SELECT U.id,
  U._organization_id AS organization_id, U.user_name,
  U.id AS user_id, U.first_name, U.last_name,
  U.email_address, U.email_verified, U.telephone,
  U._telephone_carrier_id AS carrier_id, U.photo_url

FROM users U
WHERE  U.email_address  LIKE ''_EMAIL_ADDRESS_''

');
=======
ALTER TABLE `bids` CHANGE `status` `status` ENUM( 'saved', 'submitted', 'under_review', 'short_list', 'won', 'awarded', 'complete', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';

ALTER TABLE `contracts` CHANGE `status` `status` ENUM( 'saved', 'active', 'endorsed', 'commenced', 'complete', 'terminated', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';

>>>>>>> 574772ae450f0b4fe0209fdd98fe9e4fa7520f95
