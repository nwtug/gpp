<?php $stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table>

";

foreach($list AS $row) {
		$i++;
		echo "<tr><td><span class='bold'>".$list['name']."</span>
<br><span class='grey-box'>".$list['category']."</span></td>
<td class='dark-grey' style='width:1%;white-space:nowrap;'>Registered: ".date(SHORT_DATE_FORMAT, strtotime($list['date_registered']))."";
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
      
           
