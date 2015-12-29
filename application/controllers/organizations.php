<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing organizations pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/26/2015
 */
class Organizations extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_organization');
	}
	
	
	
	
	# organization settings
	function settings()
	{
		$data = filter_forwarded_data($this);
		logout_invalid_user($this);
		
		# user has posted the organization settings
		if(!empty($_POST)){
			# Upload the logo if any exists before you proceed with the rest of the process
			$_POST['logo_url'] = !empty($_FILES)? upload_file($_FILES, 'newlogo__fileurl', 'logo_'.$this->native_session->get('__organization_id').'_', 'png,jpg,jpeg,tiff'): '';
			$result = $this->_organization->settings($_POST);
			
			if($result['boolean']) $this->native_session->set('msg', 'Your organization settings have been updated');
			else echo "ERROR: The settings could not be updated. ".$result['reason'];
		} 
		# just viewing the form
		else {
			$data['organization'] = $this->_organization->details();
			$this->load->view('organizations/settings', $data);
		}
	}
}

/* End of controller file */