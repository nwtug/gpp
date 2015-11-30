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
$this->load->view('addons/secure_header', array('__page'=>'Settings: Add Group' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'settings' ));
?>

<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<?php $this->load->view('addons/settings_ribbon', array('page'=>'permission_groups' )); ?>


<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>

<table> 

<tr><td class='label'>Name</td><td><input type='text' id='name' name='name' placeholder='Enter Name' value='<?php echo (!empty($group['name'])? $group['name']: '');?>'/></td></tr>

<tr><td class='label'>Description</td><td><textarea id='notes' name='notes' placeholder='Briefly describe the purpose of this permission group (Max 200 characters)' class='limit-chars' data-max='200' style='height: 90px;'><?php echo (!empty($group['notes'])? $group['notes']: '');?></textarea></td></tr>

<tr><td class='label'>Type</td><td><select id='group__grouptypes' name='group__grouptypes' class='drop-down' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'grouptypes', 'select', '', array('selected'=>(!empty($group['type'])? $group['type']: '') ));?>
</select></td></tr>

<tr><td class='label'>Permissions</td><td style='padding-right:0px;'>
<div style='max-height:400px;overflow-x:hidden;overflow-y:auto;border: 1px solid #DDDDDD;width:calc(100% + 7px);'>
<table class='list-table'>
<tr><th style='width:1%;'>&nbsp;</th><th style='width:1%;'>Category</th><th>Name</th></tr>
<?php 
foreach($permissions AS $row){
	echo "<tr>
	<td><input id='select_".$row['permission_id']."' name='permissions[]' type='checkbox' value='".$row['permission_id']."' class='bigcheckbox' ".(!empty($group['permissions']) && in_array($row['permission_id'], $group['permissions'])? ' checked': '')."><label for='select_".$row['permission_id']."'></label></td>
	<td>".ucwords(str_replace('_', ' ', $row['category']))."</td>
	<td>".$row['name']."</td> 
	</tr>";
}
?>
</table>
</div>
</td></tr>

<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'permissions/add';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'permissions/manage';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' /></td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('permissions__new_group', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>
</body>
</html>