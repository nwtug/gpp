<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function generate_report_html($list, $type, $obj=NULL)
{
	# pick the right report and fill it up with the provided data
	
	
	
	#-----------------------------------------------------------------------------------------------------------
	# PROCUREMENT PLAN TRACKING
	#-----------------------------------------------------------------------------------------------------------
	if($type == 'procurement_plan_tracking'){
		$html = "<table cellpadding='3' cellspacing='0' class='cell-border'>
<tr><td colspan='8' style='background-color: #EDEDED;'><span style='font-weight:bold;'>Name of Spending Agency:</span> ".$list['pde']."</td>
<td colspan='8' style='background-color: #EDEDED;'><span style='font-weight:bold;'>Quarter:</span> ".$list['quarter']."</td></tr>

<tr><td>&nbsp;</td><td style='font-weight:bold;'>Brief Description</td><td style='font-weight:bold;'>Procurement Method</td><td style='font-weight:bold;'>Estimate in SSP</td><td style='font-weight:bold;'>Plan/Actual</td><td style='font-weight:bold;'>Tender Document/RFP</td><td style='font-weight:bold;'>Bid/EOI Invitation &amp; Open</td><td style='font-weight:bold;'>Bid/EOI Evaluation/Short List</td><td style='font-weight:bold;'>Issuance of RFP (Services)</td><td style='font-weight:bold;'>Receipt of RFP (Service)</td>
  <td style='font-weight:bold;'>Evaluation /Negotiate</td><td style='font-weight:bold;'>Contract Approval MoFEP</td><td style='font-weight:bold;'>Contract Endorsement MoJ</td><td style='font-weight:bold;'>Contract Award</td><td style='font-weight:bold;'>Commencement of Contract</td><td style='font-weight:bold;'>Contract Completion</td>
</tr>";

# first row is the name of the spending agency
$catCount = 1;
foreach($list['tenders'] AS $category=>$subList){
	# section heading
	$html .= "<tr>
<td style='font-weight:bold;background-color:#FF9;'>".$catCount."</td><td colspan='15' style='font-weight:bold;background-color:#FF9;'>".$category."</td>
</tr>";
	
	$subCatCount = 1;
	foreach($subList AS $row){
		
		$html .= "<tr>
<td>".((empty($prevId) || $prevId != $row['tender_id'])? $catCount.".".$subCatCount: '&nbsp;')."</td><td>".html_entity_decode($row['brief_description'], ENT_QUOTES)."</td>
<td>".$row['procurement_method']."</td><td>SSP".format_number($row['ssp_estimate'], 3)."</td><td>".$row['plan_or_actual']."</td><td>".$row['rfp_status']."</td><td>".$row['bid_open_status']."</td><td>".$row['bid_short_list_status']."</td><td>".$row['issuance_of_rfp_status']."</td><td>".$row['receipt_of_rfp_status']."</td><td>".$row['evaluation_status']."</td><td>".$row['contract_approval_status']."</td><td>".$row['contract_endorsement_status']."</td><td>".$row['contract_award_status']."</td><td>".$row['contract_commencement_status']."</td><td>".$row['contract_completion_status']."</td>
</tr>";
		# increment only for a new tender
		if(empty($prevId) || $prevId != $row['tender_id']) $subCatCount++;
		
		$prevId = $row['tender_id'];
	}
	
	$catCount++;
}

$html .= "<tr>
  <td rowspan='2' style='background-color: #EDEDED;'>&nbsp;</td>
  <td colspan='3' rowspan='2' style='font-weight:bold;background-color: #EDEDED;'>Total Cost of Goods/Works/Services</td>
  <td style='background-color: #EDEDED;'>Plan</td>
  <td colspan='11' style='background-color: #EDEDED;'>SSP".format_number($list['totals']['plan'],3)."</td>
</tr>
<tr>
  <td colspan='1' style='background-color: #EDEDED;'>Actual</td>
  <td colspan='11' style='background-color: #EDEDED;'>SSP".format_number($list['totals']['actual'],3)."</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colspan='15'>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colspan='15'><span style='font-weight:bold;'>Notes:</span>
  <br />RFQ - Request for Quotation
  <br />IC - Individual Consultancy	
  <br />EOI - Expressions of Interest
  <br />RFP - Request for Proposal
  <br />LCS - Least Cost Selection	
  <br />HPE - Head of Procuring Entity
  <br />MoFEP - Ministry of Finance and Economic Planning
  <br />MoJ - Ministry of Justice	
  <br />ICT - International Competitive Tendering	
  <br />PC - Procurement Committee				
  <br />NCT - National Competitive Tendering	
  <br />QCBS - Quality and Cost Based Selection				
</td>
</tr>
</table>";
	}



	
	
	#-----------------------------------------------------------------------------------------------------------
	# PROCUREMENTS IN PROGRESS
	#-----------------------------------------------------------------------------------------------------------
	else if($type == 'procurements_in_progress'){
		$html = "<table cellpadding='3' cellspacing='0' class='cell-border'><tr><td colspan='7'><span style='font-weight:bold;'>SECTION A: PROCUREMENTS IN PROGRESS</span></td></tr>
<tr><td colspan='4'><span style='font-weight:bold;'>Name of Spending Agency:</span>".$list['pde']."</td>
<td colspan='3'><span style='font-weight:bold;'>Quarter:</span> ".$list['quarter']."</td></tr>

<tr><td style='font-weight:bold;'>Procurement Number</td><td style='font-weight:bold;'>Subject of Procurement</td><td style='font-weight:bold;'>Procurement Method</td><td style='font-weight:bold;'>Source of Funds</td><td style='font-weight:bold;'>Approval Given For</td><td style='font-weight:bold;'>Date of Approval</td><td style='font-weight:bold;'>Estimated Contract Value</td>
</tr>";

		foreach($list['tenders'] AS $row) {
			$html .= "<tr><td>".$row['procurement_number']."</td><td>".$row['subject_of_procurement']."</td><td>".$row['procurement_method']."</td><td>".$row['source_of_funds']."</td><td>".$row['approval_given_for']."</td><td>".$row['date_of_approval']."</td><td>SSP".$row['estimated_contract_value']."</td></tr>";
		}
		
		$html .= "</table>";
	}



	
	
	#-----------------------------------------------------------------------------------------------------------
	# CONTRACTS SIGNED
	#-----------------------------------------------------------------------------------------------------------
	else if($type == 'contracts_signed'){
		$html = "<table cellpadding='3' cellspacing='0' class='cell-border'><tr><td colspan='7'><span style='font-weight:bold;'>SECTION B: CONTRACTS SIGNED IN THE QUARTER</span></td></tr>
<tr><td colspan='4'><span style='font-weight:bold;'>Name of Spending Agency:</span>".$list['pde']."</td>
<td colspan='3'><span style='font-weight:bold;'>Quarter:</span> ".$list['quarter']."</td></tr>

<tr><td style='font-weight:bold;'>Procurement Number</td><td style='font-weight:bold;'>Subject of Procurement</td><td style='font-weight:bold;'>Successful Supplier or Contractor</td><td style='font-weight:bold;'>Source of Funds</td><td style='font-weight:bold;'>Date of Award</td><td style='font-weight:bold;'>Date Contract Signed</td><td style='font-weight:bold;'>Contract Value QP Form_1</td>
</tr>";

		foreach($list['tenders'] AS $row) {
			$html .= "<tr><td>".$row['procurement_number']."</td><td>".$row['subject_of_procurement']."</td><td>".$row['successful_supplier_or_contractor']."</td><td>".$row['source_of_funds']."</td><td>".$row['date_of_award']."</td><td>".$row['date_contract_signed']."</td><td>SSP".$row['contract_value']."</td></tr>";
		}
		
		$html .= "</table>";
	}



	
	
	#-----------------------------------------------------------------------------------------------------------
	# PROCUREMENTS COMPLETED
	#-----------------------------------------------------------------------------------------------------------
	else if($type == 'procurements_completed'){
		$html = "<table cellpadding='3' cellspacing='0' class='cell-border'><tr><td colspan='7'><span style='font-weight:bold;'>SECTION C: PROCUREMENTS COMPLETED IN THE QUARTER</span></td></tr>
<tr><td colspan='4'><span style='font-weight:bold;'>Name of Spending Agency:</span>".$list['pde']."</td>
<td colspan='3'><span style='font-weight:bold;'>Quarter:</span> ".$list['quarter']."</td></tr>

<tr><td style='font-weight:bold;'>Procurement Number</td><td style='font-weight:bold;'>Subject of Procurement</td><td style='font-weight:bold;'>Supplier or Contractor</td><td style='font-weight:bold;'>Source of Funds</td><td style='font-weight:bold;'>Date of Completion</td><td style='font-weight:bold;'>Date of Final Payment</td><td style='font-weight:bold;'>Total Amount Paid (SSP)</td>
</tr>";

		foreach($list['tenders'] AS $row) {
			$html .= "<tr><td>".$row['procurement_number']."</td><td>".$row['subject_of_procurement']."</td><td>".$row['supplier_or_contractor']."</td><td>".$row['source_of_funds']."</td><td>".$row['date_of_completion']."<br>".$row['date_reason']."</td><td>".$row['date_of_final_payment']."</td><td>SSP".$row['total_amount_paid']."</td></tr>";
		}
		
		$html .= "</table>";
	}
	



	
	
	#-----------------------------------------------------------------------------------------------------------
	# LOW VALUE PROCUREMENTS
	#-----------------------------------------------------------------------------------------------------------
	else if($type == 'low_value_procurements'){
		$html = "<table cellpadding='3' cellspacing='0' class='cell-border'>
		<tr><td colspan='6'><span style='font-weight:bold;'>SECTION D: LOW VALUE PROCUREMENTS</span></td></tr>
		<tr><td colspan='6'><span style='font-weight:bold;'>UNDER SSP 25,000 for GOODS; UNDER SSP 50,000 for WORKS; UNDER 10,000 for GENERAL SERVICES & CONSULTANCY SERVICES</span></td></tr>
		<tr><td colspan='6'>&nbsp;</td></tr>
		
<tr><td colspan='3'><span style='font-weight:bold;'>Name of Spending Agency:</span>".$list['pde']."</td>
<td colspan='3'><span style='font-weight:bold;'>Quarter:</span> ".$list['quarter']."</td></tr>

<tr><td style='font-weight:bold;'>Procurement Number</td><td style='font-weight:bold;'>Subject of Procurement</td><td style='font-weight:bold;'>Supplier or Contractor</td><td style='font-weight:bold;'>Procurement Method</td><td style='font-weight:bold;'>Date of Contract</td><td style='font-weight:bold;'>Contract Value (SSP)</td>
</tr>";

		foreach($list['tenders'] AS $row) {
			$html .= "<tr><td>".$row['procurement_number']."</td><td>".$row['subject_of_procurement']."</td><td>".$row['supplier_or_contractor']."</td><td>".$row['procurement_method']."</td><td>".$row['date_of_contract']."</td><td>SSP".$row['contract_value']."</td></tr>";
		}
		
		$html .= "</table>";
	}
	



	
	
	#-----------------------------------------------------------------------------------------------------------
	# PROCUREMENT PLAN - for download
	#-----------------------------------------------------------------------------------------------------------
	else if($type == 'procurement_plan'){
		$html = "<table cellpadding='3' cellspacing='0' class='cell-border'>
		<tr><td colspan='8'><span style='font-weight:bold;'>Name: ".html_entity_decode($list['name'], ENT_QUOTES)."</span></td><td colspan='7'><span style='font-weight:bold;'>PDE: ".html_entity_decode($list['pde'], ENT_QUOTES)."</span></td></tr>
		<tr>
		<td>&nbsp;</td>
	<td style='font-weight:bold;'>Brief Description</td>
	<td style='font-weight:bold;'>Procurement Method</td>
	<td style='font-weight:bold;'>Estimate in SSP</td>
	<td style='font-weight:bold;'>Tender Document/RFP</td>
	<td style='font-weight:bold;'>Bid/EOI Invitation &amp; Open</td>
	<td style='font-weight:bold;'>Bid/EOI Evaluation/Short List</td>
	<td style='font-weight:bold;'>Issuance of RFP (Services)</td>
	<td style='font-weight:bold;'>Receipt of RFP (Service)</td>
    <td style='font-weight:bold;'>Evaluation /Negotiate</td>
	<td style='font-weight:bold;'>Contract Approval MoFEP</td>
	<td style='font-weight:bold;'>Contract Endorsement MoJ</td>
	<td style='font-weight:bold;'>Contract Award</td>
	<td style='font-weight:bold;'>Commencement of Contract</td>
	<td style='font-weight:bold;'>Contract Completion</td>
	</tr>";

		foreach($list['list'] AS $i=>$row){
			$dataRow = array_slice($row, 2, -2, true); # extract data part while preserving the keys
			
			# print out the valid rows
			$html .= "<tr>";
			# make the category row cells have a yellow background
			if(in_array(trim(strtolower($row['B'])), get_option_list($obj, 'procurementcategories', 'array'))) {
				foreach($dataRow AS $key=>$cell) {
					$html .= "<td style='background-color:#FF9;font-weight:bold;'>".(!empty($cell)? $cell: '&nbsp;')."</td>";
				}
			}
			# the data row
			else foreach($dataRow AS $key=>$cell) $html .= "<td>".$cell."</td>";
			
			$html .= "</tr>";
		}
	
	
		$html .= "</table>";
	}
	
	
	
	
	











# Common report css
$html .= "<style>
.cell-border {
	border: 1px solid #999;
	border-collapse: collapse;
}
.cell-border td {
	font-size:11px;
	font-family: Arial, sans-serif;
	border: 1px solid #999;
	vertical-align:top;
}

</style>";





	return $html;
}















