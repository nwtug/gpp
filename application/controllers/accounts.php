<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing account pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 10/30/2015
 */
class Accounts extends CI_Controller
{

	#Constructor to set some default values at class load
	public function __construct()
	{
		parent::__construct();
		$this->load->model('_account');
	}


	# Register a user account
	function register()
	{
		$data = filter_forwarded_data($this);

		# STEP 1 - post
		if(!empty($_POST['organization__organizationtypes'])){
			# marks which step has been reached
			if(!$this->native_session->get('organizationtype'))$this->native_session->set('__step',1);

			$this->native_session->set('organizationtype', $_POST['organization__organizationtypes']);
		}

		# STEP 2 - post
		else if(!empty($_POST['businessname'])){
			$check = $this->native_session->get('check_numbers');
			if($_POST['checkanswer'] == ($check['left'] + $check['right']))
			{
				$response = $this->_account->save($_POST, 'step_2');
				# Completed step 2 for the first time
				if($response['result'] == 'SUCCESS' && !$this->native_session->get('businessname')) {
					$this->native_session->set('__step',2);
				}
				add_to_user_session($this, $_POST, '', array('newpassword', 'confirmpassword', 'secretanswer', 'checkanswer'));
			}
			else $response['reason'] = 'The sum you provided does not match the expected answer.';

			if(!(!empty($response) && $response['result'] == 'SUCCESS')) echo "ERROR: Your application could not be saved. ".$response['reason'];
		}

		# STEP 3 - post
		else if(!empty($_POST['confirmationcode'])){
			$response = $this->_account->save($_POST, 'step_3');
			# Completed step 3 for the first time
			if($response['result'] == 'SUCCESS' && !$this->native_session->get('address')) {
				$this->native_session->set('__step',3);
			}
			add_to_user_session($this, $_POST, '', array('confirmationcode'));

			if(!(!empty($response) && $response['result'] == 'SUCCESS')) echo "ERROR: Your application could not be saved. ".$response['reason'];
		}

		# DEFAULT - Just viewing the form
		else {
			# Step two requires pre-generating an image to check if its a valid user submitting the form
			if(!empty($data['step']) && $data['step'] == '2'){
				if(empty(session_id())) @session_start();
				$now = strtotime('now');
				$numbers = substr($now, -3);
				$checks = array('left'=>substr($numbers, 0,1), 'right'=>substr($numbers, -1));
				$this->native_session->set('check_numbers',$checks);
				$text = $checks['left'].' + '.$checks['right'];
				create_image_from_text(session_id().'.png', $text);
			}


			$this->load->view('accounts/register_step_'.(!empty($data['step'])? $data['step']: '1'), $data);
		}
	}


	# Account explanation
	function type_explanation()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('accounts/type_explanation', $data);
	}



	# login
	function login()
	{
		$data = filter_forwarded_data($this);

		# The user wants to proceed to login
		if(!empty($_POST)){
			if(!empty($_POST['verified'])){
				$response = $this->_account->login($_POST['loginusername'], $_POST['loginpassword'], array(
						'uri'=>uri_string(),
						'ip_address'=>get_ip_address(),
						'device'=>get_user_device(),
						'browser'=>$this->agent->browser()
				));

				# Proceed based on the login response from the API
				if(!empty($response['result']) && $response['result'] == 'SUCCESS' && !empty($response['default_view'])) {
					add_to_user_session($this, $response['user_details']);
					$this->native_session->set('__default_view', $response['default_view']);
					if(!empty($response['permissions'])) $this->native_session->set('__permissions', $response['permissions']);
					if(!empty($response['default_view']) && !empty($response['permissions'])) redirect(base_url().$response['default_view']);
					else $data['msg'] = "ERROR: No permissions could be resolved for your account.";
				}
				else $data['msg'] = "ERROR: The user name and password do not match a registered user. Please check and try again.";
			}
			else $data['msg'] = "ERROR: Your login could not be verified.";
		}

		$this->load->view('accounts/login', $data);
	}



	# The admin dashboard
	function admin_dashboard()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_account->audit_trail();
		$this->load->view('accounts/admin_dashboard', $data);
	}


	# The pde dashboard
	function pde_dashboard()
	{
		$data = filter_forwarded_data($this);
		$this->load->model('_report');
		$data['list'] = $this->_report->stats('pde');
		$this->load->view('accounts/pde_dashboard', $data);
	}


	# The provider dashboard
	function provider_dashboard()
	{
		$data = filter_forwarded_data($this);
		$this->load->model('_tender');
		$data['list'] = $this->_tender->lists();
		$this->load->view('accounts/provider_dashboard', $data);
	}



	# logout
	function logout()
	{
		$data = filter_forwarded_data($this);
		#Log sign-out event
		$userId = $this->native_session->get('__user_id')? $this->native_session->get('__user_id'): "";
		$email = $this->native_session->get('__email_address')? $this->native_session->get('__email_address'): "";
		$this->_logger->add_event(array('user_id'=>$userId, 'activity_code'=>'user_logout', 'result'=>'success', 'log_details'=>"userid=".$userId."|email=".$email ));

		# Set appropriate message - reason for log out.
		$data['msg'] = $this->native_session->get('msg')? get_session_msg($this): "You have been logged out.";

		#Remove any set session variables
		$this->native_session->delete_all();
		$this->load->view('accounts/login', $data);
	}


	# Forgot Password
	function forgot()
	{
		$data = filter_forwarded_data($this);  # if form is submitted

		if(!empty($_POST)) {

			$this->load->model('_user');
			$result = $this->_user->recover_password($_POST);
			$data['msg'] = $result['boolean']? 'A temporary password has been generated and <br>sent to your registered email and phone. <br><br>Use it to login and change it immediately on your <br>profile page for your security.': $result['msg'];

			$data['area'] = 'basic_msg';
			$this->load->view('addons/basic_addons', $data);

		}
		else
			$this->load->view('accounts/recover_password', $data);
	}


	# Check provider user name
	function check_user_name()
	{
		$data = filter_forwarded_data($this);
		if(!empty($_POST['user_name'])){
			$check = $this->_account->valid_user_name($_POST['user_name']);
			echo !empty($check['is_valid']) && $check['is_valid'] == 'Y'? 'VALID': 'INVALID';
		}
	}






	# Filter audit form
	function audit_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('accounts/audit_filter', $data);
	}




	# View organization details
	function view_pde()
	{
		$data = filter_forwarded_data($this);

		if(!empty($data['d'])) $data['organization'] = $this->_account->details($data['d'], 'pde');
		if(empty($data['organization'])) $data['msg'] = 'ERROR: The PDE details could not be resolved.';

		$data['type'] = 'pde';

		$this->load->view('accounts/organization_details', $data);
	}




	# View provider details
	function view_provider()
	{
		$data = filter_forwarded_data($this);

		if(!empty($data['d'])) $data['organization'] = $this->_account->details($data['d'], 'provider');
		if(empty($data['organization'])) $data['msg'] = 'ERROR: The provider details could not be resolved.';

		$data['type'] = 'provider';

		$this->load->view('accounts/organization_details', $data);
	}


}

/* End of controller file */