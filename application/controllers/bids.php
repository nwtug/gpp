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
	#Constructor to set some default values at class load
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
			if(!empty($fileUrls)) {
				$_POST['documents'] = $fileUrls;
				$result = $this->_bid->add($_POST);
			}
			else $result = array('boolean'=>FALSE, 'reason'=>'Files could not be uploaded.');
			
			if(!$result['boolean']) echo "ERROR: The bid could not be added. ".$result['reason'];
		}
		# just coming to the form
		else {
			$this->load->model('_tender');
			$data['tender'] = $this->_tender->details($data['t']);
			$data['bid'] = $this->_bid->details(array('tender_id'=>$data['t']));
			
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
	
	
	
	# update a bid's status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $result = $this->_bid->update_status($data['t'], explode('--',$data['list']));
		
		$data['msg'] = !empty($result['boolean']) && $result['boolean']? 'The bid status has been changed.': 'ERROR: The bid status could not be changes.';
		
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}

	
	
}

/* End of controller file */