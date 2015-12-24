<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>
<?php if($this->native_session->get('__user_type') != 'pde'){?>
<tr><td><input type="text" id="search__pdes" name="search__pdes" placeholder="Search PDE Name" data-final='pde' class="drop-down searchable clear-on-empty" data-clearfield='pde_id' value="<?php echo $this->native_session->get('link__pde');?>" style='width:100%;'/>
</td></tr>
<?php }?>

<tr><td><select id='search__opentypes' name='search__opentypes' data-final='opentype' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'opentypes', 'select', '', array('selected'=>$this->native_session->get('link__opentype')));?>
</select></td></tr>

<?php if($this->native_session->get('__user_type') == 'admin'){?>
<tr><td><select id='search__linkstatus' name='search__linkstatus' data-final='status' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'linkstatus', 'select', '', array('selected'=>$this->native_session->get('link__status')));?>
</select></td></tr>
<?php }?>

<tr><td><input type='text' id='phrase' name='phrase' placeholder='Link Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('link__phrase');?>' style='width:100%;'/></td></tr>


<tr><td><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('link')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" />
<input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='<?php echo $this->native_session->get('link__pde_id');?>' />

<?php 
if(!($this->native_session->get('__user_type') && $this->native_session->get('__user_type') == 'admin')){
	echo "<input type='hidden'  id='search__linkstatus'  name='search__linkstatus' data-final='status' value='published' />";
}
if(!empty($t)){ 
	echo "<input name='area' id='area' data-final='area' type='hidden' value='".$t."' />";
}?></td></tr>
</table>
<?php echo minify_js('links__list_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.datepicker.js', 'pss.pagination.js'));?>
