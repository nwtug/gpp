<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing procurement plan pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class Procurement_plans extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_procurement_plan');
	}
	
	
	
	# to manage procurement plans
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_procurement_plan->lists();
		
		$this->load->view('procurement_plans/manage', $data);
	}
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'procurement_plan_list_actions', 'div');
	}
	
	
	# list filters
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('procurement_plans/list_filter', $data);
	}
	
	
	
	# to add a procurement plan
	function add()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_POST)){
			# Upload the file before you proceed with the rest of the process
			$fileUrl = upload_file($_FILES, 'document__fileurl', 'document_', 'pdf,doc,docx');
			if(!empty($fileUrl)) {
				$_POST['document'] = $fileUrl;
				$result = $this->_procurement_plan->add($_POST);
			}
			else $result = array('boolean'=>FALSE, 'reason'=>'File could not be uploaded.');
			
			if(!$result['boolean']) echo "ERROR: The procurement plan could not be added. ".$result['reason'];
		}
		else $this->load->view('procurement_plans/new_plan', $data);
	}
	
	
	
	
	
	
	# view one procurement plan
	function view_one()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) $data['plan'] = $this->_procurement_plan->details($data['d']);
		if(empty($data['plan'])) $data['msg'] = 'ERROR: The procurement plan details can not be resolved';
		
		$this->load->view('procurement_plans/procurement_plan_details', $data);
	}
	
	
	
	
	
	# update a provider's status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $response = $this->_procurement_plan->update_status($data['t'], explode('--',$data['list']));
		
		# all good
		if(!empty($response) && $response['boolean']){
			$data['msg'] = 'The procurement plan status has been updated.';
			$data['area'] = 'refresh_list_msg';
		} 
		# there was an error
		else {
			$data['msg'] = (!empty($data['t']) && !empty($data['list']))? 'ERROR: There was an error updating the procurement plan status.': 'ERROR: This action can not be resolved';
			$data['area'] = 'basic_msg';
		}
		
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	
}

/* End of controller file */