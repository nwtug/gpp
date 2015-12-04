<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Forgot Password';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>

<?php $this->load->view('addons/public_header');

$this->load->view('addons/public_top_menu', array('__page'=>'forgot_password'));
?>

<tr>
  <td>&nbsp;</td>
  <td style='height:calc(85vh - 214px);'>

<div class='center-block body-table-border'>
<form method="post">
<table class='normal-table microform'>
<tr><td>
   
   <div id='forgotmsgdiv'></div></td></tr>
<tr><td class='body-title'>Enter Your Registered Email Address</td></tr>
<?php if(!empty($msg)) echo "<tr><td style='text-align:left;'>".format_notice($this,$msg)."</td></tr>";?>

<tr><td><input type='text' id='registeredemail' name='registeredemail' class='email' autocapitalize='off' placeholder="Email Address" value='' style='width:calc(100% - 20px);' /></td></tr>
<tr><td style="padding-bottom:0px;"><button type="button" id="sendpassword" name="sendpassword" class="btn grey submitmicrobtn" style="width:100%;">Send Recovery Link</button>
    <input type="hidden" name="action" id="action" value="<?php echo base_url();?>account/forgot">
    <input type="hidden" name="resultsdiv" id="resultsdiv" value="forgotmsgdiv">
    </td></tr>
</table>
</form>
</div>


</td>
  <td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/public_footer');?>


</table>
<?php echo minify_js('accounts__recover_password', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js'));?>
</body>
</html>