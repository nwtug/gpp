<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />


<table class='normal-table'><tr><td style='height:250px; width:100%; vertical-align:top;'>
<table class='microform ignoreclear' style="width:100%;">

<tr><td>
<input type='text' id='valid_until' name='valid_until' class='calendar clickactivated future-date' onclick='setDatePicker(this)' placeholder='Valid Until Date' value='' style='width:100%;'/>
</td></tr>

<tr><td>
<input type='text' id='amount_paid' name='amount_paid' class='numbersonly optional' placeholder='Amount Paid in SSP (OPTIONAL)' value='' style='width:100%;'/>
</td></tr>

<tr><td><button type="button" id="certificatebtn" name="certificatebtn" class="btn blue submitmicrobtn" style="width:100%;">Generate</button>
<input type='hidden' id='action' name='action' value='<?php echo base_url().'providers/generate_certificate';?>' />
<input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'providers/generate_certificate/a/results';?>' />
<input type='hidden' id='resultsdiv' name='resultsdiv' value='' />

<input name="layerid" id="layerid" type="hidden" value="" />
<input name="providerid" id="providerid" type="hidden" value="<?php echo $d;?>" /></td></tr>
</table>
</td></tr></table>
<?php echo minify_js('providers__certificate_specs', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.datepicker.js', 'pss.pagination.js'));?>
