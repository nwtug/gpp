<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.form.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />

<?php 
if(!empty($msg)){
	echo format_notice($this, $msg);
} else {
?>
<table class='normal-table microform ignoreclear'>

<tr>
<td class='label' style='padding-top:5px !important;'>Invitation For:
<br />(Bid Invitation)</td>

<td style='padding:15px 5px 5px 5px;'><div class='textfield' style='width:calc(100%-30px);'><?php echo "<span class='bold'>".html_entity_decode($tender['subject'], ENT_QUOTES)."</span>";

if($this->native_session->get('__user_type') != 'pde'){
	echo "<br>(".html_entity_decode($tender['pde'], ENT_QUOTES).")";
}?></div>
<input type='hidden' id='tender_id' name='tender_id' value='<?php echo $tender['tender_id'];?>' /></td>
</tr>

<tr><td class='label'>Invited So far:</td>
<td><?php
if(!empty($invited)){
	echo "<table class='list-table textfield' style='width:100%;'>
		<tr><th>Provider</th><th>Last Invited</th></tr>";
	foreach($invited AS $row){
		echo "<tr>
		<td style='vertical-align:top;'>".html_entity_decode($row['provider'], ENT_QUOTES)."</td>
		<td style='vertical-align:top;'>".date(FULL_DATE_FORMAT, strtotime($row['last_invited']))."</td>
		</tr>";
	}
	
	echo "</table>";
}
else echo "NONE";

?></td>
</tr>

<tr>
<td class='label'>Provider:</td>
<td>
<input type='text' id='invite__providers' name='invite__providers' placeholder='Search or Select Provider' class='drop-down searchable clear-on-empty' data-clearfield='provider_id' value='' style='width:100%;max-width:calc(100%-10px);'/>
<input type='hidden' name='provider_id' id='provider_id' value='' /></td>
</td>
</tr>


<tr>
<td class='label'>Note:</td>
<td><textarea id='note' name='note' placeholder='OPTIONAL: Any special instructions or bid expectations (Max 500 characters)' class='limit-chars optional' data-max='500' style='width:100%;height: 100px;'></textarea></td>
</tr>

<tr><td colspan='2'><button type="button" id="sendinvite" name="sendinvite" class="btn blue submitmicrobtn" style="width:100%;">Send Invite</button>
<input type='hidden' id='action' name='action' value='<?php echo base_url().'tenders/invite';?>' />
<input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'tenders/invite/a/msg';?>' />
<input type='hidden' id='resultsdiv' name='resultsdiv' value='' />

<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>
<?php echo minify_js('tenders__invite', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.datepicker.js', 'pss.pagination.js'));

}?>