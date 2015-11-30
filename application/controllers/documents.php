<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing documents pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/24/2015
 */
class Documents extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_document');
	}
	
	# manage home page
	function manage()
	{
		$data = filter_forwarded_data($this);
		
		$data['area'] = !empty($data['a'])? $data['a']: 'system';
		$data['list'] = $this->_document->lists($data['area']);
		
		$this->load->view('documents/manage', $data);
	}
	
	
	
	
	# add a document
	function add()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_POST)){
			# Upload the file before you proceed with the rest of the process
			$fileUrl = upload_file($_FILES, 'document__fileurl', 'document_', 'pdf,doc,docx');
			if(!empty($fileUrl)) {
				$_POST['document'] = $fileUrl;
				$result = $this->_document->add($_POST);
			}
			else $result = array('boolean'=>FALSE, 'reason'=>'File could not be uploaded.');
			
			if(!$result['boolean']) echo "ERROR: The document could not be added. ".$result['reason'];
		} else {
			$data['area'] = !empty($data['a'])? $data['a']: 'system';
			$this->load->view('documents/new_document', $data);
		}
	}
	
	
	
	
	# view a document description
	function description()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) $data['details'] = $this->_document->details($data['d']);
		if(empty($data['details'])) $data['msg'] = 'ERROR: The document details could not be resolved.';
		
		$this->load->view('documents/description', $data);
	}
	
	
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'document_list_actions', 'div');
	}
	
	
	
	
	
	# update a document's status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $result = $this->_document->update_status($data['t'], explode('--',$data['list']));
		
		$data['msg'] = (!empty($result['boolean']) && $result['boolean'])? (!empty($data['t']) && $data['t'] == 'delete'? 'The document has been deleted.': 'The document status has been changed.'): 'ERROR: The document status could not be changed.';
		
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	
	# filter document list
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('documents/list_filter', $data);
	}
	
	
	
	
	
}

/* End of controller file */