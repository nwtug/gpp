<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Register';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php $this->load->view('addons/public_header');

$this->load->view('addons/public_top_menu', array('__page'=>'register'));
?>

<tr>
  <td>&nbsp;</td><td class='body-title' style='padding:15px;'>Register</td><td>&nbsp;</td>
</tr>
<?php $this->load->view('addons/step_ribbon', array('step'=>'3')); ?>

<tr>
  <td>&nbsp;</td><td style='height:calc(85vh - 214px); vertical-align: top;'>
  
  <table class='normal-table'><tr>
  	<td>
    <table class='microform ignoreclear' style='width:100%;max-width:1000px;'>
    <tr><td class='dark-grey'>To help us serve you better, fill out this form as completely as possible.</td></tr>
    <?php if(!empty($msg)) echo "<tr><td style='text-align:left;'>".format_notice($this,$msg)."</td></tr>";?>
    <tr><td class='bold'>a) Confirm Your Email:</td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='confirmationcode' name='confirmationcode' placeholder='Confirmation code sent to your email' value='' /></div>
    <div></div>
    </td></tr>
    
    
    <tr><td class='bold'>b) Your Contact Address:</td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='firstname' name='firstname' placeholder='First Name' value='<?php echo $this->native_session->get('firstname');?>' /></div>
    <div><input type='text' id='lastname' name='lastname' placeholder='Last Name' value='<?php echo $this->native_session->get('lastname');?>' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='address' name='address' placeholder='Address' value='<?php echo $this->native_session->get('address');?>' /></div>
    <div><input type='text' id='city' name='city' placeholder='City' value='<?php echo $this->native_session->get('city');?>' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='region' name='region' placeholder='Region/State' value='<?php echo $this->native_session->get('region');?>' /></div>
    <div><input type='text' id='zipcode' name='zipcode' placeholder='Zip Code' class='numbersonly' value='<?php echo $this->native_session->get('zipcode');?>' /></div>
    </td></tr>
    
    <tr><td class='two-fields'>
    <div style='margin-left:0px;'><select id='contact__countries' name='contact__countries' class='drop-down'>
    <?php echo get_option_list($this, 'countries', 'select','', array(
		'selected'=>($this->native_session->get('contact__countries')? $this->native_session->get('contact__countries'): ($this->native_session->get('registration__countries')? $this->native_session->get('registration__countries'): ''))
	));?>
    </select></div>
    </td></tr>
    
    <tr><td>&nbsp;</td></tr>
    
    <tr><td><div class='left-div'><button type="button" id="back" name="back" class="btn grey" data-rel='accounts/register/step/2' style="width:100%;max-width:300px;">Back</button></div>
    <div class='right-div' style='padding-right:40px;'><button type="button" id="next" name="next" class="btn green submitmicrobtn" style="width:100%;max-width:300px;">Next</button></div>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'accounts/register';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'accounts/login';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' />
    </td></tr>
    
    <tr><td>&nbsp;</td></tr>
    
    </table>
    
    
    
    
    
    </td>
    <td style='vertical-align:top; width:20%;'><span class='bold'>NOTE:</span>
    <br />
    Any saved applications will
be deleted if not submitted within 30 days.
<br /><br />
If you have questions on how 
to fill this form, see our 
<a href='javascript:;' class='blue'>help section</a> or <a href='javascript:;' class='blue'>drop us a
message</a>.</td>
  </tr></table>
  
  
  
  </td>
  <td>&nbsp;</td>
</tr>


<?php $this->load->view('addons/public_footer');?>

</table>
<?php echo minify_js('accounts__register_step_3', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js'));?>
</body>
</html>