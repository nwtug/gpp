<?php 
$stopHtml = "<input name='paginationdiv__forums_stop' id='paginationdiv__forums_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table>

";
foreach($list AS $row) {
		$i++;
		echo "<tr><td colspan='2'><span class='bold'>".$row['question']."</span>
  <br><span class='body-content'>".$row['answer']."</span>";
     
	  # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>