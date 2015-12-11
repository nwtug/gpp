<?php 
$stopHtml = "<input name='paginationdiv__resources_stop' id='paginationdiv__resources_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table><tr><th>Name</th><th>Type</th><th>Size</th><th>Posted</th></tr>";

foreach($list AS $row) {
		$i++;
		echo "<tr><td class='".document_class($row['url']).'-icon-row'."'><a href=".base_url().'pages/download/file/'.$list['url'].">".$row['name']."</a></td><td>".$row['category']."</td><td>".format_number($row['size'],3)."B"."</td><td>".date(SHORT_DATE_FORMAT, strtotime($row['date_entered']));
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
      