<table>
<?php 
	if(!empty($list)){
		echo "<tr><th>Date Posted</th><th>Procuring/Disposing Entity</th><th>Subject</th>";
		
		if(!$this->native_session->get('__view')) {	
			echo "<th>Selected Provider</th><th>Date BEB Expires</th><th>Status</th><th>BEB Price</th>";
		}
		
		echo "</tr>";
		$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";
		
		$listCount = count($list);
		$i = 0;
        foreach($list AS $row){
			$i++;
			echo "<tr>
				<td>".date(SHORT_DATE_FORMAT, strtotime($row['last_updated']))."</td>
				<td>".$row['pde']."</td>
				<td><a href='".base_url().'bids/view_one/d/'.$row['bid_id']."' class='shadowbox closable blue-box'>".$row['tender_notice']."</a>";
				
			if(!$this->native_session->get('__view')) {	
				echo "</td>
				<td>".$row['provider']."</td>
				<td>".date(SHORT_DATE_FORMAT, strtotime($row['valid_end_date']))."</td>
				<td>".$row['status']."</td>
				<td>".$row['bid_currency'].format_number($row['bid_amount'],3,0);
			}
			
			if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		        echo $stopHtml;
		    }
			
			echo "</td>
				</tr>";
		}
	}
	else {
		echo "<tr><td>".format_notice($this, 'WARNING: There are no best evaluated bidders in this list.')."</td></tr>";
	}
?>
</table>