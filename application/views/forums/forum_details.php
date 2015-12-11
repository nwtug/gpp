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
<tr><td colspan='2' class='h2 bold'>".html_entity_decode($forum['topic'], ENT_QUOTES)."</td></tr>
<tr><td colspan='2'>".html_entity_decode($forum['details'], ENT_QUOTES)."</td></tr>

".(!empty($forum['document_url'])? "<tr><td class='label'>Document</td><td><a href='".base_url()."pages/download/file/".$forum['document_url']."'>".$forum['document_url']."</a></td></tr>":'')."

<tr><td class='label'>Category</td><td>".ucwords(str_replace('_',' ',$forum['category']))."</td></tr>
<tr><td class='label'>Access</td><td>".($forum['is_public'] == 'Y'? 'Public': 'Private')."</td></tr>
<tr><td class='label'>Moderator</td><td>".html_entity_decode($forum['moderator'], ENT_QUOTES)."</td></tr>";

if( !empty($this->native_session->get('__user_type')) && ($this->native_session->get('__user_type')  != 'provider')){
echo "
<tr><td class='label'>Status</td><td>".strtoupper($forum['status'])."</td></tr>
<tr><td class='label'>Date Entered</td><td>".date(FULL_DATE_FORMAT, strtotime($forum['date_entered']))."</td></tr>
<tr><td class='label'>Entered By</td><td>".$forum['entered_by']."</td></tr>
<tr><td class='label long'>Entered By Organization</td><td>".htmlentities($forum['entered_by_organization'], ENT_QUOTES)."</td></tr>
<tr><td class='label'>Last Updated</td><td>".date(FULL_DATE_FORMAT, strtotime($forum['last_updated']))."</td></tr>
<tr><td class='label'>Last Updated By</td><td>".$forum['last_updated_by']."</td></tr>";
}

if(empty($this->native_session->get('__user_type')))
{
	
}
echo "</table>";
}
?>