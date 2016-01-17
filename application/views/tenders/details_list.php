<table>
<?php $stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";
		
	if(!empty($list)){
		echo "<tr><th>Deadline</th><th>Procuring/Disposing Entity </th><th>Subject of Procurement</th>";
		
		if(!$this->native_session->get('__view')) {
			echo "<th>Procurement Reference Number</th><th>Procurement Type (Procurement Method)</th>";
		}
		
		echo "</tr>";
		
		$listCount = count($list);
		$i = 0;
        foreach($list AS $row){
			$i++;
			echo "<tr>
				<td>".date(SHORT_DATE_FORMAT, strtotime($row['deadline']))."</td>
				<td>".$row['pde']."</td>
				<td><a href='".base_url().'tenders/view_one/d/'.$row['tender_id']."' class='shadowbox closable blue-box'>".$row['subject']."</a>";
			
			if(!$this->native_session->get('__view')) {	
				echo "</td>
				<td>".$row['reference_number']."</td>
				<td>".ucwords($row['procurement_type'])." (".ucwords(str_replace('_',' ',$row['procurement_method'])).")";
			}
			
			if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		        echo $stopHtml;
		    }
			
			echo "</td>
				</tr>";
		}
	}
	else {
		echo "<tr><td>".format_notice($this, 'WARNING: There are no active tender notices in this list.').$stopHtml."</td></tr>";
	}

?>
</table>