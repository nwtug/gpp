<?php
$jquery = "<script src='".base_url()."assets/js/jquery.min.js' type='text/javascript'></script>";
$javascript = "<script type='text/javascript' src='".base_url()."assets/js/pss.js'></script>".get_ajax_constructor(TRUE);
$tableHTML = "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
if(!empty($area) && $area == "dropdown_list")
{
	$tableHTML .= !empty($list)? $list: "";
}

else if(!empty($area) && $area == "basic_msg")
{
	$tableHTML .= format_notice($this, $msg);
}

<<<<<<< HEAD
else if(!empty($area) && $area == "refresh_list_msg")
{
	$tableHTML .= format_notice($this, $msg)."<br><br>
	<button type='button' id='refreshlistfromiframe' name='refreshlistfromiframe' class='btn blue' style='width:100%;' onclick='parent.location.reload();'>Refresh List</button>";
}
=======
else if(!empty($area) && $area == "basic_msg" && !empty($msg)) 
{
	$tableHTML .= format_notice($this, $msg);
}


>>>>>>> origin/master


echo $tableHTML;
?>