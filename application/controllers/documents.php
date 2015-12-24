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
	
	
	
	
	# resources home page
	function index()
	{
		$data = filter_forwarded_data($this);
		$data['area'] = !empty($data['a'])? $data['a']: 'documents';
		$this->native_session->delete('__view');
		
		$data['list'] = $this->get_list_to_show($data['area']);
		$data['folder'] = $this->get_section_folder($data['area']);
		$this->load->view('documents/home', $data);
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
	
	
	
	
	
	# documents lists
	function document_list()
	{
		$data = filter_forwarded_data($this);
		$data['area'] = !empty($data['t'])? $data['t']: 'documents';
		$data['list'] = $this->get_list_to_show($data['area']);
		
		$this->load->view($this->get_section_folder($data['area']).'/details_list', $data);
	}
	
	
	
	
	
	# determine which list to show for the view
	function get_list_to_show($area)
	{
        $this->load->model('_document');
        $this->load->model('_link');
        $this->load->model('_training');
		$list = array();
		
		if($area == 'documents') $list = $this->_document->lists('system');
		else if($area == 'standards') $list = $this->_document->lists('standard');
		else if($area == 'important_links') $list = $this->_link->lists();
		else if($area == 'training_activities') $list = $this->_training->lists();
		
		return $list;
	}
	
	
	
	# get section folder
	function get_section_folder($section)
	{
		$folder = '';
		if($section == 'documents') $folder = 'documents';
		else if($section == 'important_links') $folder = 'links';
		else if($section == 'standards') $folder = 'documents';
		else if($section == 'training_activities') $folder = 'training';
		
		return $folder;
	}
	
	
	
	
	
	
	
	# Filter home resources
	function home_filter()
	{
		$data = filter_forwarded_data($this);
		$data['area'] = !empty($data['t'])? $data['t']: 'documents';
		
		if(in_array($data['area'], array('standards','documents'))) {
			$data['listtype'] = ($data['area'] == 'standards')? 'standard': 'system';
		}
		
		$this->load->view($this->get_section_folder($data['area']).'/list_filter', $data);
	}
	
	
	
}

/* End of controller file */