<?php 
$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table>

";
foreach($list AS $row) {
		$i++;
		echo "<tr>
  <td><span class='bold'>".$row['subject']."</span>
<br><span class='grey-box'>".$row['procurement_type']." </span> <span class='dark-grey'>[".ucwords(str_replace('_',' ',$row['procurement_method']))."]</span>
<br><span class='dark-grey'><span class='bold'>Posted:</span> ".date(SHORT_DATE_FORMAT, strtotime($row['date_created']))."</span></td>
<td class='dark-grey'><span class='bold'>Entity:</span> ".$row['pde']."";
     
	  # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
      