<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing tender pages.
 *
 * @author David Buwembo <dbuwembo@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/4/2015
 */
class Tenders extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_tender');
		$this->load->model('_procurement_plan');
		$this->load->model('_tender');
		$this->load->model('_bid');
		$this->load->model('_contract');
	}
	
	# tender notices home page
	function index()
	{
		$data = filter_forwarded_data($this);
		if(!empty($data['a'])) $data['area'] = $data['a'];
		
		$data['procurementPlanList'] = $this->_procurement_plan->lists();
		$data['tenderList'] = $this->_tender->lists();
		$data['bebList'] = $this->_bid->lists(!empty($data['a'])? $data['a']: '');
		$data['contractList']=$this->_contract->lists();
		
		$this->load->view('tenders/home', $data);
	}
	
	
	
	# tender notices lists
	function tenders_list()
	{
		$data = filter_forwarded_data($this);
		
		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();
		
		$this->load->model('_procurement_plan');
		$this->load->model('_tender');
		$this->load->model('_bid');
		$this->load->model('_contract');
		$data['procurementPlanList'] = $this->_procurement_plan->lists();
		$data['tenderList'] = $this->_tender->lists();
		$data['bebList'] = $this->_bid->lists(!empty($data['a'])? $data['a']: '');
		$data['contractList']=$this->_contract->lists();
		
		$this->load->view('tenders/details_list', $data);
	}
	
	
	
	# to manage tenders
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_tender->lists();
		
		$this->load->view('tenders/manage', $data);
	}
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'tender_list_actions', 'div');
	}
	
	
	
	# filter tender
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('tenders/list_filter', $data);
	}
	
	
	
	# filter tenders for the home page
	function home_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'procurement_plans') $folder = 'procurement_plans';
		else if($data['t'] == 'active_notices') $folder = 'tenders';
		else if($data['t'] == 'best_evaluated_bidders') $folder = 'bids';
		else if($data['t'] == 'contract_awards') $folder = 'contracts';
		
		$this->load->view($folder.'/home_filter', $data);
	}

    # filter tenders for the home page
	function home_portal_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'procurement_plans') $folder = 'procurement_plans';
		else if($data['t'] == 'active_notices') $folder = 'tenders';
		else if($data['t'] == 'best_evaluated_bidders') $folder = 'bids';
		else if($data['t'] == 'contract_awards') $folder = 'contracts';
		
		$this->load->view($folder.'/home_portal_filter', $data);
	}	
	
	# to add a tender
	function add()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_POST)){
			# Upload the file before you proceed with the rest of the 
			$fileUrl = upload_file($_FILES, 'document__fileurl', 'document_', 'pdf,doc,docx');
			if(!empty($fileUrl)) {
				$_POST['document'] = $fileUrl;
				$result = $this->_tender->add($_POST);
			}
			else $result = array('boolean'=>FALSE, 'reason'=>'File could not be uploaded.');
			
			if(!$result['boolean']) echo "ERROR: The tender notice could not be added. ".$result['reason'];
		}
		else $this->load->view('tenders/new_tender', $data);
	}
	
	
	
	# view one tender
	function view_one()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) $data['tender'] = $this->_tender->details($data['d']);
		else $data['msg'] = 'ERROR: The tender details can not be resolved';
		
		$this->load->view('tenders/tender_details', $data);
	}
	
	
	
	
	# update a tender status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $response = $this->_tender->update_status($data['t'], explode('--',$data['list']));
		
		# all good
		if(!empty($response) && $response['boolean']){
			$data['msg'] = 'The tender status has been updated.';
			$data['area'] = 'refresh_list_msg';
		} 
		# there was an error
		else {
			$data['msg'] = (!empty($data['t']) && !empty($data['list']))? 'ERROR: There was an error updating the tender status.': 'ERROR: This action can not be resolved';
			$data['area'] = 'basic_msg';
		}
		
		$this->load->view('addons/basic_addons', $data);
		
		
		
	}
	
	
}

/* End of controller file */