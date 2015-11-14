<?php
/**
 * This class generates and formats account details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 07/30/2015
 */
class _account extends CI_Model
{
	
	# Verify a new user's account
	public function verify($code)
	{
		$user = $this->_query_reader->get_row_as_array('get_user_by_id', array('user_id'=>extract_id($code) ));
		# Mark the email and account as verified
		if(!empty($user['id'])) {
			$result = $this->_query_reader->run('update_user_value', array('field_name'=>'email_verified', 'field_value'=>'Y', 'user_id'=>$user['id']));
			if($result) $result = $this->_query_reader->run('update_user_field', array('user_id'=>$user['id'], 'field_name'=>'user_status', 'field_value'=>'active'));
		}
		
		return array('verified'=>(!empty($result) && $result? 'Y': 'N'));
	}
	
	
	
	
	# Check if the user name is available
	public function valid_user_name($desiredUserName)
	{
		return array('is_valid'=>($this->_query_reader->get_count('check_user_name', array('user_name'=>htmlentities($desiredUserName, ENT_QUOTES) )) > 0? 'N': 'Y'));
	}
	
	
	
	
	# Resend an account verification link
	public function resend_link($emailAddress, $userId, $baseLink)
	{
		$result = $this->_messenger->send($userId, array(
				'code'=>'account_verification_link',
				'emailaddress'=>$emailAddress,
				'verificationlink'=>$baseLink.'u/'.format_id($userId)
			),
			array('system', 'email'), 
			TRUE);
		return array('result'=>($result? 'SUCCESS': 'FAIL'));
	}
	
	
	
	
	# Login into the system
	public function login($userName, $password, $details=array())
	{
		$response = array('result'=>'FAIL', 'default_view'=>'', 'user_details'=>array(), 'permissions'=>array());
		
		# Check whether the userName and password match for the user - and get their user id
		$iam = $this->_query_reader->get_row_as_array('get_user_by_name_and_pass', array('login_name'=>$userName, 'login_password'=>sha1($password) ));
		
		# Get the user details if they exist
		if(!empty($iam['user_id'])) $user = $this->_query_reader->get_row_as_array('get_user_by_id', array('user_id'=>$iam['user_id']));
			
		# Collect the rest of the user details if login is successful
		if(!empty($user))
		{
			$response['result'] = 'SUCCESS';
			
			# Default view on login
			$response['default_view'] = $this->get_default_view($user['group_type']);
			
			# User details
			$response['user_details'] = array(
					'user_id'=>$user['id'], 
					'first_name'=>$user['first_name'], 
					'last_name'=>$user['last_name'], 
					'email_address'=>$user['email_address'], 
					'email_verified'=>$user['email_verified'],  
					'telephone'=>$user['telephone'],  
					'telephone_carrier'=>(!empty($user['telephone_carrier'])? $user['telephone_carrier']: ''),
					'photo_url'=>(!empty($user['photo_url'])? BASE_URL.'assets/uploads/'.$user['photo_url']: '')
			);
			
			# The allowed permissions for the user
			$response['permissions'] = $this->_query_reader->get_single_column_as_array('get_user_permissions', 'permission_code', array('user_id'=>$user['id']));
		}
		
		# Log the login attempt event
		$this->_logger->add_event(array(
			'user_id'=>(!empty($user['id'])? $user['id']: 'username='.$userName), 
			'activity_code'=>'login', 
			'result'=>(!empty($user['id'])? 'SUCCESS':'FAIL'), 
			'log_details'=>"username=".$userName."|device=".(!empty($details['device'])? $details['device']: 'unknown')."|browser=".(!empty($details['browser'])? $details['browser']: 'unknown'),
			'uri'=>(!empty($details['uri'])? $details['uri']: ''),
			'ip_address'=>(!empty($details['ip_address'])? $details['ip_address']: '')
		));
		
		
		return $response;
	}
	
	
	
	
	
	
	# Logout of the system
	public function logout($userId, $details=array())
	{
		# Log the logout attempt event
		$this->_logger->add_event(array(
			'user_id'=>(!empty($userId)? $userId: ''), 
			'activity_code'=>'logout', 
			'result'=>'SUCCESS', 
			'log_details'=>"device=".(!empty($details['device'])? $details['device']: 'unknown')."|browser=".(!empty($details['browser'])? $details['browser']: 'unknown'),
			'uri'=>(!empty($details['uri'])? $details['uri']: ''),
			'ip_address'=>(!empty($details['ip_address'])? $details['ip_address']: '')
		));
	}
	
	
	
