<?php 
$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table>

";
foreach($list AS $row) {
		$i++;
		echo "<tr>
  <td><span class='bold'>".$row['tender_notice']."</span>
<br>
<span class='dark-grey'><span class='bold'>Date BEB Expires:</span> ".date(SHORT_DATE_FORMAT, strtotime($row['valid_end_date']))."</span> 
<br><span class='dark-grey'><span class='bold'>Posted:</span> ".date(SHORT_DATE_FORMAT, strtotime($row['last_updated']))."</span></td>
<td class='dark-grey'><span class='bold'>Entity: </span>".$row['pde']."<br><span class='bold'>Provider:</span> ".$row['provider']."<br><span class='bold'>BEB Amount: </span>".$row['bid_amount'].$row['bid_currency']."<br><span class='bold'>Status:</span> <div class='green-box'>".$row['status']."</div>";
     
	  # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
      