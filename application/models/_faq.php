<?php
/**
 * This class generates and formats FAQ details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/26/2015
 */
class _faq extends CI_Model
{
	# list of FAQs
	function lists($scope=array('phrase'=>'', 'pde'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_faq_list', array(
			'phrase_condition'=>(!empty($scope['phrase'])? " AND question LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
			
			'owner_condition'=>($this->native_session->get('__user_type') == 'pde'? " AND _entered_by_organization='".$this->native_session->get('__organization_id')."' ": ''),
			
			'status_condition'=>($this->native_session->get('__user_type') == 'admin'? " AND status IN ('active','inactive') ": " AND status = 'active' "),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	# add an FAQ
	function add($data)
	{
		$result = FALSE;
		$reason = '';
		
		# updating..
		if(!empty($data['faqid'])){
			$result = $this->_query_reader->run('update_faq_details', array(
				'question'=>htmlentities($data['question'], ENT_QUOTES), 
				'answer'=>htmlentities($data['answer'], ENT_QUOTES), 
				'user_id'=>$this->native_session->get('__user_id'),
				'faq_id'=>$data['faqid']
			));
			$faqId = $data['faqid'];
		} 
		# adding new..
		else {
			$data['faqid'] = $this->_query_reader->add_data('add_faq_record', array(
				'question'=>htmlentities($data['question'], ENT_QUOTES), 
				'answer'=>htmlentities($data['answer'], ENT_QUOTES), 
				'user_id'=>$this->native_session->get('__user_id'), 
				'organization_id'=>$this->native_session->get('__organization_id')
			));
		}
		
		# update the show order of the FAQs
		if(!empty($data['faqid'])) $result = $this->_query_reader->run('update_faq_display_order', array('new_faq'=>$data['faqid'], 'show_after'=>$data['show_after']));
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>(!empty($faqId)? 'updated': 'added').'_faq', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$reason);
	}
	
	
	
	
	
	# update faq status
	function update_status($newStatus, $faqIds)
	{
		$msg = '';
		$faqs = implode("','",$faqIds);
		$status = array('archive'=>'inactive', 'reactivate'=>'active');
		
		# Remove the document record completely
		if($newStatus == 'delete') $result = $this->_query_reader->run('delete_faq_record', array('faq_ids'=>$faqs));
		# Simply change the status
		else $result = $this->_query_reader->run('update_faq_status', array('new_status'=>$status[$newStatus], 'faq_ids'=>$faqs, 'user_id'=>$this->native_session->get('__user_id') ));
		
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'faq_status_change', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"newstatus=".$newStatus."|device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$msg);
	}
	
	
	
	
	
	
	
	
	# get FAQ details
	function details($id)
	{
		return $this->_query_reader->get_row_as_array('get_faq_list', array('owner_condition'=>'', 'status_condition'=>'', 'phrase_condition'=>" AND id='".$id."' ", 'limit_text'=>" LIMIT 1 "));
	}
	
	
	
}


?>