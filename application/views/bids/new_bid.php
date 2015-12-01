<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': New Bid';?></title>
    
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
$this->load->view('addons/secure_header', array('__page'=>'Submit Bid' ));
$this->load->view('addons/provider_top_menu', array('__page'=>'bids' ));
?>

<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>

<table> 


<tr><td class='label'>Submitting a Bid On:
<br />(Tender)</td><td style='padding:15px 5px 5px 5px;'><div class='textfield' style='width:100%;'><?php echo html_entity_decode($tender['pde'], ENT_QUOTES);
echo "<br><a href='".base_url()."tenders/view_one/d/".$tender['tender_id']."' class='shadowbox closable'>".html_entity_decode($tender['name'], ENT_QUOTES)."</a>";?></div>
<input type='hidden' id='tender_id' name='tender_id' value='<?php echo $tender['tender_id'];?>' /></td></tr>

<tr><td class='label'>Summary</td><td><textarea id='summary' name='summary' placeholder='Briefly describe your bid and why your organization should be awarded the tender  (Max 500 characters)' class='limit-chars' data-max='500' style='height: 150px;'><?php echo (!empty($bid['summary'])? $bid['summary']: '');?></textarea></td></tr>


<tr><td class='label'>Add Documents</td><td style='padding-left:0px;padding-right:0px;'>
<table class='default-table' style="width:calc(100% + 18px);">
<tr><td id='file_field_list' style='width:99%;'>
<input type='text' id='document_1' name='document[]' class='filefield' data-val='pdf,doc,docx' data-size='5120000' placeholder='Select Bid Document (PDF, Word. Max 500MB)' value=''/>
</td><td style='width:1%;padding-left:10px;'><div class='add-icon add-file-field' data-targetarea='file_field_list'>&nbsp;</div></td></tr>
</table>
</td></tr>


<tr><td class='label long'>Validity Period of Your Bid</td><td style='padding-right:0px;'>
<table class='default-table'><tr><td style='padding-left:0px;'><input type='text' id='valid_from' name='valid_from' class='calendar clickactivated future-date' onclick='setDatePicker(this)' placeholder='From' style="width:calc(100% - 40px);" value='<?php echo (!empty($bid['valid_from'])? $bid['valid_from']: '');?>'/></td>
<td style='padding-right:0px;'><input type='text' id='valid_to' name='valid_to' class='calendar clickactivated future-date' onclick='setDatePicker(this)' placeholder='To' style="width:calc(100% - 40px);" value='<?php echo (!empty($bid['valid_to'])? $bid['valid_to']: '');?>'/></td></tr></table>
</td></tr>


<tr><td class='label'>Your Bid</td><td style='padding-right:0px;'>
<table class='default-table'><tr><td style='padding-left:0px;padding-right:0px;'><input type='text' id='bid__currencies' name='bid__currencies' class='drop-down searchable' style="width:calc(100% - 28px); height:22px;" placeholder='Currency' value='<?php echo (!empty($bid['currency'])? $bid['currency']: '');?>'/>
<input type='hidden' id='currency_code' name='currency_code' value='<?php echo (!empty($bid['currency_code'])? $bid['currency_code']: '');?>' /></td>
<td style='padding-left:0px;padding-right:5px;'><input type='text' id='amount' name='amount' class='numbersonly' placeholder='Amount (to nearest unit)' style="width:calc(100% - 5px);" value='<?php echo (!empty($bid['amount'])? $bid['amount']: '');?>'/></td></tr></table>
</td></tr>

<tr><td class='label'>Status</td><td><select id='bid__bidstatus' name='bid__bidstatus' class='drop-down' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'bidstatus', 'select', '', array('selected'=>(!empty($bid['status'])? $bid['status']: '') ));?>
</select></td></tr>

<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'bids/add';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'bids/my_list';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' /></td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('bids__new_bid', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>
</body>
</html>