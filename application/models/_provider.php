<?php
/**
 * This class generates and formats provider details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class _provider extends CI_Model
{
	# list of providers
	function lists($scope=array('phrase'=>'', 'registration_country'=>'', 'category'=>'', 'ministry'=>'', 'status'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_provider_list', array(
			'category_condition'=>(!empty($scope['category'])? " AND _category_id='".$scope['category']."' ": ''),
			
			'ministry_condition'=>(!empty($scope['ministry'])? " AND _ministry_id='".$scope['ministry']."' ": ''),
			
			'country_condition'=>(!empty($scope['category'])? " AND _registration_country_id='".$scope['registration_country']."' ": ''),
			'phrase_condition'=>(!empty($scope['phrase'])? " AND MATCH(name) AGAINST ('+\"".htmlentities($scope['phrase'], ENT_QUOTES)."\"')": ''),
			
			'status_condition'=>(!empty($scope['status'])? " AND status='".$scope['status']."'": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	
	
	# update the status of a provider
	function update_status($newStatus, $idList)
	{
		$result = FALSE;
		# use appropriate DB status
		$organizationStatus = array('activate'=>'active', 'deactivate'=>'inactive', 'suspend'=>'suspended');
		$userStatus = array('activate'=>'active', 'deactivate'=>'inactive', 'suspend'=>'inactive');
		
		if(!empty($organizationStatus[$newStatus])) {
			$result = $this->_query_reader->run('update_organization_status', array(
				'new_status'=>$organizationStatus[$newStatus], 
				'id_list'=>implode("','",$idList), 
				'user_id'=>$this->native_session->get('__user_id') ));
		}
		
		if(!empty($userStatus[$newStatus]) && $result) {
			$result = $this->_query_reader->run('update_user_status_by_organization_ids', array(
				'new_status'=>$userStatus[$newStatus], 
				'id_list'=>implode("','",$idList), 
				'user_id'=>$this->native_session->get('__user_id') 
			));
		}
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'update_provider_status', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result);
	}
	
	
	
	
	# send a message to the selected providers
	function message($data)
	{
		$sent = $notSent = array();
		$users = $this->_query_reader->get_list('get_users_in_organizations',array('organization_ids'=>implode("','",explode(',',$data['idlist'])) ));
		$message = array('code'=>'custom_internal_message', 'subject'=>$data['subject'], 'details'=>$data['details']);
		
		foreach($users AS $row) {
			$result = $this->_messenger->send($row['user_id'], $message, array('email'),TRUE);
			if($result) array_push($sent, $row['email_address']);
			else array_push($notSent, $row['email_address']);
		}
		
		return array('boolean'=>!(empty($sent) && !empty($notSent)), 'not_sent'=>$notSent);		
	}
	
	
	
	
	
}


?>