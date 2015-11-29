<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing permissions pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/26/2015
 */
class Permissions extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_permission');
	}
	
	
	
	# to manage permission groups
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_permission->lists();
		
		$this->load->view('permissions/manage', $data);
	}
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'permission_list_actions', 'div');
	}
	
	
	
	# filter list
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('permissions/list_filter', $data);
	}
	
	
	
	# add a permission
	function add()
	{
		$data = filter_forwarded_data($this);
		
		# user has posted the permission form
		if(!empty($_POST)){
			$result = $this->_permission->add($_POST);
			if(!$result['boolean']) echo "ERROR: The permission group could not be added. ".$result['reason'];
		} 
		# just viewing the form
		else {
			if(!empty($data['d'])) $data['group'] = $this->_permission->details($data['d']);
			$data['permissions'] = $this->_permission->system_permissions();
			$this->load->view('permissions/new_group', $data);
		}
	}
	
	
	
	
	
	# update a permission group status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $result = $this->_permission->update_status($data['t'], explode('--',$data['list']));
		
		$data['msg'] = (!empty($result['boolean']) && $result['boolean'])? (!empty($data['t']) && $data['t'] == 'delete'? 'The group has been deleted.': 'The group status has been changed.'): 'ERROR: The group status could not be changed.';
		
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	
	# view the list of group permissions
	function group_permissions()
	{
		$data = filter_forwarded_data($this);
		if(!empty($data['d'])) $data['list'] = $this->_permission->group_permissions($data['d']);
		if(empty($data['list'])) $data['msg'] = 'ERROR: No permissions could be resolved for this group.';
		
		$this->load->view('permissions/group_permissions', $data);
	}
	
	
	
	
	
	
}

/* End of controller file */