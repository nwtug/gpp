<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />


<table class='normal-table microform ignoreclear'>

<tr><td><textarea id='details' name='details' placeholder='Details (Max 500 characters)' class='limit-chars' data-max='500' style='width:100%;height: 100px;'></textarea></td></tr>


<tr><td><button type="button" id="messagebtn" name="messagebtn" class="btn blue submitmicrobtn" style="width:100%;">Submit</button>
<input type='hidden' id='action' name='action' value='<?php echo base_url().'forums/add_comment';?>' />
<input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'forums/add_comment/a/confirm';?>' />
<input type='hidden' id='resultsdiv' name='resultsdiv' value='' />

<input name="layerid" id="layerid" type="hidden" value="" />
<input name="forumid" id="forumid" type="hidden" value="<?php echo $d;?>" />
<input name="respondingto" id="respondingto" type="hidden" value="<?php echo (!empty($r)? $r: '');?>" /></td></tr>
</table>
<?php echo minify_js('forums__add_comment', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.pagination.js'));?>
