ALTER TABLE `tender_notices` ADD FULLTEXT (`name`);
ALTER TABLE `bids` CHANGE `status` `status` ENUM( 'saved', 'submitted', 'rejected', 'under_review', 'short_list', 'won', 'awarded', 'complete', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';





