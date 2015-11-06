<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Contact Us';?></title>
    
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php $this->load->view('addons/public_header');

$this->load->view('addons/top_menu', array('__page'=>'contact_us'));
?>

<tr>
  <td>&nbsp;</td>
  <td style='height:calc(85vh - 214px);'>
<div class='body-title'>Contact Us</div>

<div class='center-block'>
<form method="post">
<div style="display:inline-block;">
<table border="0" class='normal-table' cellspacing="0" cellpadding="10">
<?php
if(!empty($result) && $result){
	echo "<tr><td style='padding-bottom:100px;'>".format_notice($this, $msg)."</td></tr>";
} else {
	echo !empty($msg)? "<tr><td colspan='2'>".format_notice($this, $msg)."</td></tr>": "";
?>
  
  <tr>
    <td class="label">Your Name: </td>
    <td><input type="text" id="yourname" name="yourname" class="textfield" value="" maxlength="100"/></td>
  </tr>
  <tr>
    <td class="label">Email Address: </td>
    <td><input type="text" id="emailaddress" name="emailaddress" class="textfield email" value="" maxlength="100"/></td>
  </tr>
  <tr>
    <td class="label">Telephone: </td>
    <td><input type="text" id="telephone" name="telephone" placeholder="Optional (e.g: 0782123456)" class="textfield numbersonly telephone optional" value="" maxlength="10"/></td>
  </tr>
  <tr>
    <td class="label">Reason: </td>
    <td><input type="text" id="reason__contactreason" name="reason__contactreason" placeholder="Enter or Select reason" class="textfield selectfield editable" value=""/></td>
  </tr>
  <tr>
    <td class="label" valign="top">Message: </td>
    <td><textarea id="details" name="details" placeholder="Enter your message here" class="textarea" style="height:120px;"></textarea></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:right;"><input type="button" id="submitlogin" name="submitlogin" class="btn grey" style="width:100%;" value="SEND" /></td>
  </tr>
<?php }?>
      </table>
      </div>
      <div style="display:inline-block; vertical-align:top; text-align:left; padding-left:20px; padding-top:10px;">
<span class="">ADDRESS:
<br>Ministry of Finance and Economic Planning</span>
<br>P.O. Box 80
<br>Juba
<br>Republic of South Sudan
</div>
</form>
</div>


</td>
  <td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/public_footer');?>

</table>





<?php echo minify_js('home', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js'));?>
</body>
</html>