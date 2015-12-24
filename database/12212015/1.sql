DROP TABLE IF EXISTS `suspension_reasons`;
DELETE FROM queries WHERE code='add_suspension_reason';

ALTER TABLE `registration_status_track` ADD `_entered_by` BIGINT NOT NULL ;