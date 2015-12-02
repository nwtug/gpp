<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />


<table class='normal-table microform ignoreclear'>

<tr><td><input type="text" id="reason__contactreason" name="reason__contactreason" placeholder="Enter or Select reason" class="drop-down searchable do-not-clear" value="" style="width:100%;"/></td></tr>

<tr><td><textarea id='details' name='details' placeholder='Details (Max 500 characters)' class='limit-chars' data-max='500' style='width:100%;height: 100px;'></textarea></td></tr>


<tr><td><button type="button" id="messagebtn" name="messagebtn" class="btn blue submitmicrobtn" style="width:100%;">Send</button>
<input type='hidden' id='action' name='action' value='<?php echo base_url().$action;?>' />
<input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().$redirect;?>' />
<input type='hidden' id='resultsdiv' name='resultsdiv' value='' />

<input name="layerid" id="layerid" type="hidden" value="" />
<input name="idlist" id="idlist" type="hidden" value="<?php echo $id_list;?>" /></td></tr>
</table>
<?php echo minify_js('pages__send_from_list', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.pagination.js'));?>
