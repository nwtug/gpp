<?php
/**
 * This class generates and formats provider details. 
 *
 * @author David Buwembo <dbuwembo@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/20/2015
 */

class _forum extends CI_Model
{
	# advanced search list of forums
	function lists($scope=array('category'=>'', 'is_public'=>'', 'status'=>'', 'phrase'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_forum_list', array(
			'phrase_condition'=>(!empty($scope['phrase'])? " AND topic LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
			
			'status_condition'=>" AND status IN ('".($this->native_session->get('__user_type') == 'admin'? (!empty($scope['status'])? $scope['status']: "active','inactive"): "active")."') ",
			
			'access_condition'=>" AND is_public ".(!empty($scope['is_public'])? "='".$scope['is_public']."'": ($this->native_session->get('__user_id')? "IN ('Y','N')": "='Y'"))." ",
			
			'owner_condition'=>($this->native_session->get('__user_type') == 'pde'? " AND _entered_by_organization='".$this->native_session->get('__organization_id')."' ": ''),
			
			'category_condition'=>(!empty($scope['category'])? " AND category='".$scope['category']."' ": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	

	# add a forum
	function add($data)
	{
		$result = FALSE;
		$reason = '';
		
		# updating..
		if(!empty($data['forumid'])){
			$result = $this->_query_reader->run('update_forum_record', array(
				'topic'=>htmlentities($data['topic'], ENT_QUOTES), 
				'details'=>htmlentities($data['details'], ENT_QUOTES),
				'document_url'=>$data['document'], 
				'category'=>$data['forum__forumcategories'],  
				'is_public'=>$data['forum__forumaccess'],
				'moderator'=>$data['user_id'],
				'forum_id'=>$data['forumid'],
				'user_id'=>$this->native_session->get('__user_id') 
			));
			
		} 
		# adding new..
		else {
			$result = $this->_query_reader->run('add_forum_record', array(
				'topic'=>htmlentities($data['topic'], ENT_QUOTES), 
				'details'=>htmlentities($data['details'], ENT_QUOTES),
				'document_url'=>$data['document'], 
				'category'=>$data['forum__forumcategories'],  
				'is_public'=>$data['forum__forumaccess'],
				'moderator'=>$data['user_id'],
				'user_id'=>$this->native_session->get('__user_id'), 
				'organization_id'=>$this->native_session->get('__organization_id')
			));
		}
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>(!empty($data['forumid'])? $data['forumid']: 'add').'_forum', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$reason);
	}
	
	
	
	
	
	
	
	
	# get details of a forum
	function details($id, $isView=FALSE)
	{
		$details = $this->_query_reader->get_row_as_array('get_forum_list', array('phrase_condition'=>" AND id='".$id."' ", 'status_condition'=>'', 'owner_condition'=>'', 'access_condition'=>'', 'category_condition'=>'','limit_text'=>" LIMIT 1 "));
		
		# record that the forum has been viewed
		if(!empty($details) && $isView) $result = $this->_query_reader->run('update_no_of_forum_views', array('forum_id'=>$id));
		 
		return $details;
	}
	
	
	
	
	
	
	# update forum status
	function update_status($newStatus, $forumIds)
	{
		$msg = '';
		$forums = implode("','",$forumIds);
		$status = array('archive'=>'inactive', 'reactivate'=>'active');
		
		# Remove the forum record completely
		if($newStatus == 'delete'){
			$result = $this->_query_reader->run('delete_forum_record', array('forum_ids'=>$forums));
		}
		# Simply change the status
		else {
			$result = $this->_query_reader->run('update_forum_status', array('new_status'=>$status[$newStatus], 'forum_ids'=>$forums, 'user_id'=>$this->native_session->get('__user_id') ));
		}
		
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'forum_status_change', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"newstatus=".$newStatus."|device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>$msg);
	}
	
	
	
	
	
	
	
	# add a comment to a forum
	function add_comment($data)
	{
		$result = $this->_query_reader->run('add_forum_comment', array(
				'comment'=>htmlentities($data['details'], ENT_QUOTES),
				'forum_id'=>$data['forumid'],
				'user_id'=>($this->native_session->get('__user_id')? $this->native_session->get('__user_id'): 'anonymous_'.strtotime('now')),
				'responding_to'=>(!empty($data['respondingto'])? $data['respondingto']: '0')
			));
		
		# update the number of contributors for the forum
		if($result) $result = $this->_query_reader->run('update_contributor_number', array('forum_id'=>$data['forumid']));
		
		return array('boolean'=>$result);
	}
	
	
	
	
	
	# get the comments of a forum
	function comments($forumId)
	{
		return $this->_query_reader->get_list('get_forum_comments', array('forum_id'=>$forumId)); 
	}
	
	
	
	
	
	
	
	# get forum statistics
	function statistics($field)
	{
		if($field == 'latest_date') {
			$row = $this->_query_reader->get_row_as_array('get_forum_latest_date');
			return !empty($row[$field]) && strpos($row[$field], '0000-00-00') === FALSE? $row[$field]: '';
		}
		
		# if not found in preset fields, return empty string
		return '';
	}
}


?>