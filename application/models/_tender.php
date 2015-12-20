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
			
			'type_condition'=>(!empty($scope['procurement_type'])? " AND T.type='".$scope['procurement_type']."' ": ''),
			
			'status_condition'=>($userType == 'provider'? " AND status = 'published' ": '' ),
			
			'owner_condition'=>($userType == 'pde'? " AND _organization_id = '".$organizationId."' ": '' ),
			
			'phrase_condition'=>(!empty($scope['phrase'])? " AND MATCH(name) AGAINST ('+\"".htmlentities($scope['phrase'], ENT_QUOTES)."\"')": ''),
			
			'deadline_condition'=>(!empty($scope['by_deadline'])? " AND DATE(deadline) BETWEEN NOW() AND DATE('".date('Y-m-d',strtotime(make_us_date($scope['by_deadline'])))."') ": ''),
			
			'pde_condition'=>(!empty($scope['pde'])? " HAVING pde_id = '".$scope['pde']."' ": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	# add a tender
	function add($data)
	{
		$result = FALSE;
		$reason = '';
		
		# add the tender notice
		if(($this->_query_reader->get_count('get_tender_by_reference_number', array('reference_number'=>htmlentities($data['reference_number'], ENT_QUOTES) )) == 0 && empty($data['tender_id']))
			|| !empty($data['tender_id'])
		){
			# user is editing and they have uploaded new documents
			if(!empty($data['tender_id']) && !empty($data['documents'])){
				$tender = $this->details($data['tender_id']);
				$oldDocuments = !empty($tender['document_url'])? $tender['document_url']: '';
			}
			
			# update the tender database record
			$result = $this->_query_reader->run((!empty($data['tender_id'])? 'edit': 'add').'_tender_notice', array(
				'name'=>htmlentities($data['tender__procurementplansubjects'], ENT_QUOTES), 
				'reference_number'=>htmlentities($data['reference_number'], ENT_QUOTES), 
				'details'=>htmlentities($data['summary'], ENT_QUOTES), 
				'type'=>$data['tender__procurementtypes'], 
				'procurement_plan_id'=>$data['plan_id'], 
				'subject_id'=>$data['subject_id'], 
				'document_url'=>(!empty($data['documents'])? implode(',',$data['documents']): ''), 
				'status'=>$data['tender__tenderstatus'], 
				'deadline'=>date('Y-m-d H:i:s',strtotime(make_us_date($data['deadline']))), 
				'display_start_date'=>date('Y-m-d',strtotime(make_us_date($data['display_from']))), 
				'display_end_date'=>date('Y-m-d',strtotime(make_us_date($data['display_to']))), 
				'user_id'=>$this->native_session->get('__user_id'),
				'tender_id'=>(!empty($data['tender_id'])? $data['tender_id']: '')
			));
			
			# safely remove the old documents from the server if the above update succeeded
			if($result && !empty($oldDocuments)) {
				$documents = explode(',',$oldDocuments);
				foreach($documents AS $document) @unlink(UPLOAD_DIRECTORY.$document);
			}
		}
		else $reason = "The reference number is already in use.";
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'add_tender', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$reason);
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