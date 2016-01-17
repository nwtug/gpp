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
	function lists($scope=array('phrase'=>'', 'procurement_type'=>'', 'status'=>'', 'procurement_method'=>'', 'pde'=>'', 'by_deadline'=>'', 'display_type'=>'secure', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		$userType = $this->native_session->get('__user_type');
		$organizationId = $this->native_session->get('__organization_id');
		$invitationCondition = ($this->native_session->get('__user_type') && $userType == 'provider')? " OR (SELECT id FROM tender_invitations WHERE _provider_id='".$organizationId."' AND _tender_id=T.id LIMIT 1) IS NOT NULL ": '';
		
		
		return $this->_query_reader->get_list('get_tender_list', array(
			'organization_id'=>($userType == 'provider'? $organizationId: ''),
			
			'method_condition'=>(!empty($scope['procurement_method'])? " AND method='".$scope['procurement_method']."' ": ''),
			
			'type_condition'=>(!empty($scope['procurement_type'])? " AND T.type='".$scope['procurement_type']."' ": ''),
			
			'status_condition'=>(!empty($scope['status'])? " AND status = '".$scope['status']."' ": ($userType == 'provider'? " AND status = 'published' ": '')),
			
			'owner_condition'=>($userType == 'pde'? " AND _organization_id = '".$organizationId."' ": '' ),
			
			'phrase_condition'=>(!empty($scope['phrase'])? " AND MATCH(name) AGAINST ('+\"".htmlentities($scope['phrase'], ENT_QUOTES)."\"')": ''),
			
			'deadline_condition'=>(!empty($scope['by_deadline'])? " AND DATE(deadline) BETWEEN NOW() AND DATE('".date('Y-m-d',strtotime(make_us_date($scope['by_deadline'])))."') ": ''),
			
			'display_condition'=>(!empty($scope['display_type']) && $scope['display_type'] == 'public'? " 
			AND NOW() <= DATE(T.deadline)
			AND (NOW() BETWEEN DATE(T.display_start_date) AND DATE(T.display_end_date)) 
			AND (method IN ('international_competitive_tendering','national_competitive_tendering') ".$invitationCondition.")": ''),
			
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
				'display_start_date'=>(!empty($data['display_from'])? date('Y-m-d',strtotime(make_us_date($data['display_from']))): '0000-00-00'), 
				'display_end_date'=>(!empty($data['display_to'])? date('Y-m-d',strtotime(make_us_date($data['display_to']))): '0000-00-00'), 
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
	
	
	
	
	
	
	# get tender invitations
	function invitations($id)
	{
		return $this->_query_reader->get_list('get_tender_invitations', array('tender_id'=>$id));
	}
	
	
	
	
	
	# invite providers to tenders
	function invite($data)
	{
		$data['note'] = !empty($data['note'])? $data['note']: 'NONE';
		
		# a) send invitation message
		$tender = $this->details($data['tender_id']);
		$users = $this->_query_reader->get_list('get_users_in_organizations',array('organization_ids'=>$data['provider_id'] ));
		$message = array('code'=>'invitation_to_bid', 'tendersubject'=>$tender['subject'], 'method'=>ucwords(str_replace('_', ' ', $tender['method'])), 'referencenumber'=>$tender['reference_number'], 'deadline'=>date(FULL_DATE_FORMAT, strtotime($tender['deadline'])), 'note'=>htmlentities($data['note'], ENT_QUOTES), 'pde'=>$tender['pde']);
		
		$sent = array();
		foreach($users AS $row) {
			$result = $this->_messenger->send($row['user_id'], $message, array('email'),TRUE);
			if($result) array_push($sent, $row['email_address']);
		}
		$result = !empty($sent);
		
		
		# b) add bidder record if successful
		if($result){
			$result = $this->_query_reader->run('add_tender_bidder', array(
				'provider_id'=>$data['provider_id'], 
				'tender_id'=>$data['tender_id'],
				'status'=>'active',
				'note'=>htmlentities($data['note'], ENT_QUOTES),
				'user_id'=>$this->native_session->get('__user_id'),
			));
		}
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'invite_tender_bidder', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result);
	}
	
	
	
	
	
	
	
	
	
}
?>