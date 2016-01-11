<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Users';?></title>
    
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
$this->load->view('addons/secure_header', array('__page'=>'Users: Add New' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'users' ));
$groupList = $this->native_session->get('__user_type').'groups';
?>

<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>

<table> 

<tr><td class='label'>Name</td><td style='padding-right:0px;'>
<table class='default-table'><tr>
<td style='padding-left:0px;padding-right:0px;'><input type='text' id='firstname' name='firstname' placeholder='First Name' value='<?php echo (!empty($user['first_name'])? html_entity_decode($user['first_name'], ENT_QUOTES): '');?>'/></td>
<td style='padding-left:0px;padding-right:5px;'><input type='text' id='lastname' name='lastname' placeholder='Last Name' value='<?php echo (!empty($user['last_name'])? html_entity_decode($user['last_name'], ENT_QUOTES): '');?>'/></td>
</tr></table>
</td></tr>

<tr><td class='label'>Email Address</td><td><input type='text' id='emailaddress' name='emailaddress' class='email' placeholder='Email Address' value='<?php echo (!empty($user['email_address'])? $user['email_address']: '');?>'/></td></tr>

<tr><td class='label'>Telephone</td><td><input type='text' id='telephone' name='telephone' class='numbersonly telephone' placeholder='Telephone Number' value='<?php echo (!empty($user['telephone'])? $user['telephone']: '');?>'/></td></tr>

<tr><td class='label'>User Name</td><td><input type='text' id='newusername' name='newusername' <?php echo !empty($user['user_name'])? " class='bold' ": '';?> placeholder='Choose a User Name (Min 6 Characters)' value='<?php echo (!empty($user['user_name'])? $user['user_name']: '');?>' <?php if(!empty($user['user_name'])) echo ' readonly';?>/></td></tr>

<tr><td class='label'>Password</td><td><input type='password' id='newpassword' name='newpassword' placeholder='Choose a Password (Min 8 Characters with a number)' value='<?php echo (!empty($user['password'])? $user['password']: generate_temp_password());?>'/></td></tr>

<tr><td class='label'>Permission Group</td><td><select id='user__<?php echo $groupList;?>' name='user__<?php echo $groupList;?>' class='drop-down' style="width:calc(100% + 17px);">
<?php echo get_option_list($this, $groupList, 'select', '', array('selected'=>(!empty($user['permission_group_id'])? $user['permission_group_id']: '') ));?>
</select></td></tr>

<tr><td class='label'>Status</td><td><select id='user__userstatus' name='user__userstatus' class='drop-down' style="width:calc(100% + 17px);">
<?php echo get_option_list($this, 'userstatus', 'select', '', array('selected'=>(!empty($user['status'])? $user['status']: '') ));?>
</select></td></tr>

<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'users/add';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'users';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' />
<?php
if(!empty($user['user_id'])){
	echo "<input type='hidden' id='user_id' name='user_id' value='".$user['user_id']."' />";
} 
?></td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('contracts__new_tender', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>
</body>
</html>