<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>

<tr><td colspan="2"><span style="width:50%;padding:0px;">
  <input type="text" id="search__pdes" name="search__pdes" placeholder="Search PDE Name" data-final='pde' class="drop-down searchable clear-on-empty" data-clearfield='pde_id' value="<?php echo $this->native_session->get('tender__pde');?>" style='width:100%;'/>
  <input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='<?php echo $this->native_session->get('tender__pde_id');?>' />
</span></td></tr>


<tr><td><span style="width:99%;padding:0px;">
 <select id='fy_start__pastyears' name='startpastyears'  data-final='fy_start' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'pastyears', 'select', '', array(	'selected'=>$this->native_session->get('tender__fy_start'),	'default'=>'From Year',	'back_period'=>10	));?>
</select>
</span></td>
  <td><span style="width:99%;padding:0px;">
   <select id='fy_end__pastyears' name='endpastyears' data-final='fy_end' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'pastyears', 'select', '', array('selected'=>$this->native_session->get('tender__fy_end'),	'default'=>'To Year',	'back_period'=>10,	'start'=>(@date('Y') + 2)
	));?> 
</select>
  </span></td>
</tr>

<tr><td colspan="2"><input type='text' id='phrase' name='phrase' placeholder='Name Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('tender__phrase');?>' style='width:100%;'/><input type='hidden' id='parentarea' name='parentarea' data-final='parentarea' value='plans_home' style='width:100%;'/></td></tr>



<tr><td colspan="2"><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('tender')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>
<?php echo minify_js('procurement_plans__home_portal_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.pagination.js'));?>
