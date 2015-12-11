<?php 
$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table><tr><th>Date Posted</th><th>Procuring/Disposing Entity</th><th>Selected Provider</th><th>Subject</th><th>Date BEB Expires</th><th>Status</th><th>BEB Price</th></tr>";

foreach($list AS $row) {
		$i++;
		echo "
      <tr><td >".date(SHORT_DATE_FORMAT, strtotime($row['last_updated']))."</td><td>".$row['pde']."</td><td>".$row['provider']."</td><td>".$row['tender_notice']."<br><a href=".base_url().'bids/view_one/d/'.$row['bid_id']." class='shadowbox blue-box closable'>View Details</a>
        </td><td>".date(SHORT_DATE_FORMAT, strtotime($row['valid_end_date']))."</td><td><div class='green-box'>".$row['status']."</div></td><td>".$row['bid_amount'].$row['bid_currency'];
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
      
      
      
       