<?php
/**
 * This class generates and formats permission details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/26/2015
 */
class _permission extends CI_Model
{
	# list of permission groups
	function lists($scope=array('phrase'=>'', 'type'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_permission_group_list', array(
			'type_condition'=>(!empty($scope['type'])? " AND type='".$scope['type']."' ": ''),
			'phrase_condition'=>(!empty($scope['phrase'])? " AND name LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	# add a permission group
	function add($data)
	{
		$result = FALSE;
		$reason = '';
		
		# make sure there are permissions selected
		if($data['permissions']){
			# updating..
			if(!empty($data['groupid'])){
				$result = $this->_query_reader->run('update_group_details', array(
					'group_id'=>$data['groupid'],
					'name'=>htmlentities($data['name'], ENT_QUOTES), 
					'type'=>$data['group__grouptypes'],
					'notes'=>htmlentities($data['notes'], ENT_QUOTES), 
					'default_permission'=>$data['permissions'][0],
					'user_id'=>$this->native_session->get('__user_id')
				));
				
				# now update the gorup permissions list
				if($result) $result = $this->_query_reader->run('remove_group_permissions', array('group_id'=>$data['groupid']));
				if($result) {
					$result = $this->_query_reader->add_data('add_group_permissions', array(
						'group_id'=>$data['groupid'], 
						'permission_ids'=>implode("','",$data['permissions']),
						'user_id'=>$this->native_session->get('__user_id')
					));
				}
			} 
			# adding new..
			else {
				$groupId = $this->_query_reader->add_data('add_permission_group', array(
					'name'=>htmlentities($data['name'], ENT_QUOTES), 
					'notes'=>htmlentities($data['notes'], ENT_QUOTES),
					'type'=>$data['group__grouptypes'],
					'default_permission'=>$data['permissions'][0],
					'user_id'=>$this->native_session->get('__user_id')
				));
				
				if(!empty($groupId)){
					$result = $this->_query_reader->add_data('add_group_permissions', array(
						'group_id'=>$groupId, 
						'permission_ids'=>implode("','",$data['permissions']),
						'user_id'=>$this->native_session->get('__user_id')
					));
				}
			}
		}
		else $reason = "No permissions selected.";
		
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>(!empty($data['groupid'])? 'updated': 'added').'_permission_group', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$reason);
	}
	
	
	
	
	
	# get permission group details
	function details($id)
	{
		$group = $this->_query_reader->get_row_as_array('get_permission_group_list', array('type_condition'=>'', 
			'phrase_condition'=>" AND id='".$id."' ", 'limit_text'=>" LIMIT 1 "
		));
		
		$group['permissions'] = $this->_query_reader->get_single_column_as_array('get_group_permissions', 'permission_id', array('group_id'=>$id));
		
		return $group;
	}
	
	
	
	# get a group's permission list
	function group_permissions($id)
	{
		return $this->_query_reader->get_list('get_group_permissions', array('group_id'=>$id));
	}
	
	
	# get the system permissions
	function system_permissions()
	{
		return $this->_query_reader->get_list('get_system_permissions');
	}
	
	
	
	
	
	# update permission group status
	function update_status($newStatus, $groupIds)
	{
		$msg = '';
		$result = FALSE;
		$groups= implode("','",$groupIds);
		
		# Remove the document record completely
		if($newStatus == 'delete'){
			$result = $this->_query_reader->run('delete_group_mapping', array('group_ids'=>$groups));
			if($result)$result = $this->_query_reader->run('delete_permission_group', array('group_ids'=>$groups));
		}
		
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'permission_group_status_change', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"newstatus=".$newStatus."|device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$msg);
	}
	
	
	
	
	
	
}


?>