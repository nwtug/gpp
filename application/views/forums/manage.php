<?php if(empty($msg)) $msg = get_session_msg($this);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Forums';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.pagination.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php 
$this->load->view('addons/secure_header', array('__page'=>'Forums' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'forums' ));
?>

<tr>
  <td>&nbsp;</td>
  <td class='one-column fill-page'>


<table class='home-list-table'> 

<tr><th class='h3 dark-grey' style='padding-left:10px;border-bottom:1px solid #999;'>Forum List</th>

<?php
if($this->native_session->get('__user_type') == 'provider'){
	echo "<th style='border-bottom:1px solid #999; width:1%;padding:0px;'>&nbsp;</th>
		<th style='border-bottom:1px solid #999; width:1%;padding:0px;'>&nbsp;</th>";
} else {
?>
<th style='border-bottom:1px solid #999; width:1%;padding:0px; padding-right:15px;'><button type='button' id='newitem' name='newitem' class='btn smallbtn green' data-rel='forums/add'>New</button></th>
<th style='border-bottom:1px solid #999; width:1%;padding:0px;'><div id='forum_actions' class='actions-list-btn list-actions' data-url='forums/list_actions' data-width='300' data-targetdiv='paginationdiv__forum_list'><div class='settings'>&nbsp;</div><div>&nbsp;</div></div></th>
<?php }?>

</tr>
<?php if($msg) echo "<tr><td colspan='3'>".format_notice($this,$msg)."</td></tr>";?>
 
<tr><td colspan='3'><div id='paginationdiv__link_list' class='page-list-div'>
<div id="forum__1"><?php $this->load->view('forums/forum_list',array('list'=>$list));?></div>
</div>
<button type='button' id='refreshlist' name='refreshlist' style='display:none;'></button></td></tr>
<tr><td colspan='3'>
<table><tr><td>
         
<div id='forum_pagination_div' class='pagination' style="margin:0px;padding:0px; display:inline-block;"><div id="forum" class="paginationdiv no-scroll"><div class="previousbtn" style='display:none;'>&#x25c4;</div><div class="selected">1</div><div class="nextbtn">&#x25ba;</div></div><input name="paginationdiv__forum_action" id="paginationdiv__forum_action" type="hidden" value="<?php echo base_url()."lists/load/t/forum";?>" />
<input name="paginationdiv__forum_maxpages" id="paginationdiv__forum_maxpages" type="hidden" value="<?php echo NUM_OF_LISTS_PER_VIEW;?>" />
<input name="paginationdiv__forum_noperlist" id="paginationdiv__forum_noperlist" type="hidden" value="<?php echo NUM_OF_ROWS_PER_PAGE;?>" />
<input name="paginationdiv__forum_showdiv" id="paginationdiv__forum_showdiv" type="hidden" value="paginationdiv__forum_list" />
<input name="paginationdiv__forum_extrafields" id="paginationdiv__forum_extrafields" type="hidden" value="" /></div>
          

</td><td width='1%' class='filter-list shadowbox closable' data-url='<?php echo base_url().'forums/list_filter';?>'>FILTER</td></tr></table>
</td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('forums__manage', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js'));?>

<?php if(!empty($action)){ ?>
<script>
$(function() { 
	$(document).find('.filter-list').last().click(); 
});
</script>
<?php }?>
</body>
</html>