<?php 
$stopHtml = "<input name='paginationdiv__document_stop' id='paginationdiv__document_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";

if(!empty($list)){
	echo "<tr><th style='width:1%;'>&nbsp;</th><th>Name</th><th>Type</th><th>Size</th><th>Description</th>";
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
		<td>".($this->native_session->get('__user_type') != 'provider' && $row['is_removable'] == 'Y'? "<input id='select_".$row['document_id']."' name='selectall[]' type='checkbox' value='".$row['document_id']."' class='bigcheckbox'><label for='select_".$row['document_id']."'></label>":'&nbsp;')."</td>
		<td class='".document_class($row['url'])."-icon-row'><a href='".base_url()."pages/download/file/".$row['url']."'>".htmlentities($row['name'], ENT_QUOTES)."</a></td>
		<td>".ucwords(str_replace('_',' ',$row['category']))."</td>
		<td>".format_number($row['size'],3)."B</td>
		<td>".(!empty($row['description'])? "<a href='".base_url()."documents/description/d/".$row['document_id']."' class='shadowbox closable'>View Description</a>": 'NONE')."</td>";
		
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
}

else {
	echo "<tr><td>".format_notice($this, 'WARNING: There are no documents in this list.').$stopHtml."</td></tr>";
}

echo "</table>";
?>
