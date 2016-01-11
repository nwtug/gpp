<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': New Tender';?></title>
    
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
$this->load->view('addons/secure_header', array('__page'=>'Procurement: Add Invitation for Bids/Quotations' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'procurement' ));
?>

<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<?php $this->load->view('addons/procurement_ribbon', array('page'=>'tenders')); ?>

<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>

<table> 

<tr><td class='label long'>Procurement Plan</td><td><input type="text" id="tender__procurementplans" name="tender__procurementplans" placeholder="Search Procurement Plan" class="<?php echo (empty($tender['plan_id'])? 'drop-down searchable clear-on-empty ': 'read-only');?>" data-clearfield='plan_id' value="<?php echo (!empty($tender['procurement_plan'])? $tender['procurement_plan']: '');?>"/>
<input type='hidden' name='plan_id' id='plan_id' value='<?php echo (!empty($tender['plan_id'])? $tender['plan_id']: '');?>' /></td></tr>

<tr><td class='label'>Subject of Procurement</td><td><input type='text' id='tender__procurementplansubjects' name='tender__procurementplansubjects' placeholder='Select or Search Subject' class="<?php echo (empty($tender['subject_id'])? 'drop-down searchable always-refresh clear-on-empty ': 'read-only');?>" data-val='plan_id' data-clearfield='subject_id' value='<?php echo (!empty($tender['subject'])? $tender['subject']: '');?>'/>
<input type='hidden' name='subject_id' id='subject_id' value='<?php echo (!empty($tender['subject_id'])? $tender['subject_id']: '');?>' /></td></td></tr>


<tr><td class='label'>Reference Number</td><td style='padding-right:0px;'>
<table class='default-table' style="width:calc(100% + 18px);"><tr><td style='padding-left:0px;width:99%;'><input type='text' id='reference_number' name='reference_number' placeholder='Reference Number' class='<?php echo (!empty($tender['reference_number'])? 'read-only': '');?>' style="width:calc(100% - 5px);" value='<?php echo (!empty($tender['reference_number'])? $tender['reference_number']: '');?>'/></td>
<td style='width:1%;padding-left:10px;'><div class='question-icon shadowbox closable' data-url='<?php echo base_url().'faqs/details/d/1';?>'>&nbsp;</div></td></tr></table>
</td></tr>

<tr><td class='label'>Type of Procurement</td><td>
<select id='tender__procurementtypes' name='tender__procurementtypes' style="width:calc(100% + 18px);" class='drop-down<?php echo (!empty($tender['type'])? ' read-only': '');?>'>
<?php echo get_option_list($this, 'procurementtypes', 'select', '', array('selected'=>(!empty($tender['type'])? $tender['type']: '') ));?>
</select>
</td></tr>

<tr><td class='label'>Summary</td><td><textarea id='summary' name='summary' placeholder='A brief description of the tender notice (Max 500 characters)' class='limit-chars' data-max='500' style='height: 150px;'><?php echo (!empty($tender['description'])? $tender['description']: '');?></textarea></td></tr>


<tr><td class='label'>Add Documents</td><td style='padding-left:0px;padding-right:0px;'>
<?php
if(!empty($tender['document_url'])){
	$documents = explode(',',$tender['document_url']);
	foreach($documents AS $file) echo "&nbsp;&nbsp;<a href='".base_url()."pages/download/file/".$file."'>".$file."</a><br>";
	
	echo "<input type='hidden' id='olddocuments' name='olddocuments' value='".$tender['document_url']."' />";
}
?>
<table class='default-table' style="width:calc(100% + 18px);">
<tr><td id='file_field_list' style='width:99%;'>
<input type='text' id='document_1' name='document_1' class='filefield<?php echo (!empty($tender['document_url'])? ' optional': '');?>' data-val='pdf,doc,docx' data-size='5120000' placeholder='<?php echo (!empty($tender['document_url'])? 'OPTIONAL: ': '');?>Select Tender Document (PDF, Word. Max 500MB)' value=''/>
</td><td style='width:1%;padding-left:10px;'><div class='add-icon add-file-field' data-targetarea='file_field_list'>&nbsp;</div></td></tr>
</table>
</td></tr>



<tr><td class='label'>Submission Deadline</td><td><input type='text' id='deadline' name='deadline' class='calendar showtime clickactivated future-date' onclick="setDatePicker(this)" style='width: calc(100% - 34px);' placeholder='Select Submission Deadline' value='<?php echo (!empty($tender['deadline']) && $tender['deadline'] != '0000-00-00 00:00:00'? date(FULL_DATE_FORMAT, strtotime($tender['deadline'])): '');?>'/></td></tr>

<tr><td class='label'>Display Period</td><td style='padding-right:0px;'>
<table class='default-table'><tr><td style='padding-left:0px;'><input type='text' id='display_from' name='display_from' class='calendar clickactivated future-date' onclick='setDatePicker(this)' placeholder='From' style="width:calc(100% - 40px);" value='<?php echo (!empty($tender['display_start_date'])? date(SHORT_DATE_FORMAT, strtotime($tender['display_start_date'])): '');?>'/></td>
<td style='padding-right:0px;'><input type='text' id='display_to' name='display_to' class='calendar clickactivated future-date' onclick='setDatePicker(this)' placeholder='To' style="width:calc(100% - 40px);" value='<?php echo (!empty($tender['display_end_date'])? date(SHORT_DATE_FORMAT, strtotime($tender['display_end_date'])): '');?>'/></td></tr></table>
</td></tr>

<tr><td class='label'>Status</td><td><select id='tender__tenderstatus' name='tender__tenderstatus' class='drop-down' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'tenderstatus', 'select', '', array('selected'=>(!empty($tender['status'])? $tender['status']: '') ));?>
</select></td></tr>

<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'tenders/add';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'tenders/manage';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' />
<?php
if(!empty($tender['tender_id'])){
	echo "<input type='hidden' id='tender_id' name='tender_id' value='".$tender['tender_id']."' />";
}
?>
    </td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>

<?php echo minify_js('tenders__new_tender', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery-ui-timepicker-addon.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>

</body>
</html>