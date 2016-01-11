<table>
<?php $stopHtml = "<input name='paginationdiv__contract_stop' id='paginationdiv__contract_stop' type='hidden' value='1' />";
		
	if(!empty($list)){
		echo "<tr><th>Date Signed</th><th>Procuring/Disposing Entity</th><th>Service Provider</th>";
		
		if(!$this->native_session->get('__view')) {	
			echo "<th>Subject of Procurement</th><th>Date of Commencement</th><th>Contract Value</th><th>Status</th>";
		}
		
		echo "</tr>";
		
		$listCount = count($list);
		$i = 0;
        foreach($list AS $row){
			$i++;
			echo "<tr>
				<td>".(!empty($row['date_signed'])? $row['date_signed']:'UNKNOWN')."</td>
				<td>".$row['pde']."</td>
				<td>".$row['provider'];
			
			if(!$this->native_session->get('__view')) {		
				echo "</td>
				<td>".$row['tender_notice']."</td>
				<td>".(!empty($row['date_commenced'])? $row['date_commenced']:'UNKNOWN')."</td>
				<td>".$row['contract_currency'].format_number($row['contract_amount'],3)."</td>
				<td><div class='orange-box'>".$row['status']."</div>";
			}
			
			if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		        echo $stopHtml;
		    }
			
			echo "</td>
				</tr>";
		}
	}
	else {
		echo "<tr><td>".format_notice($this, 'WARNING: There are no contract awards in this list.').$stopHtml."</td></tr>";
	}
?>
</table>