<?php 
$stopHtml = "<input name='paginationdiv__resources_stop' id='paginationdiv__resources_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table>

";
foreach($list AS $row) {
		$i++;
		echo "<tr><td class='".document_class($row['url'])."-icon-row'><span class='bold'><a href=".base_url().'pages/download/file/'.$row['url'].">".$row['name']."</a></span>
<br><span class='grey-box'>".$row['category']."</span></td>
<td class='dark-grey' style='width:1%;white-space:nowrap;'>Posted: ".date(SHORT_DATE_FORMAT, strtotime($row['date_entered']))." <br>Size:
 ".format_number($row['size'],3)."B"."";
     
	  # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
      