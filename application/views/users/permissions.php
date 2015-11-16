<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />"; 

echo "<table class='list-table'><tr><th>Permission</th></tr>";
	foreach($list AS $row) {
		echo "<tr><td>".$row['permission']."</td></tr>";
	}
echo "</table>";
?>