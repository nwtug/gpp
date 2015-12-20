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
	function lists($scope=array('phrase'=>'', 'status'=>'', 'pde'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		if($this->native_session->get('__user_type') == 'pde') $scope['pde'] = $this->native_session->get('__organization_id');
		
		return $this->_query_reader->get_list('get_procurement_plan_list', array(
			'pde_condition'=>(!empty($scope['pde'])? " AND _organization_id='".$scope['pde']."' ": ''),
			'status_condition'=>(!empty($scope['status'])? " AND status='".$scope['status']."' ": ''),
			'phrase_condition'=>(!empty($scope['phrase'])? " AND title LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	# update the procurement plan status
	function add($data)
	{
		$fyParts = explode('-', $data['financialyear']);
		$reason = '';
		
		#check to make sure the user is not replacing another financial year
		$plan = $this->_query_reader->get_row_as_array('get_plan_by_financial_period', array('organization_id'=>$data['pdeid'], 'financial_year_start'=>$fyParts[0].'-01-01', 'financial_year_end'=>$fyParts[1].'-12-31'));
		
		if(empty($plan['plan_id']) || $plan['plan_id'] == $this->native_session->get('plan_id')){
			$parameters = array(
				'organization_id'=>$data['pdeid'], 
				'financial_year_start'=>$fyParts[0].'-01-01', 
				'financial_year_end'=>$fyParts[1].'-12-31',
				'title'=>htmlentities(restore_bad_chars($data['name']), ENT_QUOTES), 
				'details'=>'', 
				'document_url'=>'', 
				'status'=>$data['status'], 
				'user_id'=>$this->native_session->get('__user_id'),
				'plan_id'=>$this->native_session->get('plan_id')
			);
			
			if(!$this->native_session->get('plan_id')){
				$planId = $this->_query_reader->run('add_procurement_plan', $parameters);
				if(!empty($planId)){
					$result = TRUE;
					$this->native_session->set('plan_id',$planId);
				}
				else $result = FALSE;
			}
			else {
				$result = $this->_query_reader->run('edit_procurement_plan', $parameters);
			}
			
			if($result) $this->native_session->delete('plan_id');
		}
		else $message = 'ERROR: The selected financial period does not match the plan details. Please edit the plan instead.';
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'add_procurement_plan', 
			'result'=>((!empty($result) && $result)? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>(!empty($result) && $result), 'reason'=>$reason);
	}
	
	
	
	
	
	# add procurement plan details
	function add_details($data)
	{
		$reason = '';
		$fyParts = explode('-', $data['fystart__financialperiods']);
			
		if(empty($data['plan_id'])){
			$planCount = $this->_query_reader->get_count('get_procurement_plan_by_data', array(
					'pde_id'=>$data['pde_id'], 
					'financial_year_start'=>$fyParts[0].'-01-01', 
					'financial_year_end'=>$fyParts[1].'-12-31'
				));
		}
		
			
		# proceed with the addition if this is a unique plan
		if(!empty($data['plan_id']) || (empty($data['plan_id']) && $planCount == 0)){
			$planId = $this->_query_reader->add_data((!empty($data['plan_id'])? 'edit': 'add').'_procurement_plan', array(
				'organization_id'=>$data['pde_id'], 
				'financial_year_start'=>$fyParts[0].'-01-01', 
				'financial_year_end'=>$fyParts[1].'-12-31',
				'title'=>htmlentities($data['name'], ENT_QUOTES), 
				'details'=>'', 
				'document_url'=>'', 
				'status'=>$data['status__procurementplanstatus'], 
				'user_id'=>$this->native_session->get('__user_id'),
				'plan_id'=>(!empty($data['plan_id'])? $data['plan_id']: '')
			));
			
			$planId = !empty($data['plan_id'])? $data['plan_id']: $planId;
			
			# proceed with processing the procurement plan details
			if(!empty($planId)){
				$this->native_session->set('plan_id', $planId);
				
				require_once(HOME_URL.'external_libraries/phpexcel/PHPExcel.php');
				$objPHPExcel = PHPExcel_IOFactory::load(UPLOAD_DIRECTORY.$data['document']);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray('',true,true,true);
		
				$DATA_START = 9;
				$result = TRUE;
				$usefulData = array();
				# extract the useful data
				foreach($sheetData AS $i=>$row){
					if($i >= $DATA_START && !is_empty_row($row)) {
						# where they can not edit
						if(!empty($row['B']) && trim($row['B']) == 'DO NOT EDIT BELOW THIS LINE') break;
						
						# put only categories with data
						if(in_array(trim(strtolower($row['B'])), get_option_list($this, 'procurementcategories', 'array'))
							&& !empty($sheetData[$i+1]['D'])) 
						{
							array_push($usefulData, $row);
						}
						else if(!empty($row['D'])) array_push($usefulData, $row);
					}
				}
					
				# remove the old sheet data
				if(!empty($usefulData) && !empty($data['plan_id'])){
					$result = $this->_query_reader->run('remove_plan_detail_rows', array('plan_id'=>$data['plan_id']));
				}
					
				# add the new sheet data
				foreach($usefulData AS $row){
					# save the rows with data
					$rowData = array_merge($row, array('plan_id'=>$planId, 'user_id'=>$this->native_session->get('__user_id')));
					$result = $this->_query_reader->run('add_plan_detail_row', $rowData);
				}
					
				# return with the list of added items for immediate display
				if($result) return $this->_query_reader->get_list('get_procurement_plan_details', array('plan_id'=>$planId));
				else $reason = "The plan details could not be fully recorded.";
			}
			else $reason = "The plan headers could not be recorded.";
		}
		else $reason = "This PDE already has a plan for the same financial period. Please edit that instead.";
		
		return $reason;
	}
	
	
	
	
	
	
	
	# get procurement plan details
	function details($id)
	{
		return $this->_query_reader->get_row_as_array('get_procurement_plan', array('plan_id'=>$id));
	}
	
	
	
	# get all procurement plan details
	function all_details($id, $return='all')
	{
		if($return == 'all') $data = $this->_query_reader->get_row_as_array('get_procurement_plan', array('plan_id'=>$id));
		$data['list'] = $this->_query_reader->get_list('get_procurement_plan_details', array('plan_id'=>$id));
		return $data;
	}
	
	
	
	
	
	
	# update the status of a procurement plan
	function update_status($newStatus, $idList)
	{
		$result = FALSE;
		# use appropriate DB status
		$planStatus = array('publish'=>'published', 'deactivate'=>'archived');
		
		if(!empty($planStatus[$newStatus])) {
			$result = $this->_query_reader->run('update_procurement_plan_status', array(
				'new_status'=>$planStatus[$newStatus], 
				'id_list'=>implode("','",$idList), 
				'user_id'=>$this->native_session->get('__user_id') ));
		}
		
		# log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'update_procurement_plan_status', 
			'result'=>(!empty($result) && $result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result);
	}
	
	
	
	
	# update a single detail in the procuremen plan
	function update_single_detail($rowId, $columnId, $value)
	{
		$result = $this->_query_reader->run('update_procurement_plan_detail', array('row_id'=>$rowId, 'column_id'=>$columnId, 'new_value'=>htmlentities($value, ENT_QUOTES) ));
		return array('boolean'=>$result);
	}
	
	
	
	
	# remove plan item from the plan details
	function remove_item($data)
	{
		$msg = '';
		$result = FALSE;
		
		if(!empty($data['id'])) $result = $this->_query_reader->run('remove_plan_detail_item', array('detail_id'=>$data['id']));
		else $msg = 'Item ID could not be resolved.';
		
		return array('boolean'=>$result, 'msg'=>$msg);
	}
	
	
	
	
	# add a procurement plan detail
	function add_item($data)
	{
		$rowData = array_merge($data, array('user_id'=>$this->native_session->get('__user_id')));
		
		# add a category if its missing
		$result = $this->_query_reader->run('add_missing_detail_category', array(
				'category_id'=>$rowData['search__procurementcategories'],
				'plan_id'=>$rowData['plan_id'],
				'user_id'=>$rowData['user_id']
			));
		
		# determine the number to give the new detail row
		if($result){
			$rowLabel = $this->_query_reader->get_row_as_array('get_next_row_label', array(
				'category_id'=>$rowData['search__procurementcategories'], 
				'plan_id'=>$rowData['plan_id']
			));
			$rowData['A'] = $rowLabel['label'];
		}
		
		# add the detail row
		if($result && !empty($rowData['A'])) {
			$rowData['C'] = ucwords(str_replace('_', ' ', $rowData['C']));
			$result = $this->_query_reader->run('add_plan_detail_row', $rowData);
		}
		
		return array('boolean'=>$result);
	}
	
	
	
	
	# get a raw procurement plan detail
	function get_raw_plan_category($categoryId)
	{
		return $this->_query_reader->get_row_as_array('get_raw_report_item', array('detail_id'=>$categoryId));
	}
}


?>