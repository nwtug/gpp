<?php 
$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>
<tr><th style='width:1%;'>&nbsp;</th><th>PDE</th><th>Subject</th><th>Procurement Plan</th><th>Bids</th><th>Procurement Type</th><th>Procurement Method</th><th>Deadline</th><th>Display Start</th><th>Display End</th><th>Status</th><th>Added</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td><input id='select_".$row['tender_id']."' name='selectall[]' type='checkbox' value='".$row['tender_id']."' class='bigcheckbox'><label for='select_".$row['tender_id']."'></label></td>
		<td>".$row['name']."</td>
		<td><a href='javascript:;'>".$row['subject']."</a></td>
		<td><a href='javascript:;'>".$row['procurement_plan']."</a></td>
		<td><a href='javascript:;'>Bids</a></td>
		<td>".strtoupper($row['procurement_type'])."</td>
		<td>".$row['procurement_method']."</td>
		<td>".date(SHORT_DATE_FORMAT, strtotime($row['deadline']))."</td>
		<td>".date(SHORT_DATE_FORMAT, strtotime($row['display_start_date']))."</td>
		<td>".date(SHORT_DATE_FORMAT, strtotime($row['display_end_date']))."</td>
		<td>".strtoupper($row['status'])."</td>
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