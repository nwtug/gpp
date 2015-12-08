ALTER TABLE `bids` CHANGE `status` `status` ENUM( 'saved', 'submitted', 'under_review', 'short_list', 'won', 'awarded', 'complete', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';

ALTER TABLE `contracts` CHANGE `status` `status` ENUM( 'saved', 'active', 'endorsed', 'commenced', 'complete', 'terminated', 'archived' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'saved';

