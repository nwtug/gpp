<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />



<table class='normal-table filter-container'>

<tr><td><input type="text" id="search__pdes" name="search__pdes" placeholder="Search PDE Name" data-final='pde' class="drop-down searchable clear-on-empty" data-clearfield='pde_id' value="<?php echo $this->native_session->get('bid__pde');?>" style='width:100%;'/>
<input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='<?php echo $this->native_session->get('bid__pde_id');?>' /></td></tr>

<tr><td><input type="text" id="search__providers" name="search__providers" placeholder="Search Provider Name" data-final='provider' class="drop-down searchable clear-on-empty" data-clearfield='provider_id' value="<?php echo $this->native_session->get('bid__provider');?>" style='width:100%;'/>
<input type='hidden' name='provider_id' id='provider_id' data-final='provider_id' value='<?php echo $this->native_session->get('bid__provider_id');?>' /></td></tr>

<tr><td><input type='text' id='phrase' name='phrase' placeholder='Name Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('bid__phrase');?>' style='width:100%;'/></td></tr>


<tr><td><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('bid')" style="width:100%;">Apply Filter</button>
<input name="listtype" id="listtype" data-final='listtype' type="hidden" value="<?php echo $listtype;?>" /> 
<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>

<?php echo minify_js('bids__list_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.pagination.js'));?>

