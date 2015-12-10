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

<tr><td><select id='user__permissiongroups' name='user__permissiongroups' class='drop-down' style="width:100%;">
<?php echo get_option_list($this, 'permissiongroups');?>
</select></td></tr>

<tr><td><button type="button" id="applygroup" name="applygroup" class="btn blue submitmicrobtn" style="width:100%;">Apply Group</button>
<input type='hidden' id='action' name='action' value='<?php echo base_url().'users/update_permissions';?>' />
<input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'users/update_permissions/result/msg';?>' />
<input type='hidden' id='resultsdiv' name='resultsdiv' value='' />

<input name="layerid" id="layerid" type="hidden" value="" />
<input name="idlist" id="idlist" type="hidden" value="<?php echo $id_list;?>" /></td></tr>
</table>
<?php echo minify_js('users__update_permissions', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.pagination.js'));

}?>