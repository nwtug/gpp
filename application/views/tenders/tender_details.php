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
<tr><td colspan='2' class='h2 bold'>".$tender['name']."</td></tr>
<tr><td colspan='2'>".$tender['description']."</td></tr>
<tr><td class='label'>PDE</td><td>".$tender['pde']."</td></tr>
<tr><td class='label'>Procurement Plan</td><td>".$tender['procurement_plan']."</td></tr>
<tr><td class='label'>Type</td><td>".ucfirst($tender['type'])."</td></tr>
<tr><td class='label'>Method</td><td>".ucwords(str_replace('_', ' ', $tender['method']))."</td></tr>
<tr><td class='label'>Document</td><td><a href='".base_url()."pages/download/file/".$tender['document_url']."'>".$tender['document_url']."</a></td></tr>
<tr><td class='label'>Deadline</td><td>".date(SHORT_DATE_FORMAT, strtotime($tender['deadline']))."</td></tr>";

if($this->native_session->get('__user_type') != 'provider'){
echo "<tr><td class='label long'>Display Start Date</td><td>".date(SHORT_DATE_FORMAT, strtotime($tender['display_start_date']))."</td></tr>
<tr><td class='label long'>Display End Date</td><td>".date(SHORT_DATE_FORMAT, strtotime($tender['display_end_date']))."</td></tr>
<tr><td class='label'>Status</td><td>".strtoupper($tender['status'])."</td></tr>
<tr><td class='label'>Date Entered</td><td>".date(FULL_DATE_FORMAT, strtotime($tender['date_entered']))."</td></tr>
<tr><td class='label'>Entered By</td><td>".$tender['entered_by']."</td></tr>
<tr><td class='label'>Last Updated</td><td>".date(FULL_DATE_FORMAT, strtotime($tender['last_updated']))."</td></tr>
<tr><td class='label'>Last Updated By</td><td>".$tender['last_updated_by']."</td></tr>";
}

echo "</table>";
}
?>