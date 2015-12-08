<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.form.css' type='text/css' media='screen' />"; 

if(!empty($msg)){
	echo format_notice($this, $msg);
}
else
{
echo "<div class='home-list-div' style='min-height:250px;'><table>";

foreach($list AS $row){
echo "<tr><td>".$row['comment']."
<br><span class='h6'><i>".$row['entered_by']."</i> on ".date(SHORT_DATE_FORMAT, strtotime($row['date_added']))."</span>
</td>
";
}
echo "</table></div>";
}
?>