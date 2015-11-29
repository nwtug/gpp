<?php
/**
 * This class generates and formats tender details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class _tender extends CI_Model
{
	# list of tenders
	function lists($scope=array('phrase'=>'', 'procurement_type'=>'', 'procurement_method'=>'', 'pde'=>'', 'by_deadline'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		$userType = $this->native_session->get('__user_type');
		$organizationId = $this->native_session->get('__organization_id');
		
		return $this->_query_reader->get_list('get_tender_list', array(
			'organization_id'=>($userType == 'provider'? $organizationId: ''),
			
			'method_condition'=>(!empty($scope['procurement_method'])? " AND method='".$scope['procurement_method']."' ": ''),
			
			'type_condition'=>(!empty($scope['procurement_type'])? " AND category='".$scope['procurement_type']."' ": ''),
			
			'status_condition'=>($userType == 'provider'? " AND status = 'published' ": '' ),
			
			'owner_condition'=>($userType == 'pde'? " AND _organization_id = '".$organizationId."' ": '' ),
			
			'phrase_condition'=>(!empty($scope['phrase'])? " AND MATCH(name) AGAINST ('+\"".htmlentities($scope['phrase'], ENT_QUOTES)."\"')": ''),
			
			'deadline_condition'=>(!empty($scope['by_deadline'])? " AND DATE(deadline) <= DATE('".$scope['by_deadline']."') ": ''),
			
			'pde_condition'=>(!empty($scope['pde'])? " HAVING pde_id = '".$scope['pde']."' ": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	# add a tender
	function add($data)
	{
		# add the tender notice
		$result = $this->_query_reader->run('add_tender_notice', array(
				'name'=>htmlentities($data['subject'], ENT_QUOTES), 
				'details'=>htmlentities($data['summary'], ENT_QUOTES), 
				'type'=>$data['tender__procurementtypes'], 
				'category'=>$data['tender__procurementcategories'],
				'method'=>$data['tender__procurementmethods'], 
				'procurement_plan_id'=>$data['plan_id'], 
				'document_url'=>$data['document'], 
				'status'=>$data['tender__tenderstatus'], 
				'deadline'=>date('Y-m-d',strtotime(make_us_date($data['deadline']))), 
				'display_start_date'=>date('Y-m-d',strtotime(make_us_date($data['display_from']))), 
				'display_end_date'=>date('Y-m-d',strtotime(make_us_date($data['display_to']))), 
				'user_id'=>$this->native_session->get('__user_id')
			));
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'add_tender', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>'');
	}
	
	
	
	
	
	# get tender details
	function details($id)
	{
		return $this->_query_reader->get_row_as_array('get_tender_notice', array('tender_id'=>$id));
	}
	
	
	# update the status of a tender
	function update_status($newStatus, $idList)
	{
		# use appropriate DB status
		if($newStatus == 'publish') $status = 'published';
		else if($newStatus == 'deactivate') $status = 'archived';
		else $status = 'saved';
		
		$result = $this->_query_reader->run('update_tender_status', array('new_status'=>$status, 'id_list'=>implode("','",$idList) ));
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'update_tender_status', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result);
	}
	
}


?>