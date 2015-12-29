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
		logout_invalid_user($this);
		
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
	
	
	

	
	
	# user settings
	function settings()
	{
		$data = filter_forwarded_data($this);
		logout_invalid_user($this);
		
		# user has posted the settings form
		if(!empty($_POST)){
			# Upload the photo if any exists before you proceed with the rest of the process
			$_POST['photo_url'] = !empty($_FILES)? upload_file($_FILES, 'newphoto__fileurl', 'photo_'.$this->native_session->get('__user_id').'_', 'png,jpg,jpeg,tiff'): '';
			$result = $this->_user->settings($_POST);
			
			if($result['boolean']) $this->native_session->set('msg', 'Your settings have been updated');
			else echo "ERROR: The settings could not be updated. ".$result['reason'];
		} 
		# just viewing the form
		else {
			$data['user'] = $this->_user->details();
			$this->load->view('users/settings', $data);
		}
	}
	
	
	
	
	# get user details
	function details()
	{
		$data = filter_forwarded_data($this);
		$data['user'] = $this->_user->details($data['d']);
		$this->load->view('users/user_details', $data);
	}
	
	
	
	# filter users
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('users/list_filter', $data);
	}
	
	
	
	# update the user permission group
	function update_permissions()
	{
		$data = filter_forwarded_data($this);
		logout_invalid_user($this);
		
		# user has posted
		if(!empty($_POST)){
			$response = $this->_user->update_permissions($_POST);
			# there was an error
			if(!(!empty($response) && $response['boolean'])) echo 'ERROR: There was an error updating the user permission group.';
		} 
		# success
		else if(!empty($data['result'])){
			$data['msg'] = 'The user permission group has been updated';
			$data['area'] = 'refresh_list_msg';
			$this->load->view('addons/basic_addons', $data);
		}
		else {
			$data['id_list'] = !empty($data['list'])? implode(',',explode('--',$data['list'])): '';
			$this->load->view('users/update_permissions', $data);
		}
	}
	
	
	
	
	# send a message to a list of selected users
	function message()
	{
		$data = filter_forwarded_data($this);
		
		# user has posted
		if(!empty($_POST)){
			$response = $this->_user->message($_POST);
			# there was an error
			if(!(!empty($response) && $response['boolean'])) echo 'ERROR: There was an error sending to the selected users.';
		} 
		# success
		else if(!empty($data['result'])){
			$data['msg'] = 'The messages have been sent.';
			$data['area'] = 'refresh_list_msg';
			$this->load->view('addons/basic_addons', $data);
		}
		
		# simply going to a form to send message
		else {
			$data['action'] = 'users/message';
			$data['redirect'] = 'users/message/result/sent';
			$data['id_list'] = implode(',',explode('--',$data['list']));
			$this->load->view('pages/send_from_list', $data);
		}
	}
	
	
}

/* End of controller file */