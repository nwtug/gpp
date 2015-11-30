<?php 
$stopHtml = "<input name='paginationdiv__link_stop' id='paginationdiv__link_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>
<tr><th style='width:1%;'>&nbsp;</th><th>Name</th><th>Open Type</th>";
if($this->native_session->get('__user_type') != 'provider'){
	echo "<th>Entered By</th><th>From Organization</th>";
}
if($this->native_session->get('__user_type') == 'admin'){
	echo "<th>Status</th>";
}
echo "<th>Posted</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td>".($this->native_session->get('__user_type') != 'provider'? "<input id='select_".$row['link_id']."' name='selectall[]' type='checkbox' value='".$row['link_id']."' class='bigcheckbox'><label for='select_".$row['link_id']."'></label>":'&nbsp;')."</td>
		<td><a href='".$row['url']."' ".apply_open_type($row['open_type'], 'closable').">".htmlentities($row['name'], ENT_QUOTES)."</a></td>
		<td>".ucwords(str_replace('_',' ',$row['open_type']))."</td>";
		
		if($this->native_session->get('__user_type') != 'provider'){
			echo "<td>".htmlentities($row['entered_by'], ENT_QUOTES)."</td>
				<td>".htmlentities($row['entered_by_organization'], ENT_QUOTES)."</td>";
		}
		
		if($this->native_session->get('__user_type') == 'admin'){
			echo "<td>".strtoupper($row['status'])."</td>";
		}
		
		echo "<td>".date(SHORT_DATE_FORMAT, strtotime($row['date_entered']));
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
echo "</table>";
?>
