<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Training';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.form.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.pagination.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php 
$this->load->view('addons/secure_header', array('__page'=>'Resources: Add Training' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'resources' ));
?>

<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<?php $this->load->view('addons/resources_ribbon', array('page'=>'training_activities' )); ?>


<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>

<table> 

<tr><td class='label'>Subject</td><td><input type='text' id='name' name='name' placeholder='Enter Subject' value='<?php echo (!empty($training['name'])? $training['name']: '');?>'/></td></tr>

<tr><td class='label'>Category</td><td><select id='training__trainingcategories' name='training__trainingcategories' class='drop-down' style="width:calc(100% + 18px);">
<?php echo get_option_list($this, 'trainingcategories', 'select', '', array('selected'=>(!empty($training['category'])? $training['category']: '') ));?>
</select></td></tr>

<tr><td class='label'>Event Time</td><td style='padding-right:0px;'>
<table class='default-table'><tr><td style='padding-left:0px;'><input type='text' id='eventtime' name='eventtime' class='calendar showtime clickactivated future-date' placeholder='Select Date and Time' style="width:calc(100% - 40px);" value='<?php echo (!empty($training['eventtime'])? $training['eventtime']: '');?>'/></td>
<td style='padding-right:0px;'><input type='text' maxlength="2" id='duration' name='duration' class='numbersonly' placeholder='Duration (hrs)' style="width:calc(100% - 6px);" value='<?php echo (!empty($training['duration'])? $training['duration']: '');?>'/></td></tr></table>
</td></tr>

<tr><td class='label'>Description</td><td><textarea id='description' name='description' placeholder='Briefly describe this training event (Max 500 characters)' class='limit-chars' data-max='500' style='height: 150px;'><?php echo (!empty($training['description'])? $training['description']: '');?></textarea></td></tr>

<tr><td class='label'>Venue</td><td><input type='text' id='venue' name='venue' placeholder='Venue' value='<?php echo (!empty($training['venue'])? $training['venue']: '');?>'/></td></tr>

<tr><td class='label'>Related Link</td><td><input type='text' id='url' name='url' class='optional' placeholder='OPTIONAL: Enter Link e.g., http://www.example.com' value='<?php echo (!empty($training['url'])? $training['url']: '');?>'/></td></tr>

<tr><td class='label'>Related Files</td>
<td style='padding-left:0px;padding-right:0px;'>
<?php
if(!empty($training['documents'])){
	$documents = explode(',',$training['documents']);
	foreach($documents AS $file) echo "&nbsp;&nbsp;<a href='".base_url()."pages/download/file/".$file."'>".$file."</a><br>";
	
	echo "<input type='hidden' id='olddocuments' name='olddocuments' value='".$training['documents']."' />";
}
?>
<table class='default-table' style="width:calc(100% + 18px);">
<tr><td id='file_field_list' style='width:99%;'>
<input type='text' id='document_1' name='document_1' class='filefield optional' data-val='pdf,doc,docx' data-size='5120000' placeholder='OPTIONAL: Select Document (PDF, Word. Max 500MB)' value=''/>
</td><td style='width:1%;padding-left:10px;'><div class='add-icon add-file-field' data-targetarea='file_field_list'>&nbsp;</div></td></tr>
</table>
</td>
</tr>

<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'training/add';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'training/manage';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' /></td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('training__new_training', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery-ui-timepicker-addon.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>
</body>
</html>