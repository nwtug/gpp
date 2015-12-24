<table>
<?php 
	if(!empty($list)){
		echo "<table><tr><th>Name</th><th>Type</th><th>Size</th><th>Posted</th></tr>";
		
		$stopHtml = "<input name='paginationdiv__document_stop' id='paginationdiv__document_stop' type='hidden' value='1' />";
		$listCount = count($list);
		$i = 0;
        foreach($list AS $row){
			$i++;
			echo "<tr>
				<td class='".document_class($row['url'])."-icon-row'><a href='".base_url()."pages/download/file/".$row['url']."'>".htmlentities($row['name'], ENT_QUOTES)."</a></td>
				<td>".ucwords(str_replace('_',' ',$row['category']))."</td>
				<td>".format_number($row['size'],3)."B</td>
				<td>".date(SHORT_DATE_FORMAT, strtotime($row['date_entered']));
				
			if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		        echo $stopHtml;
		    }
			
			echo "</td>
				</tr>";
		}
	}
	else {
		echo "<tr><td>".format_notice($this, 'WARNING: There are no '.($listtype == 'standard'? 'standards': 'documents').' in this list.')."</td></tr>";
	}

?>
</table>
      