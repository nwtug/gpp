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
<tr><td colspan='2'>&nbsp;</td></tr>
<tr><td colspan='2'>
<div class='page-list-div'><div>

<table>
      <tr>
        <td ><span class="">Ministry of Finance and Economic Planning </span></td>
        <td colspan="3">&nbsp;</td></tr>
      <tr><td ><span class="">Ministry of Public Service & Human Resource Development</span></td><td colspan="3">&nbsp;</td></tr>
      <tr><td ><span class="">Ministry of Transport, Roads and Bridges</span></td><td colspan="3">&nbsp;</td></tr>
      <tr><td ><span class="">Ministry of Health; Ministry of Agriculture</span></td><td colspan="3">&nbsp;</td></tr>
      <tr><td ><span class="">Ministry of Animal resources & Fisheries Industry </span></td><td colspan="3">&nbsp;</td></tr>
      <tr><td ><span class="">Ministry of Education, Science and Technology</span></td><td colspan="3">&nbsp;</td></tr>
</table></div></div>
</td></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
</table>



</td>
  <td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/public_footer');?>

</table>
<?php echo minify_js('pages__government_agencies', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js'));?>
</body>
</html>