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
<?php $this->load->view('addons/settings_ribbon', array('page'=>'organization_settings' )); ?>


<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>



<?php 
if(!empty($view)){
?>

<table> 

<?php if($msg) echo "<tr><td>".format_notice($this,$msg)."</td></tr>";?>
 
 <tr><td class='bold'>a) Organization Account Details:</td></tr>
    <tr><td class='two-fields'>
    <div><?php if(!empty($organization['logo_url'])){
			echo "<div style='background: url(".base_url().'assets/uploads/'.$organization['logo_url'].") no-repeat center top;' class='large-user-photo'></div>";
		} else {
			echo "NO LOGO";
		}?></div>
    <div></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><span class='bold'>Organization Name:</span> <?php echo $organization['name'];?></div>
    <div><span class='bold'>Admin Name:</span> <?php echo ucwords($organization['owner']);?></div>
    </td></tr>
    
    <tr><td class='two-fields'>
    <div style='max-width: calc(100% - 31px);'>
	<span class='bold'>Description:</span><br />
	<?php echo wordwrap(html_entity_decode($organization['description'], ENT_QUOTES), 80, '<BR>');?></div>
    <div></div>
    </td></tr>
    <tr><td class='two-fields' style="vertical-align:top;">
    <div><span class='bold'>Tax ID:</span> <?php echo $organization['tax_id']; ?></div>
    <div><span class='bold'>Registration Number:</span> <?php echo $organization['registration_number']; ?></div>
    </td></tr>
    <tr><td class='two-fields' style="vertical-align:top;">
    <div><span class='bold'>Registration Country:</span> <?php echo $organization['registration_country']; ?></div>
    <div><span class='bold'>Registration Date:</span> <?php echo (!empty($organization['date_established'])? date(SHORT_DATE_FORMAT, strtotime($organization['date_established'])): ''); ?></div>
    </td></tr>
 
    
    <tr><td>&nbsp;</td></tr>
    <tr><td class='bold'>b) Organization Contact Address:</td></tr>
    <tr><td class='two-fields'>
    <div><span class='bold'>Address:</span> <?php echo $organization['contact_address'];?></div>
    <div><span class='bold'>City:</span> <?php echo $organization['contact_city'];?></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><span class='bold'>Region/State:</span> <?php echo $organization['contact_region'];?></div>
    <div><span class='bold'>Zip Code:</span> <?php echo $organization['contact_zipcode'];?></div>
    </td></tr>
    
    <tr><td class='two-fields'>
    <div><span class='bold'>Country:</span> <?php echo (!empty($organization['contact_country'])? $organization['contact_country']: '');?></div>
    <div></div></td></tr>
    
    
    
<tr><td style="padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="edit" name="edit" class="btn blue" data-url='organizations/settings' style='width: calc(100% - 47px);'>Edit</button></td></tr>
</table>







<?php 
} else {
?>
<table> 
 
 <tr><td class='bold'>a) Organization Account Details:</td></tr>
 
    <tr><td class='two-fields'>
    <div><?php if(!empty($organization['logo_url'])){
			echo "<div style='background: url(".base_url().'assets/uploads/'.$organization['logo_url'].") no-repeat center top;' class='large-user-photo'></div>";
		} else {
			echo "<div class='textfield bold' style='width:calc(100% - 23px)'>NO LOGO</div>";
		}?></div>
    <div><input type='text' id='newlogo' name='newlogo' placeholder='Logo (Min 400x400px, Max 500MB)'  class='filefield optional' data-val='png,jpg,jpeg,tiff' data-size='5120000' value='' style='max-width:calc(100% - 55px)' /></div>
    </td></tr>
    
    <tr><td class='two-fields'>
    <div><input type='text' id='name' name='name' placeholder='Organization Name' value='<?php echo html_entity_decode($organization['name'], ENT_QUOTES);?>' /></div>
    <div><div class='textfield bold' style='width:calc(100% - 23px)'><?php echo 'Admin Name: '.html_entity_decode($organization['owner'], ENT_QUOTES);?></div></div>
    </td></tr>
    
    <tr><td class='two-fields'>
    <div style='width:calc(100% - 31px);'><textarea id='description' name='description' placeholder='Briefly describe your organization (Max 500 characters)' class='limit-chars' data-max='500' style='height: 150px;'><?php echo html_entity_decode($organization['description'], ENT_QUOTES);?></textarea></div>
    <div></div>
    </td></tr>
    
    <tr><td class='two-fields' style="vertical-align:top;">
    <div><div class='textfield bold' style='width:calc(100% - 23px)'><?php echo 'Tax ID: '.$organization['tax_id'];?></div></div>
    <div><input type='text' id='registrationno' name='registrationno' placeholder='Registration Number' value='<?php echo $organization['registration_number'];?>' /></div>
    </td></tr>
    
    <tr><td class='two-fields' style="vertical-align:top;">
    <?php if(!empty($organization['registration_country'])){?>
    <div><div class='textfield bold' style='width:calc(100% - 23px)'><?php echo 'Country: '.$organization['registration_country'];?></div></div>
    <?php } else {?>
    <div><select id='registration__countries' name='registration__countries' class='drop-down'>
    <?php echo get_option_list($this, 'countries');?>
    </select></div>
    <?php }?>
    
    <?php if(!empty($organization['date_established'])){?>
    <div><div class='textfield bold' style='width:calc(100% - 23px)'><?php echo 'Registration Date: '.date(SHORT_DATE_FORMAT, strtotime($organization['date_established']));?></div></div>
    <?php } else {?>
    <div><input type='text' id='registrationdate' name='registrationdate' class='calendar clickactivated' onclick='setDatePicker(this)' placeholder='Registration Date' value=''/></div>
    <?php }?>
    </td></tr>
    
    
    <tr><td>&nbsp;</td></tr>
    <tr><td class='bold'>b) Organization Contact Address:</td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='address' name='address' placeholder='Address' value='<?php echo $organization['contact_address'];?>' /></div>
    <div><input type='text' id='city' name='city' placeholder='City' value='<?php echo $organization['contact_city'];?>' /></div>
    </td></tr>
    <tr><td class='two-fields'>
    <div><input type='text' id='region' name='region' placeholder='Region/State' value='<?php echo $organization['contact_region'];?>' /></div>
    <div><input type='text' id='zipcode' name='zipcode' placeholder='Zip Code' class='numbersonly' value='<?php echo $organization['contact_zipcode'];?>' /></div>
    </td></tr>
    
    <tr><td class='two-fields'>
    <div style='margin-left:0px;'><select id='contact__countries' name='contact__countries' class='drop-down'>
    <?php echo get_option_list($this, 'countries', 'select','', array(
		'selected'=>$organization['contact_country_id']
	));?>
    </select></div>
    </td></tr>
    
    
    
<tr><td style="padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% - 47px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'organizations/settings';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'organizations/settings/view/Y';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' /></td></tr>
</table>
<?php }?>






</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('organizations__settings', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>
</body>
</html>