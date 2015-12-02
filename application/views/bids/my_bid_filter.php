<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>

<tr><td><input type="text" id="search__pdes" name="search__pdes" placeholder="Search PDE Name" data-final='pde' class="drop-down searchable clear-on-empty" data-clearfield='pde_id' value="<?php echo $this->native_session->get('mybid__pde');?>" style='width:100%;'/>
<input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='<?php echo $this->native_session->get('mybid__pde_id');?>' /></td></tr>


<tr><td style='padding-right:0px;'><table class='default-table'><tr><td style='padding-left:0px;'><input type='text' id='submit_from' name='submit_from' data-final='submit_from' class='calendar clickactivated' onclick='setDatePicker(this)' placeholder='Submitted From' style="width:calc(100% - 40px);" value='<?php echo $this->native_session->get('mybid__submt_from');?>'/></td>
<td style='padding-right:0px;'><input type='text' id='submit_to' name='submit_to' class='calendar clickactivated' onclick='setDatePicker(this)' placeholder='To' style="width:calc(100% - 40px);" value='<?php echo $this->native_session->get('mybid__submt_to');?>'/></td></tr></table></td></tr>

<tr><td><select id='bid__bidstatus' name='bid__bidstatus' class='drop-down' data-final='status' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'bidstatus', 'select', '', array('selected'=>$this->native_session->get('mybid__status') ));?>
</select></td></tr>


<tr><td><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('mybid')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>
<?php echo minify_js('bids__my_bid_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.pagination.js', 'pss.datepicker.js'));?>
