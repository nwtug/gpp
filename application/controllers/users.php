<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls managing and viewing users.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/14/2015
 */
class Users extends CI_Controller 
{
	
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_user');
	}
	
	
	# user management list
	function index()
	{
		$data = filter_forwarded_data($this);
		
		$type = ($this->native_session->get('__user_type') == 'admin'? 'all': 'organization');
		$data['list'] = $this->_user->lists($type);
		
		$this->load->view('users/manage', $data);
	}
	
	
	
	
	
	
	# user list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, ($this->native_session->get('__user_type') == 'pde'? 'provider_':'').'users_list_actions', 'div');
	}
	
	
	
	
	# user permissions
	function permissions()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_user->permissions($data['g']);
		$this->load->view('users/permissions', $data);
	}
	
	
	
	
	# update user status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		$result = $this->_user->update_status($data['t'], explode('--', $data['list']));
		$data['msg'] = $result? 'The status for the selected users has been updated.': 'ERROR: The status for the selected users could not be updated.';
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	# View details of a provider
	function details()
	{
		$data = filter_forwarded_data($this);

		$data['row']=$this->_user->get_organization($this->uri->segment(4));
		
		$data['area'] = 'provider_details';
		$this->load->view('addons/basic_addons', $data);
	}

	

	
	
	
	
	
}

/* End of controller file */