<?php if(empty($msg)) $msg = get_session_msg($this);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Settings';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.form.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.pagination.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php 
$this->load->view('addons/secure_header', array('__page'=>'Settings' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'settings' ));
?>

<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<?php $this->load->view('addons/settings_ribbon', array('page'=>'user_settings' )); ?>


<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>



<?php 
if(!empty($view)){
?>

<table> 

<?php if($msg) echo "<tr><td>".format_notice($this,$msg)."</td></tr>";?>
 
 <tr><td class='bold'>a) Your Account Details:</td></tr>
    <tr><td class='two-fields'>
    <div><?php if(!empty($user['photo_url'])){
			echo "<div style='background: url(".base_url().'assets/uploads/'.$user['photo_url'].") no-repeat center top;' class='large-user-photo'></div>";
		} else {
			echo "NO PHOTO";
		}?></div>
    <div></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><span class='bold'>User Name:</span> <?php echo $user['user_name'];?></div>
    <div><span class='bold'>Permission Group:</span> <?php echo ucwords($user['group_type']);?></div>
    </td></tr>
    
    <tr><td class='two-fields'>
    <div><span class='bold'>Email Address:</span> <?php echo $user['email_address'];?></div>
    <div><span class='bold'>Telephone:</span> <?php echo $user['telephone'];?></div>
    </td></tr>
    <tr><td class='two-fields' style="vertical-align:top;">
    <div><span class='bold' style="vertical-align:top;">Secret Question:</span> <div style='display:inline-block;word-wrap: break-word; max-width: calc(100% - 50px);'><?php echo wordwrap($user['secret_question'], 25, '<BR>'); ?></div></div>
    <div><span class='bold'>Secret Answer:</span> [hidden]</div>
    </td></tr>
 
    
    <tr><td>&nbsp;</td></tr>
    <tr><td class='bold'>b) Your Contact Address:</td></tr>
    <tr><td class='two-fields'>
    <div><span class='bold'>First Name:</span> <?php echo $user['first_name'];?></div></div>
    <div><span class='bold'>Last Name:</span> <?php echo $user['last_name'];?></div></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><span class='bold'>Address:</span> <?php echo $user['address'];?></div>
    <div><span class='bold'>City:</span> <?php echo $user['city'];?></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><span class='bold'>Region/State:</span> <?php echo $user['state'];?></div>
    <div><span class='bold'>Zip Code:</span> <?php echo $user['zipcode'];?></div>
    </td></tr>
    
    <tr><td class='two-fields'>
    <div><span class='bold'>Country:</span> <?php echo $user['country'];?></div>
    <div></div></td></tr>
    
    
    
<tr><td style="padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="edit" name="edit" class="btn blue" data-url='users/settings' style='width: calc(100% - 47px);'>Edit</button></td></tr>
</table>







<?php 
} else {
?>
<table> 
 
 <tr><td class='bold'>a) Your Account Details:</td></tr>
    <tr><td class='two-fields'>
    <div><?php if(!empty($user['photo_url'])){
			echo "<div style='background: url(".base_url().'assets/uploads/'.$user['photo_url'].") no-repeat center top;' class='large-user-photo'></div>";
		} else {
			echo "<div class='textfield bold' style='width:calc(100% - 23px)'>NO PHOTO</div>";
		}?></div>
    <div><input type='text' id='newphoto' name='newphoto' placeholder='Photo (Min 400x400px, Max 500MB)'  class='filefield optional' data-val='png,jpg,jpeg,tiff' data-size='5120000' value='' style='max-width:calc(100% - 55px)' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><div class='textfield bold' style='width:calc(100% - 23px)'><?php echo $user['user_name']?></div></div>
    <div><div class='textfield bold' style='width:calc(100% - 23px)'><?php echo ucwords($user['group_type']);?></div></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><input type='password' id='newpassword' name='newpassword' class='optional' placeholder='New Password (Min 8 Characters with a number)' value='' /></div>
    <div><input type='password' id='confirmpassword' name='confirmpassword' class='same-as optional' data-field='newpassword' placeholder='Confirm Your Password' value='' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='emailaddress' name='emailaddress' class='email' placeholder='Your Email Address' value='<?php echo $user['email_address'];?>' /></div>
    <div><input type='text' id='telephone' name='telephone' class='numbersonly telephone' placeholder='Your Telephone Number' value='<?php echo $user['telephone'];?>' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><select id='question__secretquestions' name='question__secretquestions' class='drop-down'>
    <?php echo get_option_list($this, 'secretquestions', 'select', '', array('selected'=>$user['secret_question_id']));?>
    </select></div>
    <div><input type='password' id='secretanswer' name='secretanswer' class='optional' placeholder='Secret Answer (Required only if new)' value='' /></div>
    </td></tr>
 
    
    <tr><td class='bold'>b) Your Contact Address:</td></tr>
    <tr><td class='two-fields'>
    <div><div class='textfield bold' style='width:calc(100% - 23px)'><?php echo $user['first_name'];?></div></div>
    <div><div class='textfield bold' style='width:calc(100% - 23px)'><?php echo $user['last_name'];?></div></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='address' name='address' placeholder='Address' value='<?php echo $user['address'];?>' /></div>
    <div><input type='text' id='city' name='city' placeholder='City' value='<?php echo $user['city'];?>' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='region' name='region' placeholder='Region/State' value='<?php echo $user['state'];?>' /></div>
    <div><input type='text' id='zipcode' name='zipcode' placeholder='Zip Code' class='numbersonly' value='<?php echo $user['zipcode'];?>' /></div>
    </td></tr>
    
    <tr><td class='two-fields'>
    <div style='margin-left:0px;'><select id='contact__countries' name='contact__countries' class='drop-down'>
    <?php echo get_option_list($this, 'countries', 'select','', array(
		'selected'=>$user['country_id']
	));?>
    </select></div>
    </td></tr>
    
    
    
<tr><td style="padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% - 47px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'users/settings';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'users/settings/view/Y';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' /></td></tr>
</table>
<?php }?>






</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('permissions__settings', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>
</body>
</html>