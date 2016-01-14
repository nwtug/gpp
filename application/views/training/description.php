<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.form.css' type='text/css' media='screen' />"; 


if(!empty($msg)){
	echo format_notice($this, $msg);
}
else
{
echo "<table>
<tr><td class='label'>Description</td><td>".html_entity_decode($details['description'], ENT_QUOTES)."</td></tr>
<tr><td class='label'>Venue</td><td>".html_entity_decode($details['venue'], ENT_QUOTES)."</td></tr>";

if(!empty($details['url'])) {
	echo "<tr><td class='label'>Related Link</td><td><a href='".$details['url']."' target='_blank'>".$details['url']."</a></td></tr>";
}

if(!empty($details['documents'])) {
	echo "<tr><td class='label' nowrap>Related Documents</td><td>";
	$documents = explode(',',$details['documents']);
	foreach($documents AS $document) {
		echo "<a href='".base_url()."pages/download/file/".$document."'>".$document."</a><br>"; 
	}
	echo "</td></tr>";
}

echo "</table>";
}
?>