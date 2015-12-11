<?php 
$stopHtml = "<input name='paginationdiv__faq_stop' id='paginationdiv__faq_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>
<tr><th style='width:1%;'>&nbsp;</th><th>Question</th><th>Answer</th>";
if($this->native_session->get('__user_type') == 'admin'){
	echo "<th>Status</th><th>Date Added</th>";
}
echo "</tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td>";
		if($this->native_session->get('__user_type') != 'provider'){
		echo "<input id='select_".$row['faq_id']."' name='selectall[]' type='checkbox' value='".$row['faq_id']."' class='bigcheckbox'><label for='select_".$row['faq_id']."'></label>";
		}
		else echo "&nbsp;";
		
		echo "</td>
		<td>".html_entity_decode($row['question'], ENT_QUOTES)."</td>
		<td>".html_entity_decode($row['answer'], ENT_QUOTES);
		if($this->native_session->get('__user_type') == 'admin'){
			echo "</td><td>".strtoupper($row['status'])."</td>
			<td>".date(FULL_DATE_FORMAT, strtotime($row['date_entered']));
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
