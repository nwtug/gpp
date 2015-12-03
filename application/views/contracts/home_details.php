<?php 
$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table><tr><th>Procuring/Disposing Entity</th><th>Subject Of Procurement</th><th>Service Provider</th><th>Date Signed</th><th>Date of Commencement <br>
          [Date of Completion]</th><th>Contract Value</th><th>Status</th></tr>
		  ";

foreach($list AS $row) {
		$i++;
		echo "
      <tr><td>".$row['pde']."</td><td>".$row['tender_notice']."
          </td><td>".$row['provider']."</td><td>".$row['date_started']."</td><td>todo <br>
          [todo]</td><td>".$row['contract_amount'].' '.$row['contract_currency']."</td><td><div class='orange-box'>".$row['status']."</div>";
		  
		   # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
     