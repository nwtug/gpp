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
$this->load->view('addons/secure_header', array('__page'=>'Best Evaluated Bidder' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>($this->native_session->get('__user_type') == 'provider'? 'contracts': 'procurement') ));

if($this->native_session->get('__user_type') != 'provider'){
?>
<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<?php $this->load->view('addons/procurement_ribbon', array('page'=>'best_bidders')); 
}
?>


<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>
<table> 


<tr><td class='label'>Subject of Procurement</td>
<td><input type='text' id='tender__tendernotices' name='tender__tendernotices' placeholder='Select Bid Invitation' class='drop-down searchable clear-on-empty' data-val='show_bidders' data-clearfield='tender_id' value=''/>
<input type='hidden' id='tender_id' name='tender_id' value='' />
<input type='hidden' id='show_bidders' name='show_bidders' value='Y' /></td>
</tr>


<tr><td class='label'>Select Winning Bidder</td><td style='padding-right:0px;'>
<div id='tender_providers_div' class='textfield' style='width:calc(100% - 5px);'>Select Subject of Procurement above to view bidders.</div>
</td></tr>



<tr><td class='label'>Final Bid Price</td><td style='padding-right:0px;'>

<table class='default-table'><tr><td style='padding-left:0px;padding-right:0px;'><input type='text' id='bid__currencies' name='bid__currencies' class='drop-down searchable' style="width:calc(100% - 28px); height:22px;" placeholder='Currency' value='<?php echo (!empty($bid['bid_currency'])? $bid['bid_currency']: '');?>'/>
<input type='hidden' id='currency_code' name='currency_code' value='<?php echo (!empty($bid['bid_currency'])? $bid['bid_currency']: '');?>' /></td>

<td style='padding-left:0px;padding-right:5px;'><input type='text' id='amount' name='amount' class='numbersonly' placeholder='Amount (to nearest unit)' style="width:100%;" value='<?php echo (!empty($bid['bid_amount'])? $bid['bid_amount']: '');?>'/></td></tr></table>

</td></tr>





<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'bids/best_evaluated';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'bids/manage/a/best_bidders';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' />
    </td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('new_bid', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>
</body>
</html>