# generate certificate HTML
function generate_certificate_html($list, $type)
{
	#
	$html = "<table cellpadding='10' style='width:100%;font-size:20px; font-family:Verdana, Geneva, sans-serif; border: 10px solid #F1F1F1;'>
<tr><td style='text-align:center;' colspan='3'><img src='".IMAGE_URL."registration_certificate_header.png' border='0' /></td></tr>
<tr><td colspan='3' style='text-align:center;height:440px;'>
This document has been issued to 
<br>
<br>
<span style='font-size:30px;font-weight:800;'>".$list['provider_name']."</span>
<br>
<br>
by the Ministry of Finance and Economic Planning 
<br>(Directorate of Public Procurement)
<br>as a confirmation of their addition to the register of providers 
<br>for the Republic of South Sudan.
</td></tr>";

$html .= "<tr>
<td style='width:33%;text-align:left;'>
<img src='".base_url()."external_libraries/phpqrcode/qr_code.php?value=".$list['certificate_number']."&size=4' border='0' />
<br><span style=\"font-weight:bold; font-family:\'Courier New\', Courier, monospace; font-size:10px;\">".$list['certificate_number']."</span></td>

<td style='width:33%;text-align:center;font-size:14px;'><div style='border-bottom:1px solid #000; white-space:nowrap;'>&nbsp;&nbsp;&nbsp;&nbsp;<img src='".IMAGE_URL."minister_of_finance_signature.png' border='0' />&nbsp;&nbsp;&nbsp;&nbsp;</div>
<br>For: David Deng Athorbei</td>

<td style='width:33%; text-align:right;font-size:14px;'>Valid: 
<br><span style='font-weight:bold;'>FROM ".@date('d/m/Y')."
<br> TO ".$list['valid_until']."</span>";

if(!empty($list['amount_paid'])) {
	$html .= "<br><br>Fee: <span style='font-weight:bold;'>SSP".format_number($list['amount_paid'],7,0)."</span>";
}

$html .= "</td></tr>";
$html .= "</table>";
	
	return $html;
}














?>