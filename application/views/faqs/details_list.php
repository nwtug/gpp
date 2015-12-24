<?php 
$stopHtml = "<input name='paginationdiv__faq_stop' id='paginationdiv__faq_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";
if(!empty($list)){
echo "<tr><th>Question</th><th>Answer</th></tr>";
	foreach($list AS $row) {
		$i++;
		
		if(strlen($row['answer']) > 150){
			$answer = html_entity_decode(limit_string_length($row['answer'], 150, FALSE), ENT_QUOTES)."<a href='".base_url()."faqs/details/d/".$row['faq_id']."' class = 'shadowbox closable grey-box'>Details</a>";
		}
		else $answer = html_entity_decode($row['answer'], ENT_QUOTES);
		
		echo "<tr> 
		<td style='vertical-align:top;'>".html_entity_decode($row['question'], ENT_QUOTES)."</td>
		<td>".$answer;
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
}
else {
	echo "<tr><td>".format_notice($this, 'WARNING: There are no frequently asked questions in this list.').$stopHtml."</td></tr>";
}
echo "</table>";
?>
