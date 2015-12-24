<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />"; 

if(!empty($msg)){
	echo format_notice($this, $msg);
}
else
{
echo "<table class='list-table'><tr><th>Comment</th><th>Posted By</th><th>Posted On</th></tr>";

foreach($list AS $row){
echo "<tr>
<td>".$row['comment']."</td>
<td style='vertical-align:top;'>".$row['entered_by']."</td>
<td style='vertical-align:top;'>".date(FULL_DATE_FORMAT, strtotime($row['date_added']))."</td>
</tr>";
}
echo "</table>
</div>";
}
?>