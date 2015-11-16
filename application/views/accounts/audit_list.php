<?php 
$stopHtml = "<input name='paginationdiv__audittrail_stop' id='paginationdiv__audittrail_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>
<tr><th>Date</th><th>User</th><th>Activity</th><th>Result</th><th>Details</th><th>URI</th><th>IP Address</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr><td>".date(FULL_DATE_FORMAT, strtotime($row['event_date']))."</td>
		<td>".$row['name']."</td>
		<td>".ucwords($row['activity_code'])."</td>
		<td>".strtoupper($row['result'])."</td>
		<td>".$row['details']."</td>
		<td>".$row['uri']."</td>
		<td>".$row['ip_address'];
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
echo "</table>";
?>
