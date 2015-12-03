<?php 
$stopHtml = "<input name='paginationdiv__resources_stop' id='paginationdiv__resources_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table><tr>
  <th colspan='4'>Links</th>
  </tr>";

foreach($list AS $row) {
		$i++;
		echo "
<tr><td colspan='4'><a href='".$row['url'].apply_open_type($row['open_type'], 'closable')."'>".$row['name']."</a>";
		  
		   # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
     