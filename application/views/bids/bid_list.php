<?php 
$stopHtml = "<input name='paginationdiv__bid_stop' id='paginationdiv__bid_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>
<tr><th style='width:1%;'>&nbsp;</th><th>Provider</th><th>Bid Details</th><th>PDE</th><th>Plan Name</th><th>Tender Notice</th><th>Bid Amount</th><th>Valid From</th><th>Valid To</th><th>Submitted</th><th>Status</th><th>Last Updated</th></tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td><input id='select_".$row['bid_id']."' name='selectall[]' type='checkbox' value='".$row['bid_id']."' class='bigcheckbox'><label for='select_".$row['bid_id']."'></label></td>
		<td><a href='javascript:;'>".$row['provider']."</a></td>
		<td>".$row['summary']."<br><a href='javascript:;'>Details</a></td>
		<td><a href='javascript:;'>".$row['pde']."</a></td>
		<td>".$row['procurement_plan']."</td>
		<td><a href='".base_url()."tenders/view_one/d/".$row['tender_id']."' class='shadowbox closable'>".$row['tender_notice']."</a></td>";
		
		if($type == 'awards') {
			echo "<td>".$row['final_amount_currency'].format_number($row['final_contract_amount'],3);
			if($row['contract_id'] > 0){
				echo "&nbsp;<div class='orange-box btn shadowbox closable' data-url='".base_url()."contracts/view_one/d/".$row['contract_id']."'>View Contract</div></td>";
			} else {
				echo "&nbsp;<div class='green-box btn' data-rel='".base_url()."contracts/add/t/".$row['bid_id']."'>Generate Contract</div></td>";
			}
			
		} else {
			echo "<td>".$row['bid_currency'].format_number($row['bid_amount'],3)."</td>
			<td>".date(SHORT_DATE_FORMAT, strtotime($row['valid_start_date']))."</td>
			<td>".date(SHORT_DATE_FORMAT, strtotime($row['valid_end_date']))."</td>
			<td>".date(FULL_DATE_FORMAT, strtotime($row['date_submitted']))."</td>
			<td>".strtoupper($row['status'])."</td>";
		}
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
echo "</table>";
?>
