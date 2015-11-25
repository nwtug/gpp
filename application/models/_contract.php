<?php
/**
 * This class generates and formats tender details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/21/2015
 */
class _contract extends CI_Model
{
	# list of contracts
	function lists($scope=array('tender'=>'', 'pde'=>'', 'status'=>'', 'phrase'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		$userType = $this->native_session->get('__user_type');
		$organizationId = $this->native_session->get('__organization_id');
		
		return $this->_query_reader->get_list('get_contract_list', array(
			'tender_condition'=>(!empty($scope['tender'])? " AND _tender_id='".$scope['tender']."' ": ''),
			
			'pde_condition'=>(!empty($scope['pde'])? " AND _pde_id='".$scope['pde']."' ": ''),
			
			'status_condition'=>(!empty($scope['status'])? " AND status = '".$scope['status']."' ": " AND status IN ('active','complete') " ),
			
			'owner_condition'=>(in_array($userType, array('pde','provider'))? ($userType == 'provider'? " AND _organization_id = '".$organizationId."' ": " AND _pde_id = '".$organizationId."' "): '' ),
			
			'phrase_condition'=>(!empty($scope['phrase'])? " AND name LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	
	# add a contract
	function add($data)
	{
		# a) save the main record
		$contractId = $this->_query_reader->add_data('add_contract_record', array(
				'tender_id'=>$data['tender_id'], 
				'organization_id'=>$data['provider_id'], 
				'pde_id'=>$data['pde_id'],
				'name'=>htmlentities($data['name'], ENT_QUOTES),
				'contract_currency'=>$data['currency_code'], 
				'contract_amount'=>$data['amount'], 
				'status'=>$data['contract__contractstatus'], 
				'date_started'=>date('Y-m-d',strtotime(make_us_date($data['start_date']))), 
				'user_id'=>$this->native_session->get('__user_id')
			));
		
		# b) save the status record
		if(!empty($contractId)) $result = $this->_query_reader->run('add_contract_status', array('contract_id'=>$contractId, 'status'=>$data['contract__contractstatus'], 'document_url'=>implode(',',$data['documents']), 'user_id'=>$this->native_session->get('__user_id'), 'notes'=>'First contract status entry' ));
		
		# c) update the winner's bid to reflect the contract amount for reporting purposes
		if(!empty($result) && $result) $result = $this->_query_reader->run('update_bid_contract_amount', array('tender_id'=>$data['tender_id'], 'organization_id'=>$data['provider_id'], 'contract_currency'=>$data['currency_code'], 'contract_amount'=>$data['amount'], 'user_id'=>$this->native_session->get('__user_id') ));
		
		
		# d) log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'add_contract', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"contractid=".$contractId."|tender_id=".$data['tender_id']."|organization_id=".$data['provider_id']."|contractstatus=".$data['contract__contractstatus']."|device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>'');
	}
	
	
	
	
	
	
	
	
	
	
	
}


?>