<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Dashboard';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php 
$this->load->view('addons/secure_header', array('__page'=>'Dashboard'));
$this->load->view('addons/pde_top_menu', array('__page'=>'my_dashboard'));
?>

<tr>
  <td>&nbsp;</td>
  <td style='text-align: left; padding-top:25px;'>
  <select id='year__financialyears' name='year__financialyears' class='drop-down'>
  <?php echo get_option_list($this, 'financialyears');?>
  </select></td>
  <td>&nbsp;</td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td class='fill-page' style="vertical-align:top;"><div class='three-columns' id='stat_container'>
<?php $this->load->view('reports/pde_stats',array('list'=>$list)); ?></div>
</td>
  <td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('accounts__pde_dashboard', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js'));?>
</body>
</html>