<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing forums pages. [Renamed from FAQs]
 *
 * @author David Buwembo <dbuwembo@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/2/2015
 */
class Forums extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_forum');
	}
	
	
	
	# faqs home page
	function index()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['a'])) $data['area'] = $data['a'];
		$data['publicForumsList'] = array();
		
		$this->load->view('forums/home', $data);
	}
	
	
	
	# forums lists
	function forums_list()
	{
		$data = filter_forwarded_data($this);
		
		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();
		
		$this->load->view('forums/details_list', $data);
	}
	
	
	

	
	# manage home page
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_forum->lists();
		
		$this->load->view('forums/manage', $data);
	}
	
	
	
	
	# add a forum
	function add()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_POST)){
			# Upload the document if any exists before you proceed with the rest of the process
			$_POST['document'] = !empty($_FILES)? upload_file($_FILES, 'document__fileurl', 'document_', 'pdf,doc,docx,jpeg,jpg,png,tiff'): '';
			$result = $this->_forum->add($_POST);
			
			if($result['boolean']) $this->native_session->set('msg', 'The forum has been added');
			else echo "ERROR: The forum data could not be added. ".$result['reason'];
			
		} else {
			if(!empty($data['d'])) $data['forum'] = $this->_forum->details($data['d']);
			$this->load->view('forums/new_forum', $data);
		}
	}
	
	
	
	
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'forum_list_actions', 'div');
	}
	
	
	
	
	
	# update a forum's status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $result = $this->_forum->update_status($data['t'], explode('--',$data['list']));
		
		$data['msg'] = (!empty($result['boolean']) && $result['boolean'])? (!empty($data['t']) && $data['t'] == 'delete'? 'The forum has been deleted.': 'The forum status has been changed.'): 'ERROR: The forum status could not be changed.';
		
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	
	# filter forum list
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('forums/list_filter', $data);
	}
	
	
	
	
	
	
	# view one forum
	function view_one()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) $data['forum'] = $this->_forum->details($data['d']);
		if(empty($data['forum'])) $data['msg'] = 'ERROR: The forum details can not be resolved';
		
		$this->load->view('forums/forum_details', $data);
	}
	

	
}

/* End of controller file */