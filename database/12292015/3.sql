ALTER TABLE `queries` ADD UNIQUE (`code`);
ALTER TABLE `activity_trail` CHANGE `_user_id` `user_id` VARCHAR( 100 ) NOT NULL ;


DROP TABLE IF EXISTS cron_schedule;
CREATE TABLE IF NOT EXISTS cron_schedule (
  id bigint(20) NOT NULL,
  job_type varchar(100) NOT NULL,
  activity_code varchar(100) NOT NULL,
  cron_value varchar(300) NOT NULL,
  is_done enum('Y','N') NOT NULL DEFAULT 'N',
  run_time datetime NOT NULL,
  when_ran datetime NOT NULL,
  last_result enum('none','success','fail') NOT NULL DEFAULT 'none',
  repeat_code varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO cron_schedule (id, job_type, activity_code, cron_value, is_done, run_time, when_ran, last_result, repeat_code) VALUES
(1, 'system_crons', 'fetch_and_run_sys_jobs', '', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'none', 'default'),
(2, 'system_crons', 'update_query_cache', '', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'none', 'default'),
(3, 'system_crons', 'update_message_cache', '', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'none', 'default'),
(4, 'file_crons', 'remove_orphaned_files', '', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'none', 'end_of_day'),
(5, 'file_crons', 'backup_cron_log', '', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'none', 'end_of_day');

ALTER TABLE cron_schedule
  ADD PRIMARY KEY (id);


ALTER TABLE cron_schedule
  MODIFY id bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;