<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/jquery-ui.css'/>
<link rel='stylesheet' href='".base_url()."assets/css/external-fonts.css' type='text/css'>
<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />
<link rel='stylesheet' href='".base_url()."assets/css/pss.form.css' type='text/css' media='screen' />
<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />";


echo "<table class='default-table'>
<tr><td>
<table>
<tr><td class='label'>PDE</td><td>".$contract['pde']."</td></tr>
<tr><td class='label'>Tender</td><td>".$contract['tender_notice']."</td></tr>
<tr><td class='label'>Contract</td><td>".$contract['name']."</td></tr>
</table>
</td></tr>

<tr><td>&nbsp;</td></tr>

<tr><td>
<table class='list-table'>
<tr><th>Contract Status</th><th>Percentage</th><th>Documents</th><th>Note</th><th>Date Entered</th><th>Entered By</th><th>Entered By Organization</th></tr>";
	foreach($list AS $row) {
		echo "<tr> 
		<td>".strtoupper($row['status'])."</td>
		<td>".$row['percentage']."%</td>
		<td>";

	if(!empty($row['documents'])){
		$documents = explode(',',$row['documents']);
		foreach($documents AS $document) echo "<a href='".base_url()."pages/download/file/".$document."'>".$document."</a><br>"; 
	} else {
		echo "NONE";
	}

	echo "</td>
		<td>".html_entity_decode($row['notes'], ENT_QUOTES)."</td>
		<td>".date(FULL_DATE_FORMAT, strtotime($row['date_entered']))."</td>
		<td>".html_entity_decode($row['entered_by'], ENT_QUOTES)."</td>
		<td>".html_entity_decode($row['entered_by_organization'], ENT_QUOTES)."</td>
		</tr>";
	}
echo "</table>
</td></tr>
</table>";
?>
