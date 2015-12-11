<?php 
$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table><tr><th>Procuring/Disposal Entity</th><th>Subject of Procurement</th><th>Procurement Type [Procurement Method]</th><th>Deadline</th></tr>";
foreach($list AS $row) {
		$i++;
		echo "
      <tr><td >".$row['pde']."</td><td>".$row['subject']."<br><a href=".base_url().'tenders/view_one/d/'.$row['tender_id']." class='shadowbox closable blue-box'>View Details</a>
        </td>
        <td><span class='grey-box'>".$row['procurement_type']." </span> <span class='dark-grey'>[".ucwords(str_replace('_',' ',$row['procurement_method']))."]</span></td><td>".date(SHORT_DATE_FORMAT, strtotime($row['date_created']));
     
	  # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
      
      
      