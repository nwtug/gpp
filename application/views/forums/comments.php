<?php 
$css = "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />"
		."<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />"; 

if(!empty($msg)){
	echo $css.format_notice($this, $msg);
}
else
{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html lang='en'>
<head><meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
	<title>Comments</title>
    ".$css."
</head>
<body>
<div id='delete_result'></div>
<table class='list-table'><tr><th style='width:1%'>&nbsp;</th><th>Comment</th><th>Posted By</th><th>Posted On</th></tr>";

foreach($list AS $row){
echo "<tr id='row_".$row['comment_id']."'>
<td>";
if($this->native_session->get('__user_type') == 'admin' || ($this->native_session->get('__user_type') == 'pde' && $this->native_session->get('__organization_id') == $row['entered_by_organization'])){
	echo "<a href='javascript:;' onclick=\"confirmActionToLayer('".base_url()."forums/remove_comment/row_id/row_".$row['comment_id']."', 'comments_".$row['comment_id']."', '', 'row_".$row['comment_id']."___delete_result', 'Are you sure you want to remove this comment?')\"><img src='".IMAGE_URL."remove_icon.png' border='0'></a>
	
	<input type='hidden' id='comments_".$row['comment_id']."' name='comments[]' value='".$row['comment_id']."' />";
} else echo "&nbsp;";
echo "</td>
<td>".$row['comment']."</td>
<td style='vertical-align:top;'>".$row['entered_by']."</td>
<td style='vertical-align:top;'>".date(FULL_DATE_FORMAT, strtotime($row['date_added']))."</td>
</tr>";
}
echo "</table>
</div>

<input type='hidden' id='layerid' name='layerid' value='' />";

echo minify_js('forums__comments', array('jquery-2.1.1.min.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js'));

echo "</body>
</html>";
}
?>