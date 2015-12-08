<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.form.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />

<?php 
if(!empty($msg)){
	echo format_notice($this, $msg);
} else {
?>
<table class='normal-table microform ignoreclear'>
<tr><td colspan='2'><?php echo "<span class='h2 bold'>".html_entity_decode($contract['name'], ENT_QUOTES)."</span>";
echo "<br><b>PDE:</b> ".html_entity_decode($contract['pde'], ENT_QUOTES);
echo "<br><b>Provider:</b> ".html_entity_decode($contract['provider'], ENT_QUOTES);?></td></tr>

<tr><td style='padding-right:0px;'><table class='default-table' style='width:100%;'><tr><td style='padding-left:0px;width:50%;'>
<?php if($this->native_session->get('__user_type') == 'provider'){ ?>
<div style='width:100%'>Status: <span class='bold'>Active</span></div>
<input type='hidden'  id='contract__contractstatus' name='contract__contractstatus' value='active' />
<?php } else {?>
<select id='contract__contractstatus' name='contract__contractstatus' class='drop-down' style="width:100%;">
<?php echo get_option_list($this, 'contractstatus');?>
</select>
<?php }?></td>
<td style='padding-right:0px;width:50%;'><select id='contract__percentage' name='contract__percentage' class='drop-down' style="width:calc(100% - 5px);">
<?php echo get_option_list($this, 'percentage');?>
</select><input type='hidden' name='contract_id' id='contract_id' value='<?php echo $d;?>' /></td>
</tr></table></td></tr>

<tr><td style='padding-right:0px;'><table class='default-table' style='width:100%;'><tr><td style='padding-left:0px;width:50%;'>
<input type="text" id="amountspent" name="amountspent"  class='numbersonly' placeholder='Amount Spent (in SSP)' value='' style='min-width:100%;'/></td>
<td style='padding-right:0px;width:50%;'><input type="text" id="amountpaid" name="amountpaid"  class='numbersonly' placeholder='Amount Paid (in SSP)' value='' style="width:calc(100% - 5px);"/></td>
</tr></table></td></tr>

<tr><td><input type="text" id="document" name="document"  class='filefield optional' data-val='pdf,doc,docx,jpeg,jpg,tiff' data-size='5120000' placeholder='Document/Photo (OPTIONAL: PDF, Word, JPEG, JPG, TIFF. Max 500MB)' value='' style='min-width:100%;'/>
</td></tr>

<tr><td><textarea id='note' name='note' placeholder='Note Details (Max 500 characters)' class='limit-chars' data-max='500' style='width:100%;height: 100px;'></textarea></td></tr>

<tr><td><button type="button" id="addnote" name="addnote" class="btn blue submitmicrobtn" style="width:100%;">Add Note</button>
<input type='hidden' id='action' name='action' value='<?php echo base_url().'contracts/add_note';?>' />
<input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'contracts/add_note/a/msg';?>' />
<input type='hidden' id='resultsdiv' name='resultsdiv' value='' />

<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>
<?php echo minify_js('contracts__new_note', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.datepicker.js', 'pss.pagination.js'));

}?>