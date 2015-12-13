<?php 
$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table>
";
     foreach($list AS $row) {
		$i++;
		echo "<tr>
<td colspan='2'><span class='bold'>".$row['pde']."</span><br>
  <a href=".base_url()."procurement_plans/view_one/d/".$row['procurement_plan_id']." class='shadowbox blue-box closable'>Details of ".substr($row['financial_year_start'],0,4).'-'.substr($row['financial_year_end'],0,4) .' '.$row['name']."</a>";
       # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";

?>