<?php
/**
 * This class generates and formats bid details.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class _bid extends CI_Model
{

	//Procurement Type:
	//Procurment Method

	//provider_id

	# advanced search list of bids
	function lists($status, $scope=array('pde'=>'', 'provider'=>'', 'phrase'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE,'procurement_type'=>'','procurement_method'=>''))
	{
		return $this->_query_reader->get_list('get_bid_list', array(
				'provider_condition'=>(!empty($scope['provider'])? " AND B._organization_id='".$scope['provider']."' ": ''),
				'phrase_condition'=>(!empty($scope['phrase'])? " HAVING tender_notice LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
				'pde_condition'=>(!empty($scope['pde'])? (!empty($scope['phrase'])? ' AND ': ' HAVING ')." pde_id = '".$scope['pde']."' ": ''),
				'procurement_type_condition'=>(!empty($scope['procurement_type'])? ' AND  T.type LIKE "'.$scope['procurement_type'].'" ':'' ),
				'procurement_method_condition'=>(!empty($scope['procurement_method'])? ' AND  T.method LIKE "'.$scope['procurement_method'].'" ':'' ),
				'status_condition'=>($status == 'awarded'? " AND status = 'awarded' ": ($status == 'best_bidders'? " AND status = 'won' ": '')),
				'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}





	# view list of bids by tender notice
	function view_list($noticeId, $scope=array('offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_bid_list', array(
				'provider_condition'=>'',
				'phrase_condition'=>" AND _tender_notice_id='".$noticeId."' ",
				'pde_condition'=>'',
				'status_condition'=>" AND status IN ('submitted','under_review','won','awarded') ",
				'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}






	# view my list of bids
	function my_list($scope=array('pde'=>'', 'submit_from'=>'', 'submit_to'=>'', 'status'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		if(!empty($scope['submit_from']) && !empty($scope['submit_to'])) {
			$periodCondition = " DATE(B.date_submitted) BETWEEN DATE('".date('Y-m-d', strtotime(make_us_date($scope['submit_from'])))."') AND DATE('".date('Y-m-d', strtotime(make_us_date($scope['submit_to'])))."') ";
		}
		else if(!empty($scope['submit_from'])) {
			$periodCondition = " DATE(B.date_submitted) >= DATE('".date('Y-m-d', strtotime(make_us_date($scope['submit_from'])))."') ";
		}
		else if(!empty($scope['submit_to'])) {
			$periodCondition = " DATE(B.date_submitted) <= DATE('".date('Y-m-d', strtotime(make_us_date($scope['submit_to'])))."') ";
		}
		else $periodCondition = "";

		return $this->_query_reader->get_list('get_my_bid_list', array(
				'pde_condition'=>(!empty($scope['pde'])? " HAVING pde_id='".$scope['pde']."' ": ''),
				'submit_period'=>$periodCondition,
				'status_condition'=>(!empty($scope['status'])? " AND status IN ('".implode("','",$scope['status'])."') ": ''),
				'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}





	# add a bid
	function add($data)
	{
		# a) save the main record
		$bidId = $this->_query_reader->add_data('add_bid_record', array(
				'tender_id'=>$data['tender_id'],
				'summary'=>htmlentities($data['summary'], ENT_QUOTES),
				'bid_currency'=>$data['currency_code'],
				'bid_amount'=>$data['amount'],
				'status'=>$data['bid__bidstatus'],
				'valid_start_date'=>date('Y-m-d',strtotime(make_us_date($data['valid_from']))),
				'valid_end_date'=>date('Y-m-d',strtotime(make_us_date($data['valid_to']))),
				'user_id'=>$this->native_session->get('__user_id'),
				'organization_id'=>$this->native_session->get('__organization_id')
		));

		# save the status record
		if(!empty($bidId)) $result = $this->_query_reader->run('add_bid_status', array('bid_id'=>$bidId, 'status'=>$data['bid__bidstatus'], 'user_id'=>$this->native_session->get('__user_id') ));

		# save the document records
		if(!empty($result) && $result) {
			foreach($data['documents'] AS $document) {
				if($result) $result = $this->_query_reader->run('add_bid_document', array('bid_id'=>$bidId, 'document_url'=>$document, 'user_id'=>$this->native_session->get('__user_id')));
			}
		}

		# log action
		$this->_logger->add_event(array(
				'user_id'=>$this->native_session->get('__user_id'),
				'activity_code'=>'add_bid',
				'result'=>($result? 'SUCCESS': 'FAIL'),
				'log_details'=>"bidstatus=".$data['bid__bidstatus']."|device=".get_user_device()."|browser=".$this->agent->browser(),
				'uri'=>uri_string(),
				'ip_address'=>get_ip_address()
		));

		return array('boolean'=>$result, 'reason'=>'');
	}





	# view one bid's details
	function details($spec = array('tender_id'=>'', 'bid_id'=>''))
	{
		# if only the tender id is given
		if(!empty($spec['tender_id']) && empty($spec['bid_id'])) {
			return $this->_query_reader->get_row_as_array('get_my_bid_list', array(
					'pde_condition'=>" AND _tender_notice_id='".$spec['tender_id']."' AND _organization_id = '".$this->native_session->get('__organization_id')."' ",
					'submit_period'=>'',
					'status_condition'=>'',
					'limit_text'=>" LIMIT 1 "
			));
		}

		# if the bid id is given
		else if(!empty($spec['bid_id'])) {
			return $this->_query_reader->get_row_as_array('get_my_bid_list', array('pde_condition'=>" AND id='".$spec['bid_id']."' ", 'submit_period'=>'', 'status_condition'=>'', 'limit_text'=>" LIMIT 1 "));
		}

		# no identifing info is provided
		else return array();
	}





	# view  bid's summary
	function summary($bidId)
	{
		$data = $this->_query_reader->get_row_as_array('get_basic_bid', array('bid_id'=>$bidId));
		return !empty($data['summary'])? html_entity_decode($data['summary'], ENT_QUOTES): '';
	}



	# update bid status
	function update_status($newStatus, $bidIds)
	{
		$msg = '';
		$bids = implode("','",$bidIds);
		$status = array('mark_as_won'=>'won', 'mark_as_awarded'=>'awarded', 'retract_win'=>'under_review', 'reject_bid'=>'saved', 'retract_award'=>'under_review', 'submit_bid'=>'submitted', 'mark_as_archived'=>'archived', 'mark_as_completed'=>'complete');

		# update status trail
		$result = $this->_query_reader->run('update_status_trail', array('bid_ids'=>$bids));

		# add the new status to the bid status trail
		if($result) $result = $this->_query_reader->run('add_status_trail', array('new_status'=>$status[$newStatus], 'bid_ids'=>$bids, 'user_id'=>$this->native_session->get('__user_id') ));

		# update the actual bid record status
		if($result) $result = $this->_query_reader->run('update_bid_status', array('new_status'=>$status[$newStatus], 'bid_ids'=>$bids, 'user_id'=>$this->native_session->get('__user_id') ));

		# submit bid - if the new status is submitted
		if($result && $status[$newStatus] == 'submitted') $result = $this->_query_reader->run('submit_provider_bid', array('bid_ids'=>$bids, 'user_id'=>$this->native_session->get('__user_id') ));


		# notify provider about change of status, if not made by them
		if($this->native_session->get('__user_type') != 'provider') {
			$sent = array();
			foreach($bidIds AS $bidId) {
				$providerUserIds = $this->_query_reader->get_single_column_as_array('get_bid_provider_users', 'user_id', array('bid_id'=>$bidId));
				$bid = $this->details(array('bid_id'=>$bidId));
				if(!empty($providerUserIds) && !empty($bid)){
					$sentResult = $this->_messenger->send($providerUserIds, array(
							'code'=>'bid_status_changed',
							'newstatus'=>$status[$newStatus],
							'pde'=>$bid['pde'],
							'summary'=>$bid['summary'],
							'tendernotice'=>$bid['tender_notice'],
							'datesubmitted'=>date(SHORT_DATE_FORMAT, strtotime($bid['date_submitted']))
					));
					array_push($sent, $sentResult);
				}
			}
			if(!get_decision($sent)) $msg = 'Status change notification could not be sent.';
		}
		else $sent = array(TRUE);

		if(!$result) $msg = 'Data commit coult not be completed.';
		$finalResult = $result && get_decision($sent);

		# log action
		$this->_logger->add_event(array(
				'user_id'=>$this->native_session->get('__user_id'),
				'activity_code'=>'bid_status_change',
				'result'=>($finalResult? 'SUCCESS': 'FAIL'),
				'log_details'=>"newstatus=".$status[$newStatus]."|device=".get_user_device()."|browser=".$this->agent->browser(),
				'uri'=>uri_string(),
				'ip_address'=>get_ip_address()
		));

		return array('boolean'=>$finalResult, 'reason'=>$msg);
	}


}


?>