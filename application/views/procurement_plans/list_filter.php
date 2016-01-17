<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>

<tr><td><input type="text" id="search__pdes" name="search__pdes" placeholder="Search PDE Name" data-final='pde' class="drop-down searchable clear-on-empty" data-clearfield='pde_id' value="<?php echo $this->native_session->get('procurement_plan__pde');?>" style='width:100%;'/>
<input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='<?php echo $this->native_session->get('procurement_plan__pde_id');?>' /></td></tr>

<?php if(empty($t)){?>
<tr><td><select id='search__procurementplanstatus' name='search__procurementplanstatus' data-final='status' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'procurementplanstatus', 'select', '', array('selected'=>$this->native_session->get('tender__status')));?>
</select></td></tr>
<?php }?>

<tr><td><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('procurement_plan')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" />
<?php 
if(!empty($t)){ 
	echo "<input name='search__procurementplanstatus' id='search__procurementplanstatus' data-final='status' type='hidden' value='published' />
	<input name='area' id='area' data-final='area' type='hidden' value='".$t."' />";
}?></td></tr>
</table>
<?php echo minify_js('procurement__list_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.pagination.js'));?>
