<?php
if(!empty($msg)){
	echo format_notice($this, $msg); 

} else {
	echo "<table class='cell-border'>
	<tr>
	<td style='background: url(".base_url()."assets/images/grey_closer.png) no-repeat center center; cursor:pointer;'
	onclick=\"hideLayerSet('plan_details_div');showLayerSet('plan_details_div_show')\">&nbsp;</td>
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

	foreach($list AS $i=>$row){
		$dataRow = array_slice($row, 2, -2, true); # extract data part while preserving the keys
			
		# print out the valid rows
		echo "<tr>";
		# do not make the categories editable
		if(in_array(trim(strtolower($row['B'])), get_option_list($this, 'procurementcategories', 'array'))) {
			foreach($dataRow AS $key=>$cell) {
				if($key == 'A') {
					echo "<td style='background-color:#FF9;font-weight:bold;'>".(!empty($cell)? $cell: '&nbsp;')."
					<BR><img src='".IMAGE_URL."add_icon.png' class='add-plan-item' data-id='".$row['id']."'></td>";
				} else {
					echo "<td style='background-color:#FF9;font-weight:bold;'>".(!empty($cell)? $cell: '&nbsp;')."</td>";
				}
			}
		}
		# the data row
		else {
			foreach($dataRow AS $key=>$cell) {
				if($key == 'A') {
					echo "<td>".$cell."
					<BR><img src='".IMAGE_URL."remove_icon.png' class='remove-plan-item' data-id='".$row['id']."'></td>";
				} else {
					echo "<td><input type='text' id='plan__".$row['_plan_id']."_".$row['id']."_".$key."' name='plan_".$row['_plan_id']."[]' value='".$cell."' data-editurl='procurement_plans/edit_single_detail/d/".$row['id']."/k/".$key."' class='editable-field' style='width:90px;' /></td>";
				}
			}
		}
		echo "</tr>";
	}
	
	
	echo "</table>
	
	
<style>
.cell-border td {
    border: 1px solid black;
	font-size:12px;
}

.cell-border{
	border-collapse: collapse;
	background-color: #FFF;
}
</style>";
}
?>