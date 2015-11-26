<?php 
$stopHtml = "<input name='paginationdiv__procurement_plan_stop' id='paginationdiv__procurement_plan_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>
<tr><th style='width:1%;'>&nbsp;</th><th>PDE</th><th>Plan Name</th><th>Financial Year Start</th><th>Financial Year End</th><th>Status</th><th>Added</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td><input id='select_".$row['procurement_plan_id']."' name='selectall[]' type='checkbox' value='".$row['procurement_plan_id']."' class='bigcheckbox'><label for='select_".$row['procurement_plan_id']."'></label></td>
		<td><a href='".base_url()."accounts/view_pde/d/".$row['pde_id']."' class='shadowbox closable'>".$row['pde']."</a></td>
		<td>".$row['name']."</td>
		<td>FY ".date('Y', strtotime($row['financial_year_start']))."</td>
		<td>FY ".date('Y', strtotime($row['financial_year_end']))."</td>
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
