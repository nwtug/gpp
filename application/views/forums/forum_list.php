<?php 
$stopHtml = "<input name='paginationdiv__forum_stop' id='paginationdiv__forum_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";

if(!empty($list)){
	echo "<tr><th style='width:1%;'>&nbsp;</th><th>Topic</th><th>Category</th><th>Is Public</th><th>Views #</th><th>Contributors #</th><th>Moderator</th>";
	if($this->native_session->get('__user_type') != 'provider'){
		echo "<th>Entered By</th><th>From Organization</th>";
	}
	if($this->native_session->get('__user_type') == 'admin'){
		echo "<th>Status</th>";
	}
	echo "<th>Date Started</th></tr>";
	
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td>".($this->native_session->get('__user_type') != 'provider'? "<input id='select_".$row['forum_id']."' name='selectall[]' type='checkbox' value='".$row['forum_id']."' class='bigcheckbox'><label for='select_".$row['forum_id']."'></label>":'&nbsp;')."</td>
		
		<td><a href='".base_url()."forums/view_one/d/".$row['forum_id']."' class='shadowbox closable'>".htmlentities($row['topic'], ENT_QUOTES)."</a></td>
		<td>".ucwords(str_replace('_',' ',$row['category']))."</td>
		<td>".$row['is_public']."</td>
		<td>".$row['no_of_views']."</td>
		<td>".(!empty($row['no_of_contributors'])? "[".$row['no_of_contributors']."] <a href='".base_url()."forums/comments/d/".$row['forum_id']."' class='shadowbox closable'>Comments</a>": '0')
			."<br><div class='green-box btn shadowbox' data-url='".base_url()."forums/add_comment/d/".$row['forum_id']."'>Comment</div></td>
		<td>".$row['moderator']."</td>";
		
		if($this->native_session->get('__user_type') != 'provider'){
			echo "<td>".htmlentities($row['entered_by'], ENT_QUOTES)."</td>
				<td>".htmlentities($row['entered_by_organization'], ENT_QUOTES)."</td>";
		}
		
		if($this->native_session->get('__user_type') == 'admin'){
			echo "<td>".strtoupper($row['status'])."</td>";
		}
		
		echo "<td>".date(SHORT_DATE_FORMAT, strtotime($row['date_entered']));
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
}

else {
	echo "<tr><td>".format_notice($this, 'WARNING: There are no forums in this list.').$stopHtml."</td></tr>";
}

echo "</table>";
?>
