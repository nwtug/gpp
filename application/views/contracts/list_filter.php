<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>

<?php if($this->native_session->get('__user_type') != 'pde'){?>
<tr><td><input type="text" id="search__pdes" name="search__pdes" placeholder="Search PDE Name" data-final='pde' class="drop-down searchable clear-on-empty" data-clearfield='pde_id' value="<?php echo $this->native_session->get('contract__pde');?>" style='width:100%;'/>
<input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='<?php echo $this->native_session->get('contract__pde_id');?>' /></td></tr>
<?php }?>

<tr><td><input type="text" id="search__tenders" name="search__tenders" placeholder="Search Tender Name" data-final='tender' class="drop-down searchable clear-on-empty" data-clearfield='tender_id' value="<?php echo $this->native_session->get('contract__tender');?>" style='width:100%;'/>
<input type='hidden' name='tender_id' id='tender_id' data-final='tender_id' value='<?php echo $this->native_session->get('contract__tender_id');?>' /></td></tr>

<tr><td><input type='text' id='phrase' name='phrase' placeholder='Name Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('contract__phrase');?>' style='width:100%;'/></td></tr>

<tr><td><select id='search__contractstatus' name='search__contractstatus' data-final='status' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'contractstatus', 'select', '', array('selected'=>$this->native_session->get('contract__status')));?>
</select></td></tr>

<tr><td><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('contract')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>

<?php echo minify_js('contracts__list_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.datepicker.js', 'pss.pagination.js'));?>

