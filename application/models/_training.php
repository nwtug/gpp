<?php
/**
 * This class manages training information. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/25/2015
 */
class _training extends CI_Model
{
	# advanced search list of links
	function lists($scope=array('pde'=>'', 'category'=>'', 'phrase'=>'', 'status'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		if(!empty($scope['pde'])) $pde = $scope['pde'];
		else if($this->native_session->get('__user_type') == 'pde') $pde = $this->native_session->get('__organization_id');
		
		return $this->_query_reader->get_list('get_training_list', array(
			'phrase_condition'=>(!empty($scope['phrase'])? " AND subject LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
			
			'status_condition'=>" AND status IN ('".($this->native_session->get('__user_type') == 'admin'? (!empty($scope['status'])? $scope['status']: "active','inactive"): "active")."') ",
			
			'category_condition'=>(!empty($scope['category'])? " AND category='".$scope['category']."' ": ''),
			
			'owner_condition'=>(!empty($pde)? " AND _entered_by_organization='".$pde."' ": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	# add a training record
	function add($data)
	{
		$result = FALSE;
		$reason = '';
		
		# add the document record
		$result = $this->_query_reader->run('add_training_record', array(
				'subject'=>htmlentities($data['name'], ENT_QUOTES), 
				'category'=>$data['training__trainingcategories'],  
				'description'=>htmlentities($data['description'], ENT_QUOTES),
				'event_time'=>date('Y-m-d H:i:s',strtotime(make_us_date($data['eventtime']))),  
				'duration'=>$data['duration'], 
				'user_id'=>$this->native_session->get('__user_id'), 
				'organization_id'=>$this->native_session->get('__organization_id')
		));
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'add_training', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$reason);
	}
	
	
	
	
	
	
	
	
	# get details of a training record
	function details($id)
	{
		return $this->_query_reader->get_row_as_array('get_training_list', array('phrase_condition'=>" AND id='".$id."' ", 'status_condition'=>'', 'category_condition'=>'', 'owner_condition'=>'', 'limit_text'=>" LIMIT 1 "));
	}
	
	
	
	
	
	
	# update training status
	function update_status($newStatus, $linkIds)
	{
		$msg = '';
		$links = implode("','",$linkIds);
		$status = array('archive'=>'inactive', 'reactivate'=>'active');
		
		# Remove the link record completely
		if($newStatus == 'delete'){
			$result = $this->_query_reader->run('delete_training_record', array('training_ids'=>$links));
		}
		# Simply change the status
		else {
			$result = $this->_query_reader->run('update_training_status', array('new_status'=>$status[$newStatus], 'training_ids'=>$links, 'user_id'=>$this->native_session->get('__user_id') ));
		}
		
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'training_status_change', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"newstatus=".$newStatus."|device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$msg);
	}
	
	
	
	
}


?>