<?php
/**
 * This class manages reports. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/27/2015
 */
class _report extends CI_Model
{
	
	# get report data based on given scope
	function lists($scope = array('type'=>'', 'quarter'=>'', 'pde'=>''))
	{
		$data = array(); # final data array
		
		$scope['type'] = !empty($scope['type'])? $scope['type']: 'procurement_plan_tracking';
		$scope['quarter'] = !empty($scope['quarter'])? $scope['quarter']: @date('Y').'-first';
		
		$startDate = get_quarter_date($scope['quarter'], 'start');
		$endDate = get_quarter_date($scope['quarter'], 'end');
		
		# get proper quarter name
		$quarter = explode('-', $scope['quarter']);
		$data['quarter'] = ucfirst($quarter[1]).' '.$quarter[0];
		
		# determine what to have for pde value
		# always load data for this pde 
		if($this->native_session->get('__user_type') == 'pde') 
		{
			$scope['pde'] = $this->native_session->get('__organization_id');
			$data['pde'] = $this->native_session->get('__organization_name');
		} 
		else if(empty($scope['pde'])){
			$pde = $this->_query_reader->get_row_as_array('get_most_active_pde', array('from_date'=>$startDate, 'to_date'=>$endDate, 'limit_text'=>'LIMIT 1'));
			$scope['pde'] = $pde['pde_id'];
			$data['pde'] = $pde['name'];
		}
		
		
		# save to session for later use in downloads
		$this->native_session->set('report_type', $scope['type']);
		$this->native_session->set('report_quarter', $scope['quarter']);
		$this->native_session->set('report_pde', $scope['pde']);
		
		
		# prepare the data to be shown in the reports
		if($scope['type'] == 'procurement_plan_tracking'){
			# format the tender data for display
			$tenders = $this->_query_reader->get_list('get_procurement_plan_tracking_data', array('pde'=>$scope['pde'], 'from_date'=>$startDate, 'to_date'=>$endDate ));
		
			# the tender totals
			$totalPlanned = $totalActual = 0;
			$data['tenders'] = array();
			foreach($tenders AS $tender) {
				$category = array_shift($tender);
				array_push($data['tenders'][$category], array_values($tender));
				$totalPlanned += $tender['estimate_planned'];
				$totalActual += $tender['estimate_actual'];
			}
		}
		
		# 'procurements_in_progress', 'contracts_signed', 'procurements_completed', 'low_value_procurements'
		else {
			# format the tender data for display
			$tenders = $this->_query_reader->get_list('get_'.$scope['type'].'_data', array('pde'=>$scope['pde'], 'from_date'=>$startDate, 'to_date'=>$endDate ));
			
			$data['tenders'] = array();
			foreach($tenders AS $tender) array_push($data['tenders'], array_values($tender));
		}
		
		return $data;
	}
	
	
	
	
	
	
	
	
	# generate an array with all the report data
	function report_to_array($format)
	{
		$scope['type'] = $this->native_session->get('report_type')? $this->native_session->get('report_type'): 'procurement_plan_tracking';
		$scope['quarter'] = $this->native_session->get('report_quarter')? $this->native_session->get('report_quarter'): @date('Y').'-first';
		$scope['pde'] = $this->native_session->get('report_pde')? $this->native_session->get('report_pde'): '';
		$data = $this->lists($scope);
		
		# CSV format
		if($format == 'download_csv'){
			$array[0] = array('Name of Spending Agency: '.$data['pde'], 'Quarter: '.$data['quarter']);
			$array[1] = array('Brief Description','Procurement Method','Estimate in SSP','Plan/Actual','Tender Document/RFP','Bid/EOI Invitation & Open','Bid/EOI Evaluation/Short List','Issuance of RFP (Services)','Receipt of RFP (Service)','Evaluation /Negotiate','Contract Approval MoFEP','Contract Endorsement MoJ','Contract Award','Commencement of Contract','Contract Completion');
			
		}
		
		
		
		return $array;
	}
	
	

	
	
	
}


?>