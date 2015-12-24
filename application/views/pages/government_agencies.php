<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Government Agencies';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php $this->load->view('addons/public_header');

$this->load->view('addons/public_top_menu', array('__page'=>'government_agencies'));
?>


<tr>
  <td>&nbsp;</td>
  <td class='one-column' style='height:calc(85vh - 255px); padding-bottom: 20px;'>
<table class='home-list-table'>
<tr>
  <th class='h3 blue rop-icon'>Government Agencies</th><th class='btn closer' data-rel='pages/portal'></th></tr>
<tr><td colspan='2' style="padding:8px;">The list below shows the registered government agencies or Procurement and Disposal Entities (PDEs) that can publish Requests for Proposals (RFPs) on this website. This list changes as more PDEs are registered and approved.</td></tr>
<tr><td colspan='2'>
<div class='page-list-div'><div>
<?php 
if(!empty($list)){
	echo "<table>";
	foreach($list AS $row){
		echo "<tr><td class='list-item'><a href='".base_url()."accounts/view_pde/d/".$row['pde_id']."' class='shadowbox closable'>".$row['name']."</a></td></tr>";
	}
	echo "</table>";
}
else echo format_notice($this, "WARNING: There are currently no active PDEs.");
?>
</div></div>
</td></tr>
<tr style="border:0px;"><td colspan='2' class="light-grey-bg" style="border:0px;">&nbsp;</td></tr>
</table>



</td>
  <td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/public_footer');?>

</table>
<?php echo minify_js('pages__government_agencies', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js'));?>
</body>
</html>