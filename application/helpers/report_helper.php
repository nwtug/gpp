<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function generate_report_html($data, $type)
{
	# pick the right report and fill it up with the provided data
	
	
	
	#-----------------------------------------------------------------------------------------------------------
	# PROCUREMENT PLAN TRACKING
	#-----------------------------------------------------------------------------------------------------------
	if($type == 'procurement_plan_tracking'){
		$html = "<table class='cell-border'>
<tr><td colspan='16'><span style='font-weight:bold;'>Name of Spending Agency:</span> ".$data[0][0]."</td></tr>
<tr><td>&nbsp;</td><td style='font-weight:bold;'>Brief Description</td><td style='font-weight:bold;'>Procurement Method</td><td style='font-weight:bold;'>Estimate in SSP</td><td style='font-weight:bold;'>Plan/Actual</td><td style='font-weight:bold;'>Tender Document/RFP</td><td style='font-weight:bold;'>Bid/EOI Invitation &amp; Open</td><td style='font-weight:bold;'>Bid/EOI Evaluation/Short List</td><td style='font-weight:bold;'>Issuance of RFP (Services)</td><td style='font-weight:bold;'>Receipt of RFP (Service)</td>
  <td style='font-weight:bold;'>Evaluation /Negotiate</td><td style='font-weight:bold;'>Contract Approval MoFEP</td><td style='font-weight:bold;'>Contract Endorsement MoJ</td><td style='font-weight:bold;'>Contract Award</td><td style='font-weight:bold;'>Commencement of Contract</td><td style='font-weight:bold;'>Contract Completion</td>
</tr>";

# first row is the name of the spending agency
for($i=1;$i<count($data);$i++){
	$section = 1;
	$subSection = 1;
	
	# section heading
	if(count($data[$i]) == 2 && $data[$i][0] != 'Actual'){
		$html .= "<tr style='background-color:#FF9;'>
<td style='font-weight:bold;'>".$data[$i][0]."</td><td colspan='15' style='font-weight:bold;'>".$data[$i][1]."</td>
</tr>";
	} 
	# overall totals - actual
	else if(count($data[$i]) == 2){
		$html .= "<tr>
  <td colspan='1'>".$data[$i][0]."</td>
  <td colspan='11'>".$data[$i][1]."</td>
</tr>";
	}
	# overall totals - plan
	else if(count($data[$i]) == 4){
		$html .= "<tr>
  <td rowspan='2'>".$data[$i][0]."</td>
  <td colspan='3' rowspan='2' style='font-weight:bold;'>".$data[$i][1]."</td>
  <td>".$data[$i][2]."</td>
  <td colspan='11'>".$data[$i][3]."</td>
</tr>";
	}
	# section details
	else {
		$html .= "<tr>";
		foreach($data[$i] AS $cellData) $html .= "<td>".$cellData."</td>";
		$html .= "</tr>";
	}
}

$html .= "<tr>
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

<style>
.cell-border td {
    border: 1px solid black;
	font-size:12px;
}
</style>";
	}




















	return $html;
}


?>