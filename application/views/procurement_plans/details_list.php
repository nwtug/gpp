<table>
<?php $stopHtml = "<input name='paginationdiv__procurement_plan_stop' id='paginationdiv__procurement_plan_stop' type='hidden' value='1' />";
		
	if(!empty($list)){
		echo "<tr><th>Procuring/Disposal Entity</th><th>&nbsp;</th></tr>";
		
		$listCount = count($list);
		$i = 0;
        foreach($list AS $row){
			$i++;
			echo "<tr>
				<td>".$row['pde']."</td>
				<td><a href='".base_url().'procurement_plans/view_one/d/'.$row['procurement_plan_id']."' class='shadowbox blue-box closable'>Details for ".$row['name']." FY ".substr($row['financial_year_start'],0,4).'-'.substr($row['financial_year_end'],0,4);
				
			if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		        echo $stopHtml;
		    }
			
			echo "</td>
				</tr>";
		}
	}
	else {
		echo "<tr><td>".format_notice($this, 'WARNING: There are no procurement plans in this list.').$stopHtml."</td></tr>";
	}
?>
</table>