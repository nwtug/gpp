<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Contracts';?></title>
    
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
$this->load->view('addons/secure_header', array('__page'=>'Contracts: Add New' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'contracts' ));
?>

<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>

<table> 


<tr><td class='label'>Creating a Contract For:
<br />(Winner)</td><td style='padding:15px 5px 5px 5px;'><div class='textfield' style='width:100%;'><?php echo html_entity_decode($award['tender_notice']." (".$award['pde'].")", ENT_QUOTES);
echo "<br><a href='".base_url()."accounts/view_provider/d/".$award['provider_id']."' class='shadowbox closable'>".html_entity_decode($award['provider'], ENT_QUOTES)."</a>";?></div>
<input type='hidden' id='provider_id' name='provider_id' value='<?php echo $award['provider_id'];?>' />
<input type='hidden' id='pde_id' name='pde_id' value='<?php echo $award['pde_id'];?>' />
<input type='hidden' id='tender_id' name='tender_id' value='<?php echo $award['tender_id'];?>' /></td></tr>

<tr><td class='label'>Official Contract Name</td><td><input type='text' id='name' name='name' placeholder='Enter Name' value='<?php echo (!empty($contract['name'])? $contract['name']: '');?>'/></td></tr>

<tr><td class='label'>Contract Documents</td><td style='padding-left:0px;padding-right:0px;'>
<table class='default-table' style="width:calc(100% + 18px);">
<tr><td id='file_field_list' style='width:99%;'>
<input type='text' id='document_1' name='document[]' class='filefield' data-val='pdf,doc,docx' data-size='5120000' placeholder='Select Contract Document (PDF, Word. Max 500MB)' value=''/>
</td><td style='width:1%;padding-left:10px;'><div class='add-icon add-file-field' data-targetarea='file_field_list'>&nbsp;</div></td></tr>
</table>
</td></tr>

<tr><td class='label'>Contract Budget Amount</td><td style='padding-right:0px;'>
<table class='default-table'><tr><td style='padding-left:0px;padding-right:0px;'><input type='text' id='budget__currencies' name='budget__currencies' class='drop-down searchable' style="width:calc(100% - 26px); height:22px;" placeholder='Currency' value='<?php echo (!empty($contract['currency'])? $contract['currency']: '');?>'/>
<input type='hidden' id='currency_code' name='currency_code' value='<?php echo (!empty($contract['currency_code'])? $contract['currency_code']: '');?>' /></td>
<td style='padding-left:0px;padding-right:5px;'><input type='text' id='amount' name='amount' class='numbersonly' placeholder='Amount (to nearest unit)' style="width:calc(100% - 2px);" value='<?php echo (!empty($contract['amount'])? $contract['amount']: '');?>'/></td></tr></table>
</td></tr>

<tr><td class='label'>Source of Funds</td><td><input type='text' id='source_of_funds' name='source_of_funds' placeholder='Source of Funds' value='<?php echo (!empty($contract['source_of_funds'])? $contract['source_of_funds']: '');?>'/></td></tr>

<tr><td class='label'>Official Start Date</td><td><input type='text' id='start_date' name='start_date' class='calendar future-date' style='width: calc(100% - 34px);' placeholder='Select Date' value='<?php echo (!empty($contract['start_date'])? $contract['start_date']: '');?>'/></td></tr>

<tr><td class='label'>Status</td><td><select id='contract__contractstatus' name='contract__contractstatus' class='drop-down' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'contractstatus', 'select', '', array('selected'=>(!empty($contract['status'])? $contract['status']: '') ));?>
</select></td></tr>

<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'contracts/add';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'contracts/manage';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' /></td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('contracts__new_tender', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>
</body>
</html>