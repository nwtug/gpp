<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Reports';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.pagination.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php 
$this->load->view('addons/secure_header', array('__page'=>'Reports' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'reports' ));
?>

<tr>
  <td>&nbsp;</td>
  <td style='text-align: left; padding-top:20px;'>
  
  <table class='default-table' style="width:100%;">
  <tr>
  <td style='padding-right:5px;width:1%;'>
  <select id='report__reporttypes' name='report__reporttypes' class='drop-down'>
  <?php echo get_option_list($this, 'reporttypes');?>
  </select></td>
  <td style='padding-right:5px;width:1%;'>
  <select id='report__financialquarters' name='report__financialquarters' class='drop-down'>
  <?php echo get_option_list($this, 'financialquarters');?>
  </select></td>
<?php if($this->native_session->get('__user_type') == 'admin'){?>
  <td style='padding-right:5px;'>
  <input type="text" id="search__pdes" name="search__pdes" placeholder="Search PDE Name" data-final='pde' class="drop-down searchable clear-on-empty" data-clearfield='pde_id' value="" style="width:calc(100% - 30px);"/>
<input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='' /></td>
  <td style='width:1%;'>
<?php } else {
	
	echo "<td style='width:98%;'>
	<input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='".$this->native_session->get('__organization_id')."' />";
	}
?>

  <button type="button" id="generate" name="generate" class="smallbtn blue" style="padding-top:6px;padding-bottom:6px;">Generate</button> 
<input name="layerid" id="layerid" type="hidden" value="paginationdiv__report_list" />
  </td>
</tr>
</table>
</td>
  <td>&nbsp;</td>
</tr>


<tr>
  <td>&nbsp;</td>
  <td class='one-column fill-page'>

<table class='home-list-table'> 
<tr><th class='h3 dark-grey' style='padding-left:10px;border-bottom:1px solid #999;'>Report</th>
<th style='border-bottom:1px solid #999; width:1%;padding:0px;'><div id='report_actions' class='actions-list-btn list-actions' data-url='reports/list_actions' data-width='300'><div class='settings'>&nbsp;</div><div>&nbsp;</div></div></th>
</tr>

<tr><td colspan='2'><div id='paginationdiv__report_list' class='page-list-div' style='overflow-x:auto;padding:10px;'>
<div id="report__1"><?php $this->load->view('reports/report_list',array('list'=>$list));?></div>
</div>
<button type='button' id='refreshlist' name='refreshlist' style='display:none;'></button></td></tr>
</td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('reports__manage', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js'));?>

<script>
$(function(){
	$('#paginationdiv__report_list').width($(window).width() - 103);
});
</script>
</body>
</html>