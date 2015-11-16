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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}


?>