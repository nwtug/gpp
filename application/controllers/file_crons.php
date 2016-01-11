<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls management of file cron jobs
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 12/30/2015
 */
class File_crons extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_cron');
        $this->load->model('_file_cron');
	}
	
	
	
	
	
	# remove orphaned files
	function remove_orphaned_files()
	{
		$data = filter_forwarded_data($this);
		# since we need more details from the cron job itself, exit if the command did not include a job ID
		if(empty($data['jobid'])) exit(0);
		
		$result = $this->_file_cron->remove_orphaned_files($data['jobid']);
			
		# log cron results
		$jobDetails['user_id'] = 'system';
		$jobDetails['job_type'] = 'file_crons';
		$jobDetails['job_code'] = 'remove_orphaned_files';
		$jobDetails['result'] = $result['bool']? 'success': 'fail';
		$jobDetails['job_details'] = "run_time=".$result['run_time']."|run_count=".$result['run_count'];
		
		$this->_cron->update_status($data['jobid'], $jobDetails);
	}
	
	
	
	
	
	
	
	
	# backup and clear cron log
	function backup_cron_log()
	{
		$data = filter_forwarded_data($this);
		$result = $this->_file_cron->backup_cron_log();
		
		# log the results from the run if a job ID is provided
		if(!empty($data['jobid'])) {
			$jobDetails['user_id'] = 'system';
			$jobDetails['job_type'] = 'file_crons';
			$jobDetails['job_code'] = 'backup_cron_log';
			$jobDetails['result'] = $result['bool']? 'success': 'fail';
			$jobDetails['job_details'] = "archive=".$result['archive'];
		
			$this->_cron->update_status($data['jobid'], $jobDetails);
		}
	}
	
}

/* End of controller file */