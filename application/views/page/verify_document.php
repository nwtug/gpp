<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Verify Document';?></title>
    
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php $this->load->view('addons/public_header');

$this->load->view('addons/top_menu', array('__page'=>'verify_document'));
?>

<tr>
  <td>&nbsp;</td>
  <td style='height:calc(85vh - 214px);'>
<div class='body-title'>Verify Document</div>

<div class='center-block'>
<form method="post">
<table class='normal-table'>

<?php if(!empty($msg)) echo "<tr><td style='text-align:left;'>".format_notice($this,$msg)."</td></tr>";?>
<tr><td>
<div class="nextdiv label" style="width:120px; height:30px;">Document Type: </div>
<div class="nextdiv"><input type="text" id="documenttype__documenttypes" name="documenttype__documenttypes" placeholder="Select Document Type" class="textfield selectfield" value="" style='width:calc(100% - 20px);' /><input type='hidden' id='documenttype' name='documenttype' value='' /></div></td></tr>
<tr><td>
 <div class="nextdiv label" style="width:120px; height:30px;">Tracking Number: </div>
 <div class="nextdiv">
<input type="text" id="trackingnumber" name="trackingnumber" placeholder="Enter Number" class="textfield numbersonly"  style='width:calc(100% - 20px);' /></div></td></tr>
<tr><td style="padding-bottom:0px;"><button type="button" id="submitlogin" name="submitlogin" class="btn grey" style="width:100%;">VALIDATE TRACKING NUMBER</button><input type='hidden' id='verifydocument__type' name='verifydocument__type' value='verify_document' />
    <input type='hidden' id='verifydocument__ignorepostprocessing' name='verifydocument__ignorepostprocessing' value='verify_document' /></td></tr>

</table>
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