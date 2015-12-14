<?php
/**
 * This class generates and formats procurement plan details.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class _procurement_plan extends CI_Model
{
	# list of procurement plans
	function lists($scope=array('phrase'=>'', 'status'=>'', 'pde'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE,'financial_year_start'=>'','financial_year_end'=>''))
	{

		#YEAR CONDITION
		$year_condition = (!empty($scope['financial_year_start'])? " AND financial_year_start >= ".date('Y-m-d',strtotime($scope['financial_year_start']))  :'');
		$year_condition .= (!empty($scope['financial_year_end'])? " AND financial_year_start <= ".date('Y-m-d',strtotime($scope['financial_year_end']))  :'');


		return $this->_query_reader->get_list('get_procurement_plan_list', array(
				'pde_condition'=>(!empty($scope['pde'])? " AND _organization_id='".$scope['pde']."' ": ''),
				'status_condition'=>(!empty($scope['status'])? " AND status='".$scope['status']."' ": ''),
				'phrase_condition'=>(!empty($scope['phrase'])? " AND title LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
				'year_condition'=>$year_condition,
				'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}




	# add a procurement plan
	function add($data)
	{
		$result = FALSE;
		$reason = '';

		# make sure the end financial year is greater than the beginning financial year before saving
		if($data['fy_end__pastyears'] > $data['fy_start__pastyears']){
			$result = $this->_query_reader->run('add_procurement_plan', array(
					'organization_id'=>$data['pde_id'],
					'reference_number'=>$data['reference_number'],
					'financial_year_start'=>$data['fy_start__pastyears'].'-01-01',
					'financial_year_end'=>$data['fy_end__pastyears'].'-12-31',
					'title'=>htmlentities($data['name'], ENT_QUOTES),
					'details'=>htmlentities($data['summary'], ENT_QUOTES),
					'document_url'=>$data['document'],
					'status'=>$data['status__procurementplanstatus'],
					'user_id'=>$this->native_session->get('__user_id')
			));
		}
		else $reason = "The end can not be less than the start financial year.";

		# log action
		$this->_logger->add_event(array(
				'user_id'=>$this->native_session->get('__user_id'),
				'activity_code'=>'add_procurement_plan',
				'result'=>($result? 'SUCCESS': 'FAIL'),
				'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
				'uri'=>uri_string(),
				'ip_address'=>get_ip_address()
		));

		return array('boolean'=>$result, 'reason'=>$reason);
	}





	# get procurement plan details
	function details($id)
	{
		return $this->_query_reader->get_row_as_array('get_procurement_plan', array('plan_id'=>$id));
	}







}


?>