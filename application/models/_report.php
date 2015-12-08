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
		$scope['quarter'] = !empty($scope['quarter'])? $scope['quarter']: get_current_quarter();
		
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
		else {
			$pde = $this->_query_reader->get_row_as_array('get_organization_details_by_id', array('organization_id'=>$scope['pde']));
			$data['pde'] = $pde['name'];
		}
		
		# save to session for later use in downloads
		$this->native_session->set('report_type', $scope['type']);
		$this->native_session->set('report_quarter', $scope['quarter']);
		$this->native_session->set('report_pde', $scope['pde']);
		
		# the report data
		$data['tenders'] = array();
		$tenders = $this->_query_reader->get_list('get_'.$scope['type'].'_report_data', array('pde'=>$scope['pde'], 'start_date'=>$startDate, 'end_date'=>$endDate ));
			
		
		# prepare the data to be shown in the reports
		if($scope['type'] == 'procurement_plan_tracking'){
			# the tender totals
			$totalPlanned = $totalActual = 0;
			foreach($tenders AS $tender) {
				$category = array_shift($tender);
				
				if(empty($data['tenders'][$category])) $data['tenders'][$category] = array();
				array_push($data['tenders'][$category], $tender);
				
				if($tender['plan_or_actual'] == 'Plan') $totalPlanned += $tender['ssp_estimate'];
				if($tender['plan_or_actual'] == 'Actual') $totalActual += $tender['ssp_estimate'];
			}
			$data['totals'] = array('plan'=>$totalPlanned, 'actual'=>$totalActual);
		}
		
		# $scope['type'] IN ('procurements_in_progress', 'contracts_signed', 'procurements_completed', 'low_value_procurements')
		#else foreach($tenders AS $tender) array_push($data['tenders'], array_values($tender));
		else $data['tenders'] = $tenders;
		
		return $data;
	}
	
	
	
	
	
	
	
	
	# generate an array with all the report data
	function report_to_array($format)
	{
		$scope['type'] = $this->native_session->get('report_type')? $this->native_session->get('report_type'): 'procurement_plan_tracking';
		$scope['quarter'] = $this->native_session->get('report_quarter')? $this->native_session->get('report_quarter'): @date('Y').'-first';
		$scope['pde'] = $this->native_session->get('report_pde')? $this->native_session->get('report_pde'): '';
		$list = $this->lists($scope);
		
		
		
		#------------------------------------------------------------------------------------------------
		# CSV format for procurement_plan_tracking
		#------------------------------------------------------------------------------------------------
		if($format == 'download_csv' && $scope['type'] == 'procurement_plan_tracking'){
			$array[0] = array('', 'Name of Spending Agency: '.$list['pde'], '', '', '', '', '', '', 'Quarter: '.$list['quarter']);
			$array[1] = array('', 'Brief Description','Procurement Method','Estimate in SSP','Plan/Actual','Tender Document/RFP','Bid/EOI Invitation & Open','Bid/EOI Evaluation/Short List','Issuance of RFP (Services)','Receipt of RFP (Service)','Evaluation /Negotiate','Contract Approval MoFEP','Contract Endorsement MoJ','Contract Award','Commencement of Contract','Contract Completion');
			
			
			$catCount = 1;
			$rowCount = 1;
			foreach($list['tenders'] AS $category=>$subList) {
				$rowCount++;
				$array[$rowCount] = array($catCount, $category, '', '', '', '', '', '', '', '', '', '', '', '', '', '');

				$subCatCount = 1;
				foreach($subList AS $row){
					$rowCount++;
					$array[$rowCount] = array(
						((empty($prevId) || $prevId != $row['tender_id'])? $catCount.".".$subCatCount: ''),
						html_entity_decode($row['brief_description'], ENT_QUOTES), 
						$row['procurement_method'],
						"SSP".format_number($row['ssp_estimate'], 3),
						$row['plan_or_actual'],
						$row['rfp_status'],
						$row['bid_open_status'],
						$row['bid_short_list_status'],
						$row['issuance_of_rfp_status'],
						$row['receipt_of_rfp_status'],
						$row['evaluation_status'],
						$row['contract_approval_status'],
						$row['contract_endorsement_status'],
						$row['contract_award_status'],
						$row['contract_commencement_status'],
						$row['contract_completion_status']
					);
					
					# increment only for a new tender
					if(empty($prevId) || $prevId != $row['tender_id']) $subCatCount++;
					# keep track of the previous tender ID
					$prevId = $row['tender_id'];
				}
	
				$catCount++;
			}
			
			# Now add the rows at the end of the list
			$rowCount++;
			$array[$rowCount] = array('', 'Total Cost of Goods/Works/Services', '', '', 'Plan', 'SSP'.format_number($list['totals']['plan'],3), '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+1] = array('', '', '', '', 'Actual', 'SSP'.format_number($list['totals']['actual'],3), '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+2] = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+3] = array('', 'Notes:', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+4] = array('', 'RFQ - Request for Quotation', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+5] = array('', 'IC - Individual Consultancy', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+6] = array('', 'EOI - Expressions of Interest', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+7] = array('', 'RFP - Request for Proposal', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+8] = array('', 'LCS - Least Cost Selection', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+9] = array('', 'HPE - Head of Procuring Entity', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+10] = array('', 'MoFEP - Ministry of Finance and Economic Planning', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+11] = array('', 'MoJ - Ministry of Justice', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+12] = array('', 'ICT - International Competitive Tendering', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+13] = array('', 'PC - Procurement Committee', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+14] = array('', 'NCT - National Competitive Tendering', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			$array[$rowCount+15] = array('', 'QCBS - Quality and Cost Based Selection', '', '', '', '', '', '', '', '', '', '', '', '', '', '');				
		}
		
		
		
		
		
		#------------------------------------------------------------------------------------------------
		# CSV format for procurements_in_progress
		#------------------------------------------------------------------------------------------------
		else if($format == 'download_csv' && $scope['type'] == 'procurements_in_progress'){
			$array[0] = array('SECTION A: PROCUREMENTS IN PROGRESS', '', '', '', '', '', '');
			$array[1] = array('Name of Spending Agency: '.$list['pde'], '', '', '', 'Quarter: '.$list['quarter'],'', '');
			$array[2] = array('Procurement Number','Subject of Procurement','Procurement Method','Source of Funds','Approval Given For','Date of Approval','Estimated Contract Value (SSP)');
			
			$rowCount = 3;
			foreach($list['tenders'] AS $row) {
				$array[$rowCount] = array($row['procurement_number'],$row['subject_of_procurement'],$row['procurement_method'],$row['source_of_funds'],$row['approval_given_for'],$row['date_of_approval'],$row['estimated_contract_value']);
				$rowCount++;
			}
		}
		
		
		
		
		#------------------------------------------------------------------------------------------------
		# CSV format for contracts_signed
		#------------------------------------------------------------------------------------------------
		else if($format == 'download_csv' && $scope['type'] == 'contracts_signed'){
			$array[0] = array('SECTION B: CONTRACTS SIGNED IN THE QUARTER', '', '', '', '', '', '');
			$array[1] = array('Name of Spending Agency: '.$list['pde'], '', '', '', 'Quarter: '.$list['quarter'],'', '');
			$array[2] = array('Procurement Number','Subject of Procurement','Successful Supplier or Contractor','Source of Funds','Date of Award','Date Contract Signed','Contract Value QP Form_1');
			
			$rowCount = 3;
			foreach($list['tenders'] AS $row) {
				$array[$rowCount] = array($row['procurement_number'],$row['subject_of_procurement'],$row['successful_supplier_or_contractor'],$row['source_of_funds'],$row['date_of_award'],$row['date_contract_signed'],$row['contract_value']);
				$rowCount++;
			}
		}
		
		
		
		
		
		#------------------------------------------------------------------------------------------------
		# CSV format for procurements_completed
		#------------------------------------------------------------------------------------------------
		else if($format == 'download_csv' && $scope['type'] == 'procurements_completed'){
			$array[0] = array('SECTION C: PROCUREMENTS COMPLETED IN THE QUARTER', '', '', '', '', '', '');
			$array[1] = array('Name of Spending Agency: '.$list['pde'], '', '', '', 'Quarter: '.$list['quarter'],'', '');
			$array[2] = array('Procurement Number','Subject of Procurement','Supplier or Contractor','Source of Funds','Date of Completion','Date of Final Payment','Total Amount Paid (SSP)');
			
			$rowCount = 3;
			foreach($list['tenders'] AS $row) {
				$array[$rowCount] = array($row['procurement_number'],$row['subject_of_procurement'],$row['supplier_or_contractor'],$row['source_of_funds'],$row['date_of_completion'].' '.$row['date_reason'],$row['date_of_final_payment'],$row['total_amount_paid']);
				$rowCount++;
			}
		}
		
		
		
		
		
		#------------------------------------------------------------------------------------------------
		# CSV format for low_value_procurements
		#------------------------------------------------------------------------------------------------
		else if($format == 'download_csv' && $scope['type'] == 'low_value_procurements'){
			$array[0] = array('SECTION D: LOW VALUE PROCUREMENTS', '', '', '', '', '');
			$array[1] = array('UNDER SSP 25,000 for GOODS; UNDER SSP 50,000 for WORKS; UNDER 10,000 for GENERAL SERVICES & CONSULTANCY SERVICES', '', '', '', '', '');
			$array[2] = array('', '', '', '', '', '');
			$array[3] = array('Name of Spending Agency: '.$list['pde'], '', '', 'Quarter: '.$list['quarter'],'', '');
			$array[4] = array('Procurement Number','Subject of Procurement','Supplier or Contractor','Procurement Method','Date of Contract','Contract Value (SSP)');
			
			$rowCount = 5;
			foreach($list['tenders'] AS $row) {
				$array[$rowCount] = array($row['procurement_number'],$row['subject_of_procurement'],$row['supplier_or_contractor'],$row['procurement_method'],$row['date_of_contract'].' '.$row['contract_value']);
				$rowCount++;
			}
		}
		
		
		# any other report: simply pass through
		else $array = $list;
		
		
		return $array;
	}
	
	

	
	
	
	
	
	
	# get individual report stats based on required scope
	function stats($type, $financialYear = '')
	{
		$financialYear = !empty($financialYear)? $financialYear: @date('Y');
		
		switch($type)
		{
			case 'pde':
				return $this->_query_reader->get_row_as_array('get_pde_stats', array('pde_id'=>$this->native_session->get('__organization_id'), 'year'=>$financialYear));
			break;
			
			# TODO: add more stats here
			
			
			default:
				return array();
			break;
		}
	}
	
	
	
	
	
	
	
	
	
	
}


?>