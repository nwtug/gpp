<?php 
$stopHtml = "<input name='paginationdiv__forums_stop' id='paginationdiv__forums_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table>

";
foreach($list AS $row) {
		$i++;
		echo "<tr><td><span class='bold'><a href='".base_url()."forums/view_one/d/'".$list['forum_id']."' class='shadowbox closable'>".$row['topic']."</a></span>
<br><span class='grey-box'>".$row['category']."</span></td>
<td class='dark-grey' style='width:1%;white-space:nowrap;'>Started: ".date(SHORT_DATE_FORMAT, strtotime($row['last_updated']))."<br>Contributors: ".$row['no_of_contributors']."</td></tr>

";
     
	  # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		}
echo "</table>";
?>