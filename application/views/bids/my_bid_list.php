<?php 
$stopHtml = "<input name='paginationdiv__mybid_stop' id='paginationdiv__mybid_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";

if(!empty($list)){
	echo "<tr><th style='width:1%;'>&nbsp;</th><th>Invitation for Bids/Quotations</th><th>Details</th><th>Validity Period</th><th>Bid</th><th>Status Trail</th></tr>";
	
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td>".($row['status'] != 'saved'? "&nbsp;": "<input id='select_".$row['bid_id']."' name='selectall[]' type='checkbox' value='".$row['bid_id']."' class='bigcheckbox'><label for='select_".$row['bid_id']."'></label>")."</td>
		<td><a href='".base_url()."tenders/view_one/d/".$row['tender_id']."' class='shadowbox closable'>".html_entity_decode($row['tender_notice'], ENT_QUOTES)."</a></td>
		
		
		<td><a href='".base_url()."bids/summary/d/".$row['bid_id']."' class='shadowbox closable'>Summary</a>";
		if(!empty($row['documents'])){
			$documents = explode(',',$row['documents']);
			foreach($documents AS $document) echo "<br><a href='".base_url()."pages/download/file/".$document."'>".$document."</a>"; 
		}
		
		echo "</td>
		<td>".date(SHORT_DATE_FORMAT, strtotime($row['valid_start_date']))." TO ".date(SHORT_DATE_FORMAT, strtotime($row['valid_end_date']))."</td>
		<td>".$row['bid_currency'].format_number($row['bid_amount'],3)."</td>
		<td>".$row['status_trail'];
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
}

else {
	echo "<tr><td>".format_notice($this, 'WARNING: There are no bids in this list.').$stopHtml."</td></tr>";
}
echo "</table>";
?>
