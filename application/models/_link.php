<?php
/**
 * This class manages link information. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/24/2015
 */
class _link extends CI_Model
{
	# advanced search list of links
	function lists($scope=array('pde'=>'', 'opentype'=>'', 'phrase'=>'', 'status'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		if(!empty($scope['pde'])) $pde = $scope['pde'];
		else if($this->native_session->get('__user_type') == 'pde') $pde = $this->native_session->get('__organization_id');
		
		return $this->_query_reader->get_list('get_link_list', array(
			'phrase_condition'=>(!empty($scope['phrase'])? " AND name LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
			
			'status_condition'=>" AND status IN ('".($this->native_session->get('__user_type') == 'admin'? (!empty($scope['status'])? $scope['status']: "active','inactive"): "active")."') ",
			
			'open_condition'=>(!empty($scope['opentype'])? " AND open_type='".$scope['opentype']."' ": ''),
			
			'owner_condition'=>(!empty($pde)? " AND _entered_by_organization='".$pde."' ": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	# add a link
	function add($data)
	{
		$result = FALSE;
		$reason = '';
		
		# add the link record
		$result = $this->_query_reader->run('add_link_record', array(
				'name'=>htmlentities($data['name'], ENT_QUOTES), 
				'url'=>$data['url'],  
				'open_type'=>$data['link__opentypes'],
				'user_id'=>$this->native_session->get('__user_id'), 
				'organization_id'=>$this->native_session->get('__organization_id')
		));
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'add_link', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$reason);
	}
	
	
	
	
	
	
	
	
	# get details of a link
	function details($id)
	{
		return $this->_query_reader->get_row_as_array('get_link_list', array('phrase_condition'=>" AND id='".$id."' ", 'status_condition'=>'', 'owner_condition'=>'','limit_text'=>" LIMIT 1 "));
	}
	
	
	
	
	
	
	# update link status
	function update_status($newStatus, $linkIds)
	{
		$msg = '';
		$links = implode("','",$linkIds);
		$status = array('archive'=>'inactive', 'reactivate'=>'active');
		
		# Remove the link record completely
		if($newStatus == 'delete'){
			$result = $this->_query_reader->run('delete_link_record', array('link_ids'=>$links));
		}
		# Simply change the status
		else {
			$result = $this->_query_reader->run('update_link_status', array('new_status'=>$status[$newStatus], 'link_ids'=>$links, 'user_id'=>$this->native_session->get('__user_id') ));
		}
		
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'link_status_change', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"newstatus=".$newStatus."|device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$msg);
	}
	
	
	
	
}


?>