<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>
<?php if($this->native_session->get('__user_type') != 'pde'){?>
<tr><td><input type="text" id="search__pdes" name="search__pdes" placeholder="Search PDE Name" data-final='pde' class="drop-down searchable clear-on-empty" data-clearfield='pde_id' value="<?php echo $this->native_session->get('training__pde');?>" style='width:100%;'/>
</td></tr>
<?php }?>

<tr><td><select id='search__trainingcategories' name='search__trainingcategories' data-final='category' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'trainingcategories', 'select', '', array('selected'=>$this->native_session->get('training__category')));?>
</select></td></tr>

<?php if($this->native_session->get('__user_type') == 'admin'){?>
<tr><td><select id='search__trainingstatus' name='search__trainingstatus' data-final='status' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'trainingstatus', 'select', '', array('selected'=>$this->native_session->get('training__status')));?>
</select></td></tr>
<?php }?>

<tr><td><input type='text' id='phrase' name='phrase' placeholder='Subject Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('training__phrase');?>' style='width:100%;'/></td></tr>


<tr><td><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('training')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" />
<input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='<?php echo $this->native_session->get('training__pde_id');?>' />
<?php 
if(!empty($t)){ 
	echo "<input name='search__trainingstatus' id='search__trainingstatus' data-final='status' type='hidden' value='published' />
	<input name='area' id='area' data-final='area' type='hidden' value='".$t."' />";
}?></td></tr>
</table>
<?php echo minify_js('training__list_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.datepicker.js', 'pss.pagination.js'));?>
