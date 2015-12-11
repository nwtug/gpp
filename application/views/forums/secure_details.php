<?php 
$stopHtml = "<input name='paginationdiv__forums_stop' id='paginationdiv__forums_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table><tr><th>Question</th><th>Category</th><th>Contributors</th><th>Date</th></tr>

";

foreach($list AS $row) {
		$i++;
		echo "<tr><td >".$row['topic']."</td><td><span class='grey-box'>".$row['category']."</span></td><td>(".$row['no_of_contributors'].")</td><td>".date(SHORT_DATE_FORMAT, strtotime($row['last_updated']))."";
		  
		   # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
     