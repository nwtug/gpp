<table>
		<?php 
		$stopHtml = "<input name='paginationdiv__provider_stop' id='paginationdiv__provider_stop' type='hidden' value='1' />";
		
		if(!empty($list)){
			echo "<tr>";
			if($area == 'suspended_providers'){
				echo "<th>Provider</th><th>Date Suspended</th><th>Suspension End Date</th><th>Reason for Suspension</th>";
				if(!$this->native_session->get('__view')) {
					echo "<th>Category</th><th>Registered</th><th>Address</th>";
				}
			} else {
				echo "<th>Provider</th><th>Category</th><th>Registered</th>";
				if(!$this->native_session->get('__view')) {
					echo "<th>Address</th><th>Founded</th>";
				}
			}
			
			echo "</tr>";
			
			$listCount = count($list);
			$i = 0;
            foreach($list AS $row){
				$i++;
                echo "<tr>
					<td>".$row['name'];
					
				# suspended providers
				if($area == 'suspended_providers'){
					echo "</td>
					<td>".date(SHORT_DATE_FORMAT, strtotime($row['status_start_date']))."</td>
					<td>".date(SHORT_DATE_FORMAT, strtotime($row['status_end_date']))."</td>
					<td>".html_entity_decode($row['status_reason'], ENT_QUOTES);
					
					if(!$this->native_session->get('__view')){
						echo "</td>
						<td>".$row['category']."</td>
						<td>".date(SHORT_DATE_FORMAT, strtotime($row['date_created']))."</td>
						<td>".$row['address'];
					}
				}
				# active providers (and not viewing on home page)
				else {
					echo "</td>
					<td>".$row['category']."</td>
					<td>".date(SHORT_DATE_FORMAT, strtotime($row['date_created']));
					
					if(!$this->native_session->get('__view')){
						echo "</td>
						<td>".$row['address']."</td>
						<td>".($row['date_registered'] != '0000-00-00'? date(SHORT_DATE_FORMAT, strtotime($row['date_registered'])): 'UNKNOWN');
					}
				}
				
				if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 			echo $stopHtml;
				}
				echo "</td>
				</tr>";
			}		
		}

		else {
			echo "<tr><td>".format_notice($this, 'WARNING: There are no providers in this list.').$stopHtml."</td></tr>";
		}?>
</table>