<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing contract pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS

 * @created 11/21/2015

 */
class Contracts extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_contract');
	}
	
	
	# to manage contracts
	function manage()
	{
		$data = filter_forwarded_data($this);

		$data['list'] = $this->_contract->lists();

		
		$this->load->view('contracts/manage', $data);
	}
	

	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'contract_list_actions', 'div');
	}
	
	
	
	# filter contract list

	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('contracts/list_filter', $data);
	}

	
	
	# generate a contract from a bid winner
	function add()
	{
		$data = filter_forwarded_data($this);
		
		# use has posted the contract form
		if(!empty($_POST)){
			# Upload the file before you proceed with the rest of the process
			$fileUrls = upload_many_files($_FILES, 'document__fileurl', 'document_', 'pdf,doc,docx');
			if(!empty($fileUrls)) {
				$_POST['documents'] = $fileUrls;
				$result = $this->_contract->add($_POST);
			}
			else $result = array('boolean'=>FALSE, 'reason'=>'Files could not be uploaded.');
			
			if(!$result['boolean']) echo "ERROR: The contract could not be added. ".$result['reason'];
		} 
		# just viewing the form
		else {
			$this->load->model('_bid');
			$data['award'] = $this->_bid->details(array('bid_id'=>$data['t']));
			$this->load->view('contracts/new_contract', $data);
		}
	}
	
	
	
	# view one contract
	function view_one()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) $data['contract'] = $this->_contract->details($data['d']);
		else $data['msg'] = 'ERROR: The contract details can not be resolved';
		
		$this->load->view('contracts/contract_details', $data);
	}
	
	
	
	# view progress notes on a contract
	function notes()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) {
			$data['contract'] = $this->_contract->details($data['d']);
			$data['list'] = $this->_contract->notes($data['d']);
		}
		
		if(empty($data['list'])) $data['msg'] = 'ERROR: No progress note can be resolved for this contract.';
		
		$this->load->view('contracts/notes', $data);
	}
	
	
	
	# add a note to a contract
	function add_note()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_POST)) {
			# Upload the file before you proceed with the rest of the process
			if(!empty($_FILES['document__fileurl'])) $fileUrl = upload_file($_FILES, 'document__fileurl', 'document_', 'pdf,doc,docx,jpeg,jpg,tiff');
			$_POST['document'] = !empty($fileUrl)? $fileUrl: "";
			$result = $this->_contract->add_note($_POST);
			
			# do not go away from the current list but show a message
			if(!$result['boolean']) echo "ERROR: The note could not be added. ".$result['reason'];
		}
		# a message area
		else if(!empty($data['a'])) {
			$data['msg'] = 'The note has been added. Click below to refresh the list.';
			$data['area'] = 'refresh_list_msg';
			$this->load->view('addons/basic_addons', $data);
		}
		else {
			$data['contract'] = $this->_contract->details($data['d']);
			$this->load->view('contracts/new_note', $data);
		}
	}

}

/* End of controller file */