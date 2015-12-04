<?php 
$stopHtml = "<input name='paginationdiv__provider_stop' id='paginationdiv__provider_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>
<tr><th style='width:1%;'>&nbsp;</th><th>Name</th><th>Contact</th><th>Tax ID</th><th>Category/Ministry</th><th style='white-space:nowrap;'>ROP #</th><th>Country</th><th>Address</th><th>Status</th><th>Registered</th><th>Joined</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td><input id='select_".$row['organization_id']."' name='selectall[]' type='checkbox' value='".$row['organization_id']."' class='bigcheckbox'><label for='select_".$row['organization_id']."'></label></td>
		<td>".$row['name']."</td>
		<td><a href='".base_url()."providers/details/id/".$row['organization_id']."' class='shadowbox closable'>".$row['contact_name']."</a></td>
		<td>".$row['tax_id']."</td>
		<td>".(!empty($row['category'])? $row['category']: $row['ministry'])."</td>
		<td>".(!empty($row['rop_number'])? "<a href='javascript:;'>".$row['rop_number']."</a>": "")."<div class='green-box btn'>Generate</div></td>
		<td>".$row['country']."</td>
		<td>".$row['address']."</td>
		<td>".strtoupper($row['status'])."</td>
		<td>".date(SHORT_DATE_FORMAT, strtotime($row['date_registered']))."</td>
		<td>".date(FULL_DATE_FORMAT, strtotime($row['date_created']));
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
echo "</table>";
?>
