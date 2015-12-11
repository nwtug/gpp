<?php if(!empty($report_type) && $report_type == 'procurements_in_progress'){?>


<table class='cell-border'>
<tr><td colspan='7'><span style='font-weight:bold;'>SECTION A: PROCUREMENTS IN PROGRESS</span></td></tr>
<tr><td colspan='4'><span style='font-weight:bold;'>Name of Spending Agency:</span> <?php echo $list['pde'];?></td>
<td colspan='3'><span style='font-weight:bold;'>Quarter:</span> <?php echo $list['quarter'];?></td></tr>

<tr><td style='font-weight:bold;'>Procurement Number</td><td style='font-weight:bold;'>Subject of Procurement</td><td style='font-weight:bold;'>Procurement Method</td><td style='font-weight:bold;'>Source of Funds</td><td style='font-weight:bold;'>Approval Given For</td><td style='font-weight:bold;'>Date of Approval</td><td style='font-weight:bold;'>Estimated Contract Value</td>
</tr>
<?php 
foreach($list['tenders'] AS $row) {
	echo "<tr><td>".$row['procurement_number']."</td><td>".$row['subject_of_procurement']."</td><td>".$row['procurement_method']."</td><td>".$row['source_of_funds']."</td><td>".$row['approval_given_for']."</td><td>".$row['date_of_approval']."</td><td>SSP".format_number($row['estimated_contract_value'],13,0)."</td></tr>";
}
?>
</table>

<?php }










else if(!empty($report_type) && $report_type == 'contracts_signed'){?>

<table class='cell-border'>
<tr><td colspan='7'><span style='font-weight:bold;'>SECTION B: CONTRACTS SIGNED IN THE QUARTER</span></td></tr>
<tr><td colspan='4'><span style='font-weight:bold;'>Name of Spending Agency:</span> <?php echo $list['pde'];?></td>
<td colspan='3'><span style='font-weight:bold;'>Quarter:</span> <?php echo $list['quarter'];?></td></tr>

<tr><td style='font-weight:bold;'>Procurement Number</td><td style='font-weight:bold;'>Subject of Procurement</td><td style='font-weight:bold;'>Successful Supplier or Contractor</td><td style='font-weight:bold;'>Source of Funds</td><td style='font-weight:bold;'>Date of Award</td><td style='font-weight:bold;'>Date Contract Signed</td><td style='font-weight:bold;'>Contract Value QP Form_1</td>
</tr>
<?php 
foreach($list['tenders'] AS $row) {
	echo "<tr><td>".$row['procurement_number']."</td><td>".$row['subject_of_procurement']."</td><td>".$row['successful_supplier_or_contractor']."</td><td>".$row['source_of_funds']."</td><td>".$row['date_of_award']."</td><td>".$row['date_contract_signed']."</td><td>SSP".format_number($row['contract_value'],13,0)."</td></tr>";
}
?>
</table>

<?php }










else if(!empty($report_type) && $report_type == 'procurements_completed'){?>

<table class='cell-border'>
<tr><td colspan='7'><span style='font-weight:bold;'>SECTION C: PROCUREMENTS COMPLETED IN THE QUARTER</span></td></tr>
<tr><td colspan='4'><span style='font-weight:bold;'>Name of Spending Agency:</span> <?php echo $list['pde'];?></td>
<td colspan='3'><span style='font-weight:bold;'>Quarter:</span> <?php echo $list['quarter'];?></td></tr>

<tr><td style='font-weight:bold;'>Procurement Number</td><td style='font-weight:bold;'>Subject of Procurement</td><td style='font-weight:bold;'>Supplier or Contractor</td><td style='font-weight:bold;'>Source of Funds</td><td style='font-weight:bold;'>Date of Completion</td><td style='font-weight:bold;'>Date of Final Payment</td><td style='font-weight:bold;'>Total Amount Paid (SSP)</td>
</tr>
<?php 
foreach($list['tenders'] AS $row) {
	echo "<tr><td>".$row['procurement_number']."</td><td>".$row['subject_of_procurement']."</td><td>".$row['supplier_or_contractor']."</td><td>".$row['source_of_funds']."</td><td>".$row['date_of_completion']."<br>".$row['date_reason']."</td><td>".$row['date_of_final_payment']."</td><td>".format_number($row['total_amount_paid'],13,0)."</td></tr>";
}		
?>
</table>

<?php }






			


else if(!empty($report_type) && $report_type == 'low_value_procurements'){?>

<table class='cell-border'>
<tr><td colspan='6'><span style='font-weight:bold;'>SECTION D: LOW VALUE PROCUREMENTS</span></td></tr>
<tr><td colspan='6'><span style='font-weight:bold;'>UNDER SSP 25,000 for GOODS; UNDER SSP 50,000 for WORKS; UNDER 10,000 for GENERAL SERVICES & CONSULTANCY SERVICES</span></td></tr>
<tr><td colspan='6'>&nbsp;</td></tr>
<tr><td colspan='3'><span style='font-weight:bold;'>Name of Spending Agency:</span> <?php echo $list['pde'];?></td>
<td colspan='3'><span style='font-weight:bold;'>Quarter:</span> <?php echo $list['quarter'];?></td></tr>

<tr><td style='font-weight:bold;'>Procurement Number</td><td style='font-weight:bold;'>Subject of Procurement</td><td style='font-weight:bold;'>Supplier or Contractor</td><td style='font-weight:bold;'>Procurement Method</td><td style='font-weight:bold;'>Date of Contract</td><td style='font-weight:bold;'>Contract Value (SSP)</td>
</tr>
<?php 
foreach($list['tenders'] AS $row) {
	echo "<tr><td>".$row['procurement_number']."</td><td>".$row['subject_of_procurement']."</td><td>".$row['supplier_or_contractor']."</td><td>".$row['procurement_method']."</td><td>".$row['date_of_contract']."</td><td>SSP".format_number($row['contract_value'],13,0)."</td></tr>";
}		
?>
</table>

<?php }










# 'procurement_plan_tracking'
else {?>

<table class='cell-border'>
<tr><td colspan='8'><span style='font-weight:bold;'>Name of Spending Agency:</span> <?php echo $list['pde'];?></td>
<td colspan='8'><span style='font-weight:bold;'>Quarter:</span> <?php echo $list['quarter'];?></td></tr>

<tr><td>&nbsp;</td><td style='font-weight:bold;'>Brief Description</td><td style='font-weight:bold;'>Procurement Method</td><td style='font-weight:bold;'>Estimate in SSP</td><td style='font-weight:bold;'>Plan/Actual</td><td style='font-weight:bold;'>Tender Document/RFP</td><td style='font-weight:bold;'>Bid/EOI Invitation &amp; Open</td><td style='font-weight:bold;'>Bid/EOI Evaluation/Short List</td><td style='font-weight:bold;'>Issuance of RFP (Services)</td><td style='font-weight:bold;'>Receipt of RFP (Service)</td>
  <td style='font-weight:bold;'>Evaluation /Negotiate</td><td style='font-weight:bold;'>Contract Approval MoFEP</td><td style='font-weight:bold;'>Contract Endorsement MoJ</td><td style='font-weight:bold;'>Contract Award</td><td style='font-weight:bold;'>Commencement of Contract</td><td style='font-weight:bold;'>Contract Completion</td>
</tr>


<?php $catCount = 1;
foreach($list['tenders'] AS $category=>$subList) {
	echo "<tr style='background-color:#FF9;'>
		<td style='font-weight:bold;'>".$catCount."</td><td colspan='15' style='font-weight:bold;'>".$category."</td>
		</tr>";

	$subCatCount = 1;
	foreach($subList AS $row){
		
		echo "<tr>
<td>".((empty($prevId) || $prevId != $row['tender_id'])? $catCount.".".$subCatCount: '&nbsp;')."</td><td>".html_entity_decode($row['brief_description'], ENT_QUOTES)."</td>
<td>".$row['procurement_method']."</td><td>SSP".format_number($row['ssp_estimate'], 13,0)."</td><td>".$row['plan_or_actual']."</td><td>".$row['rfp_status']."</td><td>".$row['bid_open_status']."</td><td>".$row['bid_short_list_status']."</td><td>".$row['issuance_of_rfp_status']."</td><td>".$row['receipt_of_rfp_status']."</td><td>".$row['evaluation_status']."</td><td>".$row['contract_approval_status']."</td><td>".$row['contract_endorsement_status']."</td><td>".$row['contract_award_status']."</td><td>".$row['contract_commencement_status']."</td><td>".$row['contract_completion_status']."</td>
</tr>";
		# increment only for a new tender
		if(empty($prevId) || $prevId != $row['tender_id']) $subCatCount++;
		
		$prevId = $row['tender_id'];
	}
	
	$catCount++;
}
?>

<tr>
  <td rowspan="2">&nbsp;</td>
  <td colspan='3' rowspan="2" style='font-weight:bold;'>Total Cost of Goods/Works/Services</td>
  <td>Plan</td>
  <td colspan='11'><?php echo 'SSP'.format_number($list['totals']['plan'],3);?></td>
</tr>
<tr>
  <td colspan='1'>Actual</td>
  <td colspan='11'><?php echo 'SSP'.format_number($list['totals']['actual'],3);?></td>
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
</table>
<?php }?>


<style>
.cell-border td {
    border: 1px solid black;
	font-size:12px;
}
</style>

