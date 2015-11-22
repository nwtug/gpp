<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.form.css' type='text/css' media='screen' />"; 

if(!empty($msg)){
	echo format_notice($this, $msg);
}
else
{
echo "<div class='home-list-div' style='min-height:250px;'><table>
	<tr><th class='bold'>Submitted</th><th class='bold'>Provider</th><th class='bold'>Amount</th><th class='bold'>Status</th><th class='bold'>Validity Period</th><th class='bold'>Documents</th></tr>";

foreach($list AS $row){
	
echo "<tr><td>".date(SHORT_DATE_FORMAT, strtotime($row['date_submitted']))."</td>
<td>".html_entity_decode($row['provider'], ENT_QUOTES)."</td>
<td>".$row['bid_currency'].format_number($row['bid_amount'],0)."</td>
<td>".strtoupper($row['status'])."</td>

<td>".date(SHORT_DATE_FORMAT, strtotime($row['valid_start_date']))." TO ".date(SHORT_DATE_FORMAT, strtotime($row['valid_end_date']))."</td>
<td>";

	$documents = explode(',',$row['documents']);
	foreach($documents AS $document) echo "<a href='".base_url()."pages/download/file/".$document."'>".$document."</a>"; 

echo "</td></tr>";
}
echo "</table></div>";
}
?>