<?php 
$stopHtml = "<input name='paginationdiv__forum_stop' id='paginationdiv__forum_stop' type='hidden' value='1' />";
$listCount = count($list);
$i = 0;

echo "<table>";
if(!empty($list)){
echo "<tr><th>Topic</th>";
# are you allowed to see beyond this area?
if($area == 'public_forums' || ($area == 'secure_forums' && $this->native_session->get('__user_id'))){
	echo "<th>Contributors #</th>";

	if(!$this->native_session->get('__view')){
		echo "<th>Views #</th><th>Moderator</th><th>Date Started</th>";
	}
}
echo "</tr>";
	foreach($list AS $row) {
		$i++;
		echo "<tr> 
		<td><span class='grey-box'>".ucwords(str_replace('_',' ',$row['category']))."</span> <a href='".base_url()."forums/view_one/d/".$row['forum_id']."' class='shadowbox closable'>".htmlentities($row['topic'], ENT_QUOTES)."</a>";

		if($area == 'public_forums' || ($area == 'secure_forums' && $this->native_session->get('__user_id'))){		
			echo "</td>
			<td>".(!empty($row['no_of_contributors'])? "[".$row['no_of_contributors']."] <a href='".base_url()."forums/comments/d/".$row['forum_id']."' class='shadowbox closable'>Comments</a>": '0')
			."<br><div class='green-box btn shadowbox' data-url='".base_url()."forums/add_comment/d/".$row['forum_id']."'>Comment</div>";
			
			if(!$this->native_session->get('__view')){
				echo "</td>
				<td>".$row['no_of_views']."</td>
				<td>".$row['moderator']."</td>
				<td>".date(SHORT_DATE_FORMAT, strtotime($row['date_entered']));
			}
		}
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td>
		</tr>";
	}
}
else {
	echo "<tr><td>".format_notice($this, 'WARNING: There are no forums in this list.')."</td></tr>";
}

echo "</table>";
?>
