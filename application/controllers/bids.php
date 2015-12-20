<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing bid pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/4/2015
 */
class Bids extends CI_Controller 
{
	# constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_bid');
	}
	
	
	# to manage bids
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_bid->lists(!empty($data['a'])? $data['a']: '');
		
		$this->load->view('bids/manage', $data);
	}
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, (!empty($data['a'])? $data['a'].'_':'all_').'bid_list_actions', 'div');
	}
	
	
	
	# filter bids
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('bids/list_filter', $data);
	}
	
	
	
	# view bid list
	function view_list()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) $data['list'] = $this->_bid->view_list($data['d'], array('offset'=>'0','limit'=>'50'));
		if(empty($data['list'])) $data['msg'] = 'ERROR: No bid list could be resolved.';
		
		$this->load->view('bids/pop_list', $data);
	}
	
	
	
	# submit a new bid
	function add()
	{
		$data = filter_forwarded_data($this);
		
		# user has posted the new bid information
		if(!empty($_POST)){
			# Upload the file before you proceed with the rest of the process
			$fileUrls = upload_many_files($_FILES, 'document__fileurl', 'document_', 'pdf,doc,docx');
			$_POST['documents'] = !empty($fileUrls)? $fileUrls: array();
			$result = $this->_bid->add($_POST);
			
			if(!$result['boolean']) echo "ERROR: The bid could not be added. ".$result['reason'];
		}
		# just coming to the form
		else {
			# if the tender notice id is provided
			if(!empty($data['t'])){
				$this->load->model('_tender');
				$data['tender'] = $this->_tender->details($data['t']);
			}
			if(!empty($data['d'])) $data['bid'] = $this->_bid->details(array('bid_id'=>$data['d']));
			else if(!empty($data['t'])) $data['bid'] = $this->_bid->details(array('tender_id'=>$data['t']));
			
			$this->load->view('bids/new_bid', $data);
		}
	}
	
	
	# view details of bid
	function view_one()
	{
		$data = filter_forwarded_data($this);
		$data['bid'] = $this->_bid->details(array('bid_id'=>$data['d']));
		if(empty($data['bid'])) $data['msg'] = "ERROR: No bid information could be resolved.";
		
		$this->load->view('bids/bid_details', $data);
	}
	
	
	
	# my bid list - for provider
	function my_list()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_bid->my_list();
		
		$this->load->view('bids/my_list', $data);
	}
	
	
	
	
	# summary of bid
	function summary()
	{
		$data = filter_forwarded_data($this);
		$data['summary'] = $this->_bid->summary($data['d']);
		
		$this->load->view('bids/summary', $data);
	}
	
	
	
	# my list actions 
	function my_list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'my_bid_list_actions', 'div');
	}
	
	
	
	# filter my bids
	function my_list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('bids/my_list_filter', $data);
	}
	
	
	
	# update a bid's status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		if(!empty($data['t']) && !empty($data['list'])) $result = $this->_bid->update_status($data['t'], explode('--',$data['list']));
		
		$data['msg'] = !empty($result['boolean']) && $result['boolean']? 'The bid status has been changed.': 'ERROR: The bid status could not be changed.';
		
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	# mark a bid as awarded
	function mark_as_awarded()
	{
		$data = filter_forwarded_data($this);
		if(!empty($data['list'])) $result = $this->_bid->mark_as_awarded(explode('--',$data['list']));
		
		$data['msg'] = !empty($result['boolean']) && $result['boolean']? 'The selected bids have been marked as awarded.': 'ERROR: The selected bids could not be awarded.';
		if(!empty($result['not_awarded'])) {
			$data['msg'] .= "<BR><BR>The following bids do not qualify to be awarded: ";
			foreach($result['not_awarded'] AS $row){
				$data['msg'] .= "<BR>".$row['provider']." (".$row['bid_currency'].format_number($row['bid_amount'],3).")";
			}
		}
		
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	# send a message to the providers who submitted the selected providers
	function message()
	{
		$data = filter_forwarded_data($this);
		
		# user has posted
		if(!empty($_POST)){
			$response = $this->_bid->message($_POST);
			# there was an error
			if(!(!empty($response) && $response['boolean'])){
				$data['msg'] = 'ERROR: There was an error sending to';
				if(!empty($response['unsent'])) $data['msg'] .= ' the following emails: '.implode(', ', $response['unsent']);
				else $data['msg'] .= ' the selected providers.';
				
				$data['area'] = 'basic_msg';
			}
		} 
		# success
		else if(!empty($data['result'])){
			$data['msg'] = 'The messages have been sent.';
			$data['area'] = 'refresh_list_msg';
			$this->load->view('addons/basic_addons', $data);
		}
		
		# simply going to a form to send message
		else {
			$data['action'] = 'bids/message';
			$data['redirect'] = 'bids/message/result/sent';
			$data['id_list'] = implode(',',explode('--',$data['list']));
			$this->load->view('pages/send_from_list', $data);
		}
	}
	
	
	
	
	# set the best evaluated bidder for a tender notice
	function best_evaluated()
	{
		$data = filter_forwarded_data($this);
		
		# user has posted the new bid information
		if(!empty($_POST)){
			$response = $this->_bid->best_evaluated($_POST);
			if(!$response['boolean']) echo "ERROR: Best evaluated bidder could not be commited.";
		} 
		else $this->load->view('bids/best_evaluated', $data);
	}
	
	
	
	
	# get the providers who bid on a tender notice
	function tender_providers()
	{
		$data = filter_forwarded_data($this);
		if(!empty($data['t'])) $data['list'] = $this->_bid->tender_providers($data['t']);
		if(empty($data['list'])) {
			$data['msg'] = (empty($data['t'])? 'ERROR:': 'WARNING:').' No providers could be found for the tender notice.';
		}
		
		$this->load->view('bids/tender_providers', $data);
	}
	
}

/* End of controller file */