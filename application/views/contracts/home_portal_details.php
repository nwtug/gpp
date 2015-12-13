<?php 
$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table>";

foreach($list AS $row) {
		$i++;
		echo "<tr>
<td><span class='bold'>".$row['tender_notice']."</span><br><span class='dark-grey'><span class='bold'>Contract Value:</span></span> ".$row['contract_amount'].$row['contract_currency']."
<br><span class='dark-grey'><span class='bold'>Date Signed:</span> ".$row['date_started']."</span></td>
<td class='dark-grey'><span class='bold'>Entity:</span>".$row['pde']."<br><span class='bold'>Provider:</span>".$row['provider']."<br><span class='bold'>Status: </span> <span class='orange-box'>".$row['status']."</span>";
		  
		   # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
