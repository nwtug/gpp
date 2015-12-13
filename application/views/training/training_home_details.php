<?php 
$stopHtml = "<input name='paginationdiv__resources_stop' id='paginationdiv__resources_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table>

";
foreach($list AS $row) {
		$i++;
		echo "<td ><span class='bold'><a href=".base_url().'training/description/d/'.$row['training_id']." class='shadowbox closable'>".$row['subject']."</a></span>
<br><span class='grey-box'>".ucwords(str_replace('_',' ',$row['category']))."</span></td>
<td class='dark-grey' style='width:1%;white-space:nowrap;'>Date: ".date(FULL_DATE_FORMAT, strtotime($row['event_time']))."<br>Duration: ".$row['duration']."hrs";
     
	  # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
      