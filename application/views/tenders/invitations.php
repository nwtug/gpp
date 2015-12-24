<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.form.css' type='text/css' media='screen' />"; 


echo "Invitation For: <span class='bold'>".html_entity_decode($tender['subject'], ENT_QUOTES)."</span>";

if($this->native_session->get('__user_type') != 'pde'){
	echo "<br>Procurement/Disposal Entity: ".html_entity_decode($tender['pde'], ENT_QUOTES);
}

if(!empty($msg)){
	echo "<br><br>".format_notice($this, $msg);
}
else
{
echo "<br><br>
<table class='list-table' style='width:100%;'>
		<tr><th>Provider</th><th>Message</th><th style='width:1%;white-space:nowrap;'>Last Invited</th><th>Last Invited By</th></tr>";
	foreach($invited AS $row){
		echo "<tr>
		<td style='vertical-align:top;'>".html_entity_decode($row['provider'], ENT_QUOTES)."</td>
		<td style='vertical-align:top;'>".html_entity_decode($row['note'], ENT_QUOTES)."</td>
		<td style='vertical-align:top;'>".date(FULL_DATE_FORMAT, strtotime($row['last_invited']))."</td>
		<td style='vertical-align:top;'>".html_entity_decode($row['last_invited_by'], ENT_QUOTES)."</td>
		</tr>";
	}
	
	echo "</table>";
}
?>