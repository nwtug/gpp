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
		$this->native_session->delete('plan_id');
		
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
			$result = $this->_procurement_plan->add($_POST);
			if(!$result['boolean']) echo "ERROR: The procurement plan could not be added. ".$result['reason'];
		}
		else {
			if(!empty($data['d'])) {
				$data['plan'] = $this->_procurement_plan->all_details($data['d']);
				$this->native_session->set('plan_id', $data['d']);
			}
			$this->load->view('procurement_plans/new_plan', $data);
		}
	}
	
	
	
	# to add a procurement plan's details from an excel spreadsheet
	function add_details()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_FILES)){
			$fileUrl = upload_file($_FILES, 'plantemplate__fileurl', 'plan_', 'xls');
			if(!empty($fileUrl)) {
				$_POST['document'] = $fileUrl;
				$data['list'] = $this->_procurement_plan->add_details($_POST);
				if(!is_array($data['list'])) $data['msg'] = 'ERROR: '.$data['list'];
				$this->load->view('procurement_plans/plan_details', $data);
			}
			else echo format_notice($this,'ERROR: The plan document could not be uploaded.');
		}
		else echo format_notice($this,'ERROR: No plan details could be resolved.');
	}
	
	
	
	
	
	# view one procurement plan
	function view_one()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) $data['plan'] = $this->_procurement_plan->details($data['d']);
		if(empty($data['plan'])) $data['msg'] = 'ERROR: The procurement plan details can not be resolved';
		
		$this->load->view('procurement_plans/procurement_plan_details', $data);
	}
	
	
	
	
	
	# download a procurement plan
	function download()
	{
		$data = filter_forwarded_data($this);
		$this->load->model('_file');
		$this->load->helper('report');
		
		if(!empty($data['d'])) $plan = $this->_procurement_plan->all_details($data['d']);
		if(empty($plan['list'])) $data['msg'] = 'ERROR: The procurement plan details can not be resolved';
		
		$this->_file->generate_pdf(generate_report_html($plan, 'procurement_plan',$this), UPLOAD_DIRECTORY.'file_'.strtotime('now').'.pdf', 'download', array('size'=>'A4','orientation'=>'landscape'));
	}
	
	
	
	
	# edit a single plan detail
	function edit_single_detail()
	{
		$data = filter_forwarded_data($this);
		$response = $this->_procurement_plan->update_single_detail($data['d'],$data['k'],restore_bad_chars($data['value']));
		echo format_notice($this, ($response['boolean']? 'Updated': 'ERROR: Not updated'));
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
	
	
	
	
	# download template
	function template()
	{
		$data = filter_forwarded_data($this);
		force_download('','plan_template.xls');
	}
	
	
	
	
	
	# edit a report detail item
	function remove_item()
	{
		$data = filter_forwarded_data($this);
		$response = $this->_procurement_plan->remove_item($_POST);
		
		if(!empty($reponse['boolean']) && $reponse['boolean']) echo "ERROR: ".$reponse['msg'];
	}
	
	
	
	# add a report detail item
	function add_item()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_POST)){
			$response = $this->_procurement_plan->add_item($_POST);
			if(!(!empty($response['boolean']) && $response['boolean'] == 'SUCCESS')) echo "ERROR: There was a problem adding the plan detail.";
		} 
		else {
			# get the details of the category being displayed
			$category = $this->_procurement_plan->get_raw_plan_category($data['d']);
			$data['categoryId'] = $category['category_id'];
			$data['planId'] = $category['_plan_id'];
			$this->load->view('procurement_plans/add_details', $data);
		}
	}
	
	
	
	
	
	
	# view the procurement plan details
	function view_details()
	{
		$data = filter_forwarded_data($this);
		$data['plan'] = $this->_procurement_plan->all_details($data['d'],'list');
		
		$this->load->view('procurement_plans/plan_details', array(
			'list'=>(!empty($data['plan']['list'])? $data['plan']['list']: array())  
		));
	}
	
	
	
	
	
	
	
	
}

/* End of controller file */