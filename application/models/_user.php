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
	function lists($listType, $scope=array('group'=>'', 'status'=>'', 'phrase'=>'',  'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		if($listType == 'organization') {
			$scope['organization'] = $this->native_session->get('__organization_id');
			$scope['user_type'] = array('pde','provider');
		}
		
		return $this->_query_reader->get_list('get_user_list', array(
			'group_condition'=>(!empty($scope['group'])? " AND _permission_group_id='".$scope['group']."' ": ""),
			
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
		$result2 = $this->_query_reader->run('update_organization_status_by_user_ids', array('user_list'=>implode("','", $users), 'new_status'=>$organizationStatus)); 
		
		return $result1 && $result2;
	}
	


	# Recover a user password
	function recover_password($data)
	{
		$result = FALSE;
		$msg = '';
		
		$user = $this->_query_reader->get_row_as_array('search_user_list', array('phrase'=>$data['registeredemail'], 'limit_text'=>'LIMIT 1'));
		if(!empty($user)){
			# generate_temp_password is a helper function in common_functions_helper file
			$password = generate_temp_password();
			$result = $this->_query_reader->run('update_user_password', array('user_id'=>$user['user_id'], 'password'=>sha1($password) ));

			#if user's password was updated
			if($result){
				$result = $this->_messenger->send($user['user_id'], array('code'=>'password_recovery_notification', 'emailaddress'=>$data['registeredemail'], 'password'=>$password, 'directionlink'=>base_url().'account/login'), array('email'));
				if(!$result) $msg = "ERROR: The message with your temporary password could not be sent.";
			}
			else $msg = "ERROR: The password update failed.";
		}
		else $msg = "WARNING: There is no valid user with the given email address.";
		
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
	
	
	
	
	
	
	
	# send a message to the selected providers
	function message($data)
	{
		$results = array();
		$users = explode(',',$data['idlist']);
		$message = array('code'=>'custom_internal_message', 'subject'=>$data['reason__contactreason'], 'details'=>$data['details']);
		
		foreach($users AS $i=>$userId) $results[$i] = $this->_messenger->send($userId, $message, array('email'),TRUE);
		
		return array('boolean'=>get_decision($results));		
	}
	
	
	
	
	
	
	# update the permissions of the user by changing their group
	function update_permissions($data)
	{
		$userIds = explode(',',$data['idlist']);
		$result = $this->_query_reader->run('update_user_permission_group', array(
			'id_list'=>implode("','",$userIds), 
			'group_id'=>$data['user__permissiongroups']
		));
		
		return array('boolean'=>$result);
	}
	
	
	
}


?>