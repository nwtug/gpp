<?php
/**
 * This class generates and formats user details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 10/20/2015
 */
class _user extends CI_Model
{
	# list of users
	function lists($listType, $scope=array('phrase'=>'', 'user_type'=>'', 'organization'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		if($listType == 'organization') {
			$scope['organization'] = $this->native_session->get('__organization_id');
			$scope['user_type'] = array('pde','provider');
		}
		
		return $this->_query_reader->get_list('get_user_list', array(
			'type_condition'=>(!empty($scope['user_type'])? " HAVING ".(is_array($scope['user_type'])? "user_type IN ('".implode("','",$scope['user_type'])."')": "user_type='".$scope['user_type']."'"): ''),
			
			'organization_condition'=>(!empty($scope['organization'])? " AND _organization_id='".$scope['organization']."' ": ''),
			
			'phrase_condition'=>(!empty($scope['phrase'])? " AND (MATCH(first_name) AGAINST ('+\"".htmlentities($scope['phrase'], ENT_QUOTES)."\"') OR MATCH(last_name) AGAINST ('+\"".htmlentities($scope['phrase'], ENT_QUOTES)."\"'))": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	
	
	# permissions for user
	function permissions($groupId)
	{
		return $this->_query_reader->get_list('get_permissions_by_group_id', array('group_id'=>$groupId)); 
	}
	
	
	
	
	
	
	# update user status
	function update_status($action, $users)
	{
		if($action == 'activate') {
			$organizationStatus = $userStatus = 'active';
		} else if($action == 'deactivate') {
			$organizationStatus = $userStatus = 'inactive';
		} else if($action == 'suspend') {
			$organizationStatus = 'suspended';
			$userStatus = 'inactive';
		}
		$result1 = $this->_query_reader->run('update_user_status', array('user_list'=>implode("','", $users), 'new_status'=>$userStatus)); 
		$result2 = $this->_query_reader->run('update_organization_status', array('user_list'=>implode("','", $users), 'new_status'=>$organizationStatus)); 
		
		return $result1 && $result2;
	}
	


	# Recover a user password
	function recover_password($formData)
	{
		$result = false;
		$msg = '';

		if(is_valid_email($formData['registeredemail']))
		{
			# TODO Rogers (generate a query to cross reference the table: [users.email_address] against the provided email adddress
			$user = $this->_query_reader->get_row_as_array('get_user_by_email', array('email_address'=>$formData['registeredemail']));
			if(!empty($user))
			{
				$password = generate_temp_password();
				$result = $this->update_password($user['user_id'], $password);
				if($result)
				{
					$result = $this->_messenger->send($user['user_id'], array('code'=>'password_recovery_notification', 'emailaddress'=>$formData['registeredemail'], 'password'=>$password, 'login_link'=>base_url().'account/login'), array('email'));
					if(!$result) $msg = "ERROR: The message with your temporary password could not be sent.";
				}
				else $msg = "ERROR: The password update failed.";
			}
			else $msg = "WARNING: There is no valid user with the given email address.";
		}
		else $msg = "WARNING: Please enter a valid email address.";

		return array('boolean'=>$result, 'msg'=>$msg);
	}
	
	
	
	
	
	
	# get user details
	function details($id='')
	{
		return $this->_query_reader->get_row_as_array('get_user_by_id', array(
				'user_id'=>(!empty($id)? $id: $this->native_session->get('__user_id')) 
			));
	}
	
	
	
	
	
	
	# save user settings
	function settings($data)
	{
		# a) save the main record
		$result = $this->_query_reader->run('update_user_settings', array(
				'photo_url'=>$data['photo_url'], 
				'password'=>((!empty($data['newpassword']) && !empty($data['confirmpassword']))? sha1($data['newpassword']): ''), 
				'email_address'=>$data['emailaddress'],
				'telephone'=>$data['telephone'],
				'secret_question_id'=>$data['question__secretquestions'], 
				'secret_answer'=>$data['secretanswer'], 
				'address_line_1'=>$data['address'], 
				'city'=>$data['city'], 
				'state'=>$data['region'], 
				'zipcode'=>$data['zipcode'], 
				'country'=>$data['contact__countries'], 
				'user_id'=>$this->native_session->get('__user_id')
			));
		
		# d) log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'updated_user_settings', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"emailaddress=".$data['emailaddress']."|device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>'');
	}
	
	
	
	

}


?>