<?php
$jquery = "<script src='".base_url()."assets/js/jquery.min.js' type='text/javascript'></script>";
$javascript = "<script type='text/javascript' src='".base_url()."assets/js/pss.js'></script>".get_ajax_constructor(TRUE);
$tableHTML = "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
if(!empty($area) && $area == "dropdown_list")
{
	$tableHTML .= !empty($list)? $list: "";
}

else if(!empty($area) && $area == "basic_msg")
{
	$tableHTML .= format_notice($this, $msg);
}

else if(!empty($area) && $area == "provider_details")
{
  # if there is a result set
  if($row){
    $tableHTML .= "<table>
  <tr>
    <td>Name</td>
    <td>".$row['name']."</td>
  </tr>
  <tr>
    <td>Contact</td>
    <td>".$row['contact_name']."</td>
  </tr>
  <tr>
    <td>Tax ID</td>
    <td>".$row['tax_id']."</td>
  </tr>
  <tr>
    <td>Category/Ministry</td>
    <td>".(!empty($row['category'])? $row['category']: $row['ministry'])."</td>
  </tr>
  <tr>
    <td>ROP #</td>
    <td><a href='javascript:;'>".$row['rop_number']."</a></td>
  </tr>
  <tr>
    <td>Country</td>
    <td>".$row['country']."</td>
  </tr>
  <tr>
    <td>Address</td>
    <td>".$row['address']."</td>
  </tr>
  <tr>
    <td>Status</td>
    <td>".strtoupper($row['status'])."</td>
  </tr>
  <tr>
    <td>Registered</td>
    <td>".date(FULL_DATE_FORMAT, strtotime($row['date_registered']))."</td>
  </tr>
  <tr>
    <td>Joined</td>
    <td>".date(FULL_DATE_FORMAT, strtotime($row['date_created']))."</td>
  </tr>
</table>
";
  }else{
    ?>
      <div class="message">
        No Data to display
      </div>
<?php


  }


}


else if(!empty($area) && $area == "user_details")
{
  //print_array($row);

	$tableHTML .= "<table align='center' width='100%'>
  <tr>
    <th>Name</th>
    <td>".$row['first_name']." ".$row['last_name']."</td>
  </tr>
  <tr>
    <th>Email</th>
    <td>".$row['email_address']."</td>
  </tr>
  <tr>
    <th>Telephone</th>
    <td>".$row['telephone']."</td>
  </tr>

  <tr>
    <th>User Group</th>
    <td>".$row['group_type']."</td>
  </tr>
<tr>
    <th>Gender</th>
    <td>".$row['gender']."</td>
  </tr>

</table>
";
}

else if(!empty($area) && $area == "refresh_list_msg")
{
	$tableHTML .= format_notice($this, $msg)."<br><br>
	<button type='button' id='refreshlistfromiframe' name='refreshlistfromiframe' class='btn blue' style='width:100%;' onclick='parent.location.reload();'>Refresh List</button>";
}


echo $tableHTML;
?>