	# Get the default view to redirect the user on login
	function get_default_view($groupType)
	{
		$view = '';
		if(!empty($groupType)){
			switch($groupType){
				case 'admin':
					$view = 'account/admin_dashboard';
				break;
				
				case 'government_agency':
					$view = 'account/government_dashboard';
				break;
				
				case 'pde':
					$view = 'account/pde_dashboard';
				break;
				
				default:
					$view = 'account/provider_dashboard';
				break;
			}
		}
		
		return $view;
	}
	
	
	
	
	# Function to send a password recovery link
	function send_password_link($emailAddress, $baseLink)
	{
		$msg = '';
		$user = $this->_query_reader->get_row_as_array('get_user_by_email',array('email_address'=>$emailAddress));
		
		if(!empty($user['user_id'])){
			#Generate a temporary password that the user has to update and make it the temp password
			$password = 'TEMP-'.strtoupper(chr(97 + mt_rand(0, 25))).'-'.$user['user_id'];
			$sendResult = $this->_messenger->send($user['user_id'], array(
				'code'=>'password_recovery_link', 
				'securityemail'=>SECURITY_EMAIL, 
				'recoverylink'=>$baseLink.'p/'.encrypt_value($password) 
			));
		}
		else $msg = 'The user with the entered email address does not exist.';
		
		return array('result'=>(!empty($sendResult) && $sendResult? 'SUCCESS': 'FAIL'), 'msg'=>$msg);
	}
	
	
	
	
	# Function to reset the user's password
	function reset_password($userId, $tempPassword, $newPassword)
	{
		# Simply checking if this link is still valid
		if(!empty($tempPassword)){
			$realPass = decrypt_value($tempPassword);
			$realUserId = substr($realPass, strrpos($realPass, '-') + 1);
			if(!empty($realUserId)) $user = $this->_query_reader->get_row_as_array('get_user_by_id', array('user_id'=>$realUserId));
			
			return array('result'=>(!empty($user)? 'verified': 'failed'), 'user_id'=>(!empty($user)? $realUserId: ''));
		}
		
		# actually changing the password
		else {
			if(!empty($newPassword) && !empty($userId)){
				$result = post_to_url(IAM_URL,  array(
					'__action'=>'update_user_password', 
					'userId'=>$userId,
					'password'=>decrypt_value($newPassword)
				));
				
				if(!empty($result['result']) && $result['result']=='SUCCESS') $sendResult = $this->_messenger->send($userId, array('code'=>'password_has_changed', 'securityemail'=>SECURITY_EMAIL));
			}
			
			
			return array('result'=>(!empty($result['result']) && $result['result']=='SUCCESS')? 'SUCCESS': 'FAIL');
		}
	}
	
	
	
	# Get a list of accounts of a given type
	function types($type, $restrictions=array())
	{
		return $this->_query_reader->get_single_column_as_array('get_accounts_of_type', '_user_id', array('account_type'=>$type));
	}
	
	
	
	
	
	# Save account details based on registration steps
	function save($data, $step)
	{
		if($step == 'step_2') return $this->register_step_2($data);
		else if($step == 'step_3') return $this->register_step_3($data);	
	}
	
	
	
