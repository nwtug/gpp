<?php 
$stopHtml = "<input name='paginationdiv__provider_stop' id='paginationdiv__provider_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";

if(!empty($list)){
	echo "<tr><th style='width:1%;'>&nbsp;</th><th>Name</th><th>Contact</th><th>Tax ID</th><th>Category/Ministry</th><th style='white-space:nowrap;'>ROP #</th><th>Country</th><th>Address</th><th>Status</th><th>Registered</th><th>Joined</th><th>Expiry</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td><input id='select_".$row['organization_id']."' name='selectall[]' type='checkbox' value='".$row['organization_id']."' class='bigcheckbox'><label for='select_".$row['organization_id']."'></label></td>
		<td>".$row['name']."</td>

		<td><a href='".base_url()."users/details/d/".$row['contact_id']."' class='shadowbox closable'>".$row['contact_name']."</a></td>
		<td>".$row['tax_id']."</td>
		<td>".(!empty($row['category'])? $row['category']: $row['ministry'])."</td>
		<td>".(!empty($row['rop_number'])? "<a href='".base_url()."pages/download/file/".$row['rop_certificate_url']."'>".$row['rop_number']."</a>": "");
		
		if($this->native_session->get('__user_type') == 'admin'){ 
			echo "<div class='green-box btn shadowbox closable' data-url='".base_url()."providers/generate_certificate/d/".$row['organization_id']."'>Generate</div>";
		}
		echo "</td>
		<td>".$row['country']."</td>
		<td>".$row['address']."</td>
		<td>".strtoupper($row['status'])."</td>
		<td>".($row['date_registered'] != '0000-00-00'? date(SHORT_DATE_FORMAT, strtotime($row['date_registered'])): 'UNKNOWN')."</td>
		<td>".date(FULL_DATE_FORMAT, strtotime($row['date_created']))."</td>
		<td>".($row['expiry_date'] != '0000-00-00'? date(FULL_DATE_FORMAT, strtotime($row['expiry_date'])): 'UNKNOWN');
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
}

else {
	echo "<tr><td>".format_notice($this, 'WARNING: There are no providers in this list.').$stopHtml."</td></tr>";
}

echo "</table>";
?>
