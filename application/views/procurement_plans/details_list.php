<table>
<?php 
	if(!empty($list)){
		echo "<tr><th>Procuring/Disposal Entity</th><th>&nbsp;</th></tr>";
		$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";
		
		$listCount = count($list);
		$i = 0;
        foreach($list AS $row){
			$i++;
			echo "<tr>
				<td>".$row['pde']."</td>
				<td><a href='".base_url().'procurement_plans/view_one/d/'.$row['procurement_plan_id']."' class='shadowbox blue-box closable'>Details for ".substr($row['financial_year_start'],0,4).'-'.substr($row['financial_year_end'],0,4) .' ('.$row['name'].")";
				
			if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		        echo $stopHtml;
		    }
			
			echo "</td>
				</tr>";
		}
	}
	else {
		echo "<tr><td>".format_notice($this, 'WARNING: There are no procurement plans in this list.')."</td></tr>";
	}
?>
</table>