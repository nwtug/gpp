<?php
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";

if(!empty($msg)){
	echo format_notice($this, $msg);
} else {
	echo "<table class='default-table list-table'>";
	foreach($list AS $row){
		echo "<tr>
		<td style='width:1%;'><input type='radio' id='bidid_".$row['bid_id']."' name='bidid' value='".$row['bid_id']."' ".($row['bid_id'] == $row['winner_bid']? 'checked': '')."/></td>
		<td style='word-wrap: break-word;'>".html_entity_decode($row['provider_name'], ENT_QUOTES)."</td>
		<td style='width:1%;'>".$row['bid_currency'].format_number($row['bid_amount'],3,0)."</td>
		<td style='width:1%;'><input type='text' id='reason_".$row['bid_id']."' name='reason_".$row['bid_id']."' class='optional' style='min-width:130px !important; width:200px;' placeholder='OPTIONAL: Reason' value='".(!empty($row['reason'])? addslashes(html_entity_decode($row['reason'], ENT_QUOTES)): '')."' /></td>
		</tr>";
	}
	echo "</table>";
}
?>