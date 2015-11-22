<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.form.css' type='text/css' media='screen' />"; 

echo "<table> 
<tr><td colspan='2' class='h2 bold'>".$organization['name']."</td></tr>
<tr><td class='label'>Description</td><td>".$organization['description']."</td></tr>
<tr><td class='label'>Tax ID</td><td>".$organization['tax_id']."</td></tr>
<tr><td class='label'>Registration Number</td><td>".$organization['registration_number']."</td></tr>
<tr><td class='label'>Administrator</td><td>".$organization['owner']."</td></tr>
<tr><td class='label'>Date Registered</td><td>".$organization['date_established']."</td></tr>
<tr><td class='label'>Registration Country</td><td>".$organization['registration_country']."</td></tr>
<tr><td class='label'>Category/Ministry</td><td>".$organization['category_or_ministry']."</td></tr>
<tr><td class='label'>Address</td><td>".$organization['address']."</td></tr>
<tr><td class='label'>Status</td><td>".strtoupper($organization['status'])."</td></tr>

<tr><td class='label'>Date Entered</td><td>".date(SHORT_DATE_FORMAT, strtotime($organization['date_entered']))."</td></tr>
<tr><td class='label'>Entered By</td><td>".$organization['entered_by']."</td></tr>
<tr><td class='label'>Last Updated</td><td>".date(SHORT_DATE_FORMAT, strtotime($organization['last_updated']))."</td></tr>
<tr><td class='label'>Last Updated By</td><td>".$organization['last_updated_by']."</td></tr>

</table>";
?>