	# Save details of registration step 2
	function register_step_2($data)
	{
		$message = '';
		
		# Save a temporary user
		$details1['email_address'] = $data['emailaddress'];
		$details1['telephone'] = $data['telephone'];
		$details1['country'] = $data['registration__countries'];
		$details1['user_name'] = trim($data['newusername']);
		$details1['password'] = sha1($data['newpassword']);
		$details1['secret_question_id'] = $data['question__secretquestions'];
		$details1['secret_answer'] = htmlentities($data['secretanswer'], ENT_QUOTES);
		$userId = $this->_query_reader->add_data('save_temp_user', $details1);
		
		# Create a temporary organization if a temporary user has been saved
		if(!empty($userId)){
			$details2['name'] = htmlentities($data['businessname'], ENT_QUOTES);
			$details2['description'] = htmlentities($data['description'], ENT_QUOTES); 
			$details2['registration_country_id'] = $data['registration__countries'];
			$details2['registration_number'] = (!empty($data['registrationno'])? $data['registrationno']: '');
			$details2['tax_id'] = (!empty($data['taxid'])? $data['taxid']: '');
			$details2['category_id'] = ($data['organizationtype'] == 'provider'? $data['category__businesscategories']: '');
			$details2['ministry_id'] = ($data['organizationtype'] == 'pde'? $data['category__businesscategories']: '');
			$details2['user_id'] = $userId;
			$organizationId = $this->_query_reader->add_data('save_temp_organization', $details2);
		}
		else $message = 'Your account details could not be saved.';
		
		# Then send an email with a verification link for confirmation of contact email
		# Do NOT resend email if user reached this step already
		if(!empty($organizationId) && $this->native_session->get('__step') < 2){
			$message['code'] = 'account_verification_code';
			$message['verificationcode'] = format_id($userId);
			$message['emailaddress'] = $data['emailaddress'];
			$message['telephone'] = $data['telephone'];
			$message['username'] = $data['newusername'];
			$message['businessname'] = htmlentities($data['businessname'], ENT_QUOTES);
			
			$result = $this->_messenger->send_direct_email($data['emailaddress'], '', $message);
			if(!$result) {
				$message = 'Your account verification code could not be sent.';
				$results[0] = $this->_query_reader->run('remove_temp_user', array('user_id'=>$userId));
				$results[1] = $this->_query_reader->run('remove_temp_organization', array('organization_id'=>$organizationId));
			}
			else {
				$this->native_session->set('__user_id', $userId);
				$this->native_session->set('__organization_id', $organizationId);
				$this->native_session->set('__user_name', $details1['user_name']);
			}
		}
		
		# The user is just saving this step to continue (they passed this step before)
		else if($this->native_session->get('__step') > 1){
			$result = TRUE;
		}
		
		# The user could just not proceed
		else if($this->native_session->get('__step') < 2){
			$message = 'Your account organization could not be saved.';
			$results[0] = $this->_query_reader->run('remove_temp_user', array('user_id'=>$userId));
		}
		
		return array('result'=>(!empty($result) && $result? 'SUCCESS': 'FAIL'), 'reason'=>$message);
	}
	
	
	
	# Save details of registration step 3
	function register_step_3($data)
	{
		$message = '';
		# Proceed only if the verification code matches a registered user
		$user = $this->_query_reader->get_row_as_array('get_user_by_id', array('user_id'=>extract_id($data['confirmationcode'])));
		if(!empty($user['user_name']) && $user['user_name'] == $this->native_session->get('__user_name')) 
		{
			# Update the user's organization contact 
			$result = $this->_query_reader->run('update_organization_contact', array(
				'organization_id'=>$this->native_session->get('__organization_id'),
				'contact_address'=>htmlentities($data['address'], ENT_QUOTES),
				'contact_city'=>htmlentities($data['city'], ENT_QUOTES),
				'contact_region'=>htmlentities($data['region'], ENT_QUOTES),
				'contact_zipcode'=>$data['zipcode'],
				'contact_country_id'=>$data['contact__countries'],
			));
			
			# Activate user
			if($result) {
				$result = $this->_query_reader->run('activate_user_account', array(
					'first_name'=>htmlentities($data['firstname'], ENT_QUOTES),
					'last_name'=>htmlentities($data['lastname'], ENT_QUOTES),
					'user_id'=>$this->native_session->get('__user_id'),
					'organization_id'=>$this->native_session->get('__organization_id'),
					'organization_type'=>$this->native_session->get('organizationtype') 
				));
				
				if(!$result) $message = 'Your saved account could not be activated.';
			}
			else $message = 'The organization contact could not be saved.';
		}
		else $message = 'Your code could not be verified.';
		
		return array('result'=>(!empty($result) && $result? 'SUCCESS': 'FAIL'), 'reason'=>$message);
	}
	
	
	
}


?>