<?php if(empty($msg)) $msg = get_session_msg($this);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Help';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.pagination.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php 
$this->load->view('addons/secure_header', array('__page'=>'Help' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'help' ));
?>

<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<?php $this->load->view('addons/help_ribbon', array('page'=>'faqs' )); ?>


<tr>
  <td>&nbsp;</td>
  <td class='one-column fill-page'>

<table class='home-list-table'> 
<tr><th class='h3 dark-grey' style='padding-left:10px;border-bottom:1px solid #999;'>FAQ List</th>

<?php
if($this->native_session->get('__user_type') == 'provider'){
	echo "<th style='border-bottom:1px solid #999; width:1%;padding:0px;'>&nbsp;</th>
		<th style='border-bottom:1px solid #999; width:1%;padding:0px;'>&nbsp;</th>";
} else {
?>
<th style='border-bottom:1px solid #999; width:1%;padding:0px; padding-right:15px;'><button type='button' id='newitem' name='newitem' class='btn smallbtn green' data-rel='faqs/add'>New</button></th>
<th style='border-bottom:1px solid #999; width:1%;padding:0px;'><div id='faq_actions' class='actions-list-btn list-actions' data-url='faqs/list_actions' data-width='300' data-targetdiv='paginationdiv__faq_list'><div class='settings'>&nbsp;</div><div>&nbsp;</div></div></th>
<?php }?>
</tr>

<?php if(!empty($msg)) echo "<tr><td colspan='3'>".format_notice($this, $msg)."</td></tr>";?>

<tr><td colspan='3'><div id='paginationdiv__faq_list' class='page-list-div'>
<div id="faq__1"><?php $this->load->view('faqs/faq_list',array('list'=>$list));?></div>
</div>
<button type='button' id='refreshlist' name='refreshlist' style='display:none;'></button></td></tr>
<tr><td colspan='3'>
<table><tr><td>
         
<div id='faq_pagination_div' class='pagination' style="margin:0px;padding:0px; display:inline-block;"><div id="faq" class="paginationdiv no-scroll"><div class="previousbtn" style='display:none;'>&#x25c4;</div><div class="selected">1</div><div class="nextbtn">&#x25ba;</div></div><input name="paginationdiv__faq_action" id="paginationdiv__faq_action" type="hidden" value="<?php echo base_url()."lists/load/t/faq";?>" />
<input name="paginationdiv__faq_maxpages" id="paginationdiv__faq_maxpages" type="hidden" value="<?php echo NUM_OF_LISTS_PER_VIEW;?>" />
<input name="paginationdiv__faq_noperlist" id="paginationdiv__faq_noperlist" type="hidden" value="<?php echo NUM_OF_ROWS_PER_PAGE;?>" />
<input name="paginationdiv__faq_showdiv" id="paginationdiv__faq_showdiv" type="hidden" value="paginationdiv__faq_list" />
<input name="paginationdiv__faq_extrafields" id="paginationdiv__faq_extrafields" type="hidden" value="" /></div>
          

</td><td width='1%' class='filter-list shadowbox closable' data-url='<?php echo base_url().'faqs/list_filter';?>'>FILTER</td></tr></table>
</td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('faqs__manage', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js'));?>

<?php if(!empty($action)){ ?>
<script>
$(function() { 
	$(document).find('.filter-list').last().click(); 
});
</script>
<?php }?>
</body>
</html>