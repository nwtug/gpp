<?php 
$stopHtml = "<input name='paginationdiv__link_stop' id='paginationdiv__link_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";
if(!empty($list)){
echo "<tr><th>Name</th><th>Posted</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td><a href='".$row['url']."' ".apply_open_type($row['open_type'], 'closable').">".htmlentities($row['name'], ENT_QUOTES)."</a></td>
		<td>".date(SHORT_DATE_FORMAT, strtotime($row['date_entered']));
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
}
else {
	echo "<tr><td>".format_notice($this, 'WARNING: There are no links in this list.').$stopHtml."</td></tr>";
}

echo "</table>";
?>
