<?php 
$stopHtml = "<input name='paginationdiv__permission_stop' id='paginationdiv__permission_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";

if(!empty($list)){
	echo "<tr><th style='width:1%;'>&nbsp;</th><th>Name</th><th>Description</th><th>Permissions</th><th>Type</th><th>Users</th><th>Date Created</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td>".($row['is_removable'] == 'Y'? "<input id='select_".$row['group_id']."' name='selectall[]' type='checkbox' value='".$row['group_id']."' class='bigcheckbox'><label for='select_".$row['group_id']."'></label>":'&nbsp;')."</td>
		<td>".html_entity_decode($row['name'], ENT_QUOTES)."</td>
		<td>".html_entity_decode($row['notes'], ENT_QUOTES)."</td>
		<td>".(!empty($row['no_of_permissions'])? "<a href='".base_url()."permissions/group_permissions/d/".$row['group_id']."' class='shadowbox closable'>Permissions (".$row['no_of_permissions'].")</a>": 'No Permissions')."</td>
		<td>".strtoupper($row['type'])."</td>
		<td>".$row['no_of_users']."</td>
		<td>".date(FULL_DATE_FORMAT, strtotime($row['date_created']));
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
}

else {
	echo "<tr><td>".format_notice($this, 'WARNING: There are no permissions in this list.').$stopHtml."</td></tr>";
}

echo "</table>";
?>
