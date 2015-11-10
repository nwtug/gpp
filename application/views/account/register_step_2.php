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
<?php $this->load->view('addons/step_ribbon', array('step'=>'2')); ?>

<tr>
  <td>&nbsp;</td><td style='height:calc(85vh - 214px); vertical-align: top;'>
  
  <table class='normal-table'><tr>
  	<td>
    <table class='microform' style='width:100%;max-width:1000px;'>
    <tr><td class='dark-grey'>To help us serve you better, fill out this form as completely as possible.</td></tr>
    <?php if(!empty($msg)) echo "<tr><td style='text-align:left;'>".format_notice($this,$msg)."</td></tr>";?>
    <tr><td class='bold'>a) About Your Organization:</td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='businessname' name='businessname' placeholder='Your Organization Name' value='<?php echo $this->native_session->get('businessname');?>' /></div>
    <div><select id='category__businesscategories' name='category__businesscategories' class='drop-down'>
    <?php echo get_option_list($this, 'businesscategories', 'select','', array(
		'selected'=>($this->native_session->get('category__businesscategories')? $this->native_session->get('category__businesscategories'): ''),
		'type'=>$this->native_session->get('organization_type')
	));?>
    </select></div>
    </td></tr>
    
    <tr><td>
    <textarea id="description" name="description" placeholder="Brief Description of Your Organization
    (This will appear in the search results - max 500 characters)" style="height:120px; width:calc(100% - 58px);"><?php echo $this->native_session->get('description');?></textarea>
    </td></tr>

<?php if($this->native_session->get('organization_type') == 'government_agency'){?>    
    <tr><td class='bold'>b) Ministry Leadership:</td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='ministrytitle' name='ministrytitle' placeholder='Ministry Head Title' value='<?php echo $this->native_session->get('ministrytitle');?>' /></div>
    <div><input type='text' id='ministrydeputytitle' name='ministrydeputytitle' placeholder='Ministry Deputy Head Title' value='<?php echo $this->native_session->get('ministrydeputytitle');?>' /></div>
    </td></tr>
    
    
<?php }

else {?>    
    
    <tr><td class='bold'>b) Your Organization Registration:</td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='taxid' name='taxid' placeholder='Tax ID' value='<?php echo $this->native_session->get('taxid');?>' /></div>
    <div><input type='text' id='registrationno' name='registrationno' placeholder='Organization Registration Number' value='<?php echo $this->native_session->get('registrationno');?>' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div style='margin-left:0px;'><select id='registration__countries' name='registration__countries' class='drop-down'>
    <?php echo get_option_list($this, 'countries', 'select','', array(
		'selected'=>($this->native_session->get('registration__countries')? $this->native_session->get('registration__countries'): '')
	));?>
    </select></div>
    </td></tr>
<?php }?>
    
    <tr><td class='bold'>c) Your Account Details:</td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='newusername' name='newusername' placeholder='Choose a User Name (Min 6 Characters)' value=''/></div>
    <div></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><input type='password' id='newpassword' name='newpassword' placeholder='Choose a Password (Min 8 Characters with a number)' value='' /></div>
    <div><input type='password' id='confirmpassword' name='confirmpassword' class='same-as' data-field='newpassword' placeholder='Confirm Your Password' value='' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='emailaddress' name='emailaddress' class='email' placeholder='Your Email Address' value='' /></div>
    <div><input type='text' id='telephone' name='telephone' class='numbersonly telephone' placeholder='Your Telephone Number' value='' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><select id='question__secretquestions' name='question__secretquestions' class='drop-down'>
    <?php echo get_option_list($this, 'secretquestions');?>
    </select></div>
    <div><input type='text' id='secretanswer' name='secretanswer' placeholder='Secret Answer' value='' /></div>
    </td></tr>
    
    
    <tr><td class='bold'>d) Confirm and Proceed:</td></tr>
    <tr><td class='two-fields' style='padding-top:0px;'>
    <div><table class='default-table'><tr>
    	<td class='dark-grey'>Answer this problem to prove you are human:</td>
        <td id='imagearea'><img src='<?php 
		if(file_exists(UPLOAD_DIRECTORY.session_id().'.png')) echo base_url().'assets/uploads/'.session_id().'.png';
		else echo base_url().'assets/uploads/placeholder_check.png'; ?>' border='0' /></td>
    </tr>
    </table>
    </div>
    
    <div><input type='text' id='checkanswer' name='checkanswer' placeholder='Your Answer' value='' style='min-width:60px;'/></div>
    
    </td></tr>
    
    
    <tr><td class='dark-grey'>By clicking the Next button, you agree to this website's <a href="<?php echo base_url().'page/terms_of_use/area/text_only';?>" class='shadowbox'>Terms</a> and <a href="<?php echo base_url().'page/privacy_policy/area/text_only';?>" class='shadowbox'>Privacy Policy</a>.</td></tr>
    
    <tr><td>&nbsp;</td></tr>
    
    <tr><td><div class='left-div'><button type="button" id="back" name="back" class="btn grey" style="width:100%;max-width:300px;">Back</button></div>
    <div class='left-div' style='padding-left:15px;'><button type="button" id="save" name="save" class="btn blue" style="width:100%;max-width:300px;">Save</button></div>
    <div class='right-div' style='padding-right:40px;'><button type="button" id="next" name="next" class="btn green submitmicrobtn" style="width:100%;max-width:300px;">Next</button></div>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'account/register';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'account/register/step/3';?>' />
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
<?php echo minify_js('home', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js'));?>
</body>
</html>