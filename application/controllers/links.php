<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing links pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/24/2015
 */
class Links extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_link');
	}
	
	# manage home page
	function manage()
	{
		$data = filter_forwarded_data($this);
		logout_invalid_user($this);
		$data['list'] = $this->_link->lists();
		
		$this->load->view('links/manage', $data);
	}
	
	
	
	
	# add a link
	function add()
	{
		$data = filter_forwarded_data($this);
		logout_invalid_user($this);
		
		if(!empty($_POST)){
			$result = $this->_link->add($_POST);
			if(!$result['boolean']) echo "ERROR: The link could not be added. ".$result['reason'];
		} else {
			$this->load->view('links/new_link', $data);
		}
	}
	
	
	
	
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'link_list_actions', 'div');
	}
	
	
	
	
	
	# update a link's status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $result = $this->_link->update_status($data['t'], explode('--',$data['list']));
		
		$data['msg'] = (!empty($result['boolean']) && $result['boolean'])? (!empty($data['t']) && $data['t'] == 'delete'? 'The link has been deleted.': 'The link status has been changed.'): 'ERROR: The link status could not be changed.';
		
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	
	# filter link list
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('links/list_filter', $data);
	}
	
	
	
	
	
}

/* End of controller file */