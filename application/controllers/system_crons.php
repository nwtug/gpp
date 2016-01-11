<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class handles running cron jobs for the system.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 12/30/2015
 */

class System_crons extends CI_Controller 
{
	#Constructor to set some default values at class load
	function __construct()
    {
        parent::__construct();
        $this->load->model('_cron');
	}
	
	
	# Update the query cache
	function update_query_cache()
	{
		# DISABLE IF IN DEV TO SEE IMMEDIATE CHANGES IN YOUR QUERIES
		if(ENABLE_QUERY_CACHE) $this->_query_reader->load_queries_into_cache();
	}
	
	
	# Update the message cache
	function update_message_cache()
	{
		# DISABLE IF IN DEV TO SEE IMMEDIATE CHANGES IN YOUR MESSAGES
		if(ENABLE_MESSAGE_CACHE) $this->_messenger->load_messages_into_cache();
	}
	
	
	
	# Fetch and run all system jobs
	function fetch_and_run_sys_jobs()
	{
		$data = filter_forwarded_data($this);
		$result = $this->_cron->run_available_jobs();
		
		#Log the results from the run
		if(!empty($data['jobid'])) {
			$jobDetails['user_id'] = 'system';
			$jobDetails['job_type'] = 'system_crons';
			$jobDetails['job_code'] = 'fetch_and_run_sys_jobs';
			$jobDetails['result'] = $result['bool']? 'success': 'fail';
			$jobDetails['job_details'] = "total_crons=".$result['total']."|run_time=".$result['runtime'];
			
			$this->_cron->update_status($data['jobid'], $jobDetails); 
		}
	}
	
	
	
	
	
	
	
}

/* End of controller file */