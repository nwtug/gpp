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
<tr><td class='bold'>".html_entity_decode($faq['question'], ENT_QUOTES)."</td></tr>
<tr><td>".html_entity_decode($faq['answer'], ENT_QUOTES)."</td></tr>
</table>";
}
?>