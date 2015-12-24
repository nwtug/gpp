<?php 
$stopHtml = "<input name='paginationdiv__training_stop' id='paginationdiv__training_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";

if(!empty($list)){
echo "<tr><th>Subject</th><th>Event Date,Time</th><th>Duration</th>";
if(!$this->native_session->get('__view')){
	echo "<th>Category</th><th>Posted</th><th>Posted By</th>";
}
echo "</tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td><a href='".base_url()."training/description/d/".$row['training_id']."' class='shadowbox closable'>".htmlentities($row['subject'], ENT_QUOTES)."</a></td>
		<td>".date(FULL_DATE_FORMAT, strtotime($row['event_time']))."</td>
		<td>".$row['duration']." hrs";
		
		if(!$this->native_session->get('__view')){
			echo "</td>
		<td>".ucwords(str_replace('_',' ',$row['category']))."</td>
		<td>".date(SHORT_DATE_FORMAT, strtotime($row['date_entered']))."</td>
		<td>".htmlentities($row['entered_by_organization'], ENT_QUOTES);
		}
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
}
else echo format_notice($this, "WARNING: There are no training activities in this list.");
	
echo "</table>";
?>
