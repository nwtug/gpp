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
<tr><td colspan='2' class='h2 bold'>".$plan['name']
		.(!empty($plan['reference_number'])? "<BR>(".$plan['reference_number'].")":"")."</td></tr>
<tr><td colspan='2'>".$plan['details']."</td></tr>
<tr><td class='label'>PDE</td><td>".$plan['pde']."</td></tr>
<tr><td class='label'>Financial Period</td><td>".date('Y', strtotime($plan['financial_year_start']))." TO ".date('Y', strtotime($plan['financial_year_end']))."</td></tr>
<tr><td class='label'>Status</td><td>".strtoupper($plan['status'])."</td></tr>
<tr><td class='label'>Document</td><td><a href='".base_url()."pages/download/file/".$plan['document_url']."'>".$plan['document_url']."</a></td></tr>

<tr><td class='label'>Date Entered</td><td>".date(SHORT_DATE_FORMAT, strtotime($plan['date_entered']))."</td></tr>
<tr><td class='label'>Entered By</td><td>".$plan['entered_by']."</td></tr>
<tr><td class='label'>Last Updated</td><td>".date(SHORT_DATE_FORMAT, strtotime($plan['last_updated']))."</td></tr>
<tr><td class='label'>Last Updated By</td><td>".$plan['last_updated_by']."</td></tr>

</table>";
}
?>