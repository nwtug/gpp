<?php 
$stopHtml = "<input name='paginationdiv__training_stop' id='paginationdiv__training_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";

if(!empty($list)){
	echo "<tr><th style='width:1%;'>&nbsp;</th><th>Subject</th><th>Category</th><th>Event Date,Time</th><th>Duration</th>";
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
		<td>".($this->native_session->get('__user_type') != 'provider'? "<input id='select_".$row['training_id']."' name='selectall[]' type='checkbox' value='".$row['training_id']."' class='bigcheckbox'><label for='select_".$row['training_id']."'></label>":'&nbsp;')."</td>
		<td><a href='".base_url()."training/description/d/".$row['training_id']."' class='shadowbox closable'>".htmlentities($row['subject'], ENT_QUOTES)."</a></td>
		<td>".ucwords(str_replace('_',' ',$row['category']))."</td>
		<td>".date(FULL_DATE_FORMAT, strtotime($row['event_time']))."</td>
		<td>".$row['duration']." hrs</td>";
		
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
	echo "<tr><td>".format_notice($this, 'WARNING: There are no training activities in this list.').$stopHtml."</td></tr>";
}

echo "</table>";
?>
