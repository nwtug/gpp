<?php 
if(!empty($list)){
$stopHtml = "<input name='paginationdiv__tender_stop' id='paginationdiv__tender_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

	echo "<table><tr><th>Procuring/Disposal Entity</th><th>Subject of Procurement</th><th>Procurement Type [Procurement Method]</th><th>Deadline</th></tr>";

	foreach($list AS $row){
		$i++;
		echo "<tr><td>".html_entity_decode($row['pde'], ENT_QUOTES)."</td><td><a href='".base_url()."tenders/view_one/d/".$row['tender_id']."' class='shadowbox closable'>".html_entity_decode($row['subject'], ENT_QUOTES)."</a><br>";
		
		if(!empty($row['bid_id'])){
			echo "<div class='orange-box btn shadowbox closable' data-url='".base_url()."bids/view_one/d/".$row['bid_id']."'>Submitted</div>";
		} else {
			echo "<div class='blue-box btn' data-rel='".base_url()."bids/add/t/".$row['tender_id']."'>Submit Bid</div>";
		}
		
		echo "</td>
  <td><span class='grey-box'>".strtoupper($row['procurement_type'])."</span> <span class='dark-grey'>[".ucwords(str_replace('_', ' ', $row['procurement_method']))."]</span></td><td>".date(SHORT_DATE_FORMAT, strtotime($row['deadline']));
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 	echo $stopHtml;
		}
		echo "</td></tr>";
	}
	echo "</table>";
}
else {
	echo format_notice($this, 'WARNING: There are no more tender notices to show.');
}
?>