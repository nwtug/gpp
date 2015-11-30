<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.form.css' type='text/css' media='screen' />"; 


if(!empty($msg)){
	echo format_notice($this, $msg);
}
else
{
echo "<table>
<tr><td class='label'>PDE</td><td>".html_entity_decode($contract['pde'], ENT_QUOTES)."</td></tr>
<tr><td class='label'>Related Tender</td><td>".html_entity_decode($contract['tender_notice'], ENT_QUOTES)."</td></tr>
<tr><td class='label'>Name</td><td>".html_entity_decode($contract['name'], ENT_QUOTES)."</td></tr>
<tr><td class='label'>Amount</td><td>".$contract['contract_currency'].format_number($contract['contract_amount'],3)."</td></tr>
<tr><td class='label'>Progress</td><td>".$contract['progress_percent']."%</td></tr>
<tr><td class='label'>Date Started</td><td>".date(SHORT_DATE_FORMAT, strtotime($contract['date_started']))."</td></tr>
<tr><td class='label'>Status</td><td>".strtoupper($contract['status'])."</td></tr>
<tr><td class='label'>Last Updated</td><td>".date(FULL_DATE_FORMAT, strtotime($contract['last_updated']))."</td></tr>
<tr><td class='label'>Last Updated By</td><td>".$contract['last_updated_by']."</td></tr>
</table>";
}
?>