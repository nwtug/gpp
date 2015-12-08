<?php 
$stopHtml = "<input name='paginationdiv__user_stop' id='paginationdiv__user_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>
<tr><th style='width:1%;'>&nbsp;</th><th>Name</th><th>Email</th><th>Telephone</th><th>Organization</th><th>Type</th><th>Status</th><th>Permissions</th><th>Joined</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td>".(!($this->native_session->get('__user_id') == $row['user_id'])? "<input id='select_".$row['user_id']."' name='selectall[]' type='checkbox' value='".$row['user_id']."' class='bigcheckbox'><label for='select_".$row['user_id']."'></label>": "&nbsp;")."</td>
		<td>".$row['name']."</td>
		<td>".$row['email_address']."</td>
		<td>".$row['telephone']."</td>
		<td><a href='".base_url()."users/details/id/".$row['user_id']."' class='shadowbox closable'>".$row['organization']."</a></td>
		<td>".strtoupper($row['user_type'])."</td>
		<td>";
		
		if($row['user_type'] == 'pde') echo "<a href='".base_url()."accounts/view_pde/d/".$row['organization_id']."' class='shadowbox closable'>".$row['organization']."</a>";
		else if($row['user_type'] == 'provider') echo "<a href='".base_url()."accounts/view_provider/d/".$row['organization_id']."' class='shadowbox closable'>".$row['organization']."</a>";
		else echo $row['organization'];
		
		echo "<td>".strtoupper($row['user_type'])."</td>
		<td>".strtoupper($row['status'])."</td>
		<td><a href='".base_url()."users/permissions/g/".$row['group_id']."' class='shadowbox closable'>".$row['permission_group']."</a></td>
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
