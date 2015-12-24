<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>

<tr><td><input type='text' id='phrase' name='phrase' placeholder='Question Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('faq__phrase');?>' style='width:100%;'/></td></tr>

<tr><td><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('faq')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" />
<?php if(!empty($t)){ 
	echo "<input name='area' id='area' data-final='area' type='hidden' value='".$t."' />";
}?></td></tr>
</table>
<?php echo minify_js('faqs__list_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.pagination.js'));?>
