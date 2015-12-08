<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.form.css' type='text/css' media='screen' />"; 

echo "<table> 
<tr><td colspan='2' class='h2 bold'>".$user['first_name'].' '.$user['last_name']."</td></tr>
<tr><td class='label'>Permission Group</td><td>".ucwords($user['group_type'])."</td></tr>
<tr><td class='label'>Email Address</td><td>".$user['email_address']."</td></tr>
<tr><td class='label'>Telephone</td><td>".$user['telephone']."</td></tr>

<tr><td class='label h4' colspan='2' style='padding-top:10px;'>Your Contact Address:</td></tr>
<tr><td class='label'>Address</td><td>".$user['address']."</td></tr>
<tr><td class='label'>City</td><td>".$user['city']."</td></tr>
<tr><td class='label'>Region/State</td><td>".$user['state']."</td></tr>
<tr><td class='label'>Zip Code</td><td>".$user['zipcode']."</td></tr>
<tr><td class='label'>Country</td><td>".$user['country']."</td></tr>
</table>";
?>