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
	}
	
	# tender notices home page
	function index()
	{
		$data = filter_forwarded_data($this);
		$data['area'] = !empty($data['a'])? $data['a']: 'procurement_plans';
		$this->native_session->delete('__view');
		
		$data['list'] = $this->get_list_to_show($data['area']);
		$data['folder'] = $this->get_section_folder($data['area']);
		$this->load->view('tenders/home', $data);
	}
	
	
	
	# tender notices lists
	function tender_list()
	{
		$data = filter_forwarded_data($this);
		$data['area'] = !empty($data['t'])? $data['t']: 'procurement_plans';
		
		$data['list'] = $this->get_list_to_show($data['area']);
		$this->load->view($this->get_section_folder($data['area']).'/details_list', $data);
	}
	
	
	
	# determine which list to show for the view
	function get_list_to_show($area)
	{
		$this->load->model('_procurement_plan');
		$this->load->model('_contract');
		$this->load->model('_bid');
		$list = array();
		
		if($area == 'procurement_plans') {
			$list = $this->_procurement_plan->lists(array('status'=>'published', 'offset'=>0, 'limit'=>NUM_OF_ROWS_PER_PAGE));
		} else if($area == 'best_evaluated_bidders') {
			$list = $this->_bid->lists('best_bidders');
		} else if($area == 'active_notices') {
			$list = $this->_tender->lists(array('status'=>'published', 'display_type'=>'public', 'offset'=>0, 'limit'=>NUM_OF_ROWS_PER_PAGE));
		} else if($area == 'contract_awards') {
			$list = $this->_contract->lists(array('offset'=>0, 'limit'=>NUM_OF_ROWS_PER_PAGE, 'status'=>array('active','complete','endorsed','commenced')));
		}
		
		return $list;
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
		if($data['t'] == 'best_evaluated_bidders') $data['listtype'] = 'best_bidders';
		
		$this->load->view($this->get_section_folder($data['t']).'/list_filter', $data);
	}
	
	
	
	# get section folder
	function get_section_folder($section)
	{
		$folder = '';
		if($section == 'procurement_plans') $folder = 'procurement_plans';
		else if($section == 'active_notices') $folder = 'tenders';
		else if($section == 'best_evaluated_bidders') $folder = 'bids';
		else if($section == 'contract_awards') $folder = 'contracts';
		
		return $folder;
	}
	
	
		
	
	# to add a tender
	function add()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_POST)){
			# Upload the file before you proceed with the rest of the process
			if(!empty($_FILES)) $fileUrls = upload_many_files($_FILES, 'document__fileurl', 'document_', 'pdf,doc,docx');
			$_POST['documents'] = !empty($fileUrls)? $fileUrls: array();
			
			# check for document upload for new tender notice here because you should not proceed without them
			if((empty($_POST['tender_id']) && !empty($_POST['documents'])) || !empty($_POST['tender_id'])) $result = $this->_tender->add($_POST);
			if(empty($_POST['tender_id']) && empty($_POST['documents'])) $result = array('boolean'=>FALSE, 'reason'=>'File(s) could not be uploaded.');
			
			if(!$result['boolean']) echo "ERROR: The Invitation for Bids/Quotations could not be added. ".$result['reason'];
		}
		else {
			if(!empty($data['d'])) $data['tender'] = $this->_tender->details($data['d']);
			$this->load->view('tenders/new_tender', $data);
		}
	}
	
	
	
	# view one tender
	function view_one()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) $data['tender'] = $this->_tender->details($data['d']);
		else $data['msg'] = 'ERROR: The Invitation for Bids/Quotations details can not be resolved';
		
		$this->load->view('tenders/tender_details', $data);
	}
	
	
	
	
	# update a tender status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $response = $this->_tender->update_status($data['t'], explode('--',$data['list']));
		
		# all good
		if(!empty($response) && $response['boolean']){
			$data['msg'] = 'The Invitation for Bids/Quotations status has been updated.';
			$data['area'] = 'refresh_list_msg';
		} 
		# there was an error
		else {
			$data['msg'] = (!empty($data['t']) && !empty($data['list']))? 'ERROR: There was an error updating the Invitation for Bids/Quotations status.': 'ERROR: This action can not be resolved';
			$data['area'] = 'basic_msg';
		}
		
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	
	# invite providers to bid on a tender
	function invite()
	{
		$data = filter_forwarded_data($this);
		
		# user has submitted the invitation
		if(!empty($_POST)){
			$response = $this->_tender->invite($_POST);
			$msg = (!empty($response) && $response['boolean'])? 'The Invitation for Bids/Quotations has been sent.' :'ERROR: The Invitation for Bids/Quotations could not be sent.';
			
			$this->native_session->set('__msg',$msg);
		}
		else if(!empty($data['a'])){
			$data['msg'] = $this->native_session->get('__msg');
			$data['area'] = 'refresh_list_msg';
			$this->load->view('addons/basic_addons', $data);
		}
		else {
			$data['tender'] = $this->_tender->details($data['d']);
			$data['invited'] = $this->_tender->invitations($data['d']);
			$this->load->view('tenders/invite', $data);
		}
	}
	
	
	
	
	# the list of providers invited for a bid
	function invitations()
	{
		$data = filter_forwarded_data($this);
		$data['tender'] = $this->_tender->details($data['d']);
		$data['invited'] = $this->_tender->invitations($data['d']);
		
		if(empty($data['invited'])) $data['msg'] = "ERROR: No invitations can be resolved.";
		$this->load->view('tenders/invitations', $data);
	}
	
	
	
	
	
	
}

/* End of controller file */