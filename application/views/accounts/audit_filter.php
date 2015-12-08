<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>
<tr><td><input type='text' id='date' name='date' data-final='date' class='calendar clickactivated' onclick='setDatePicker()' placeholder='Event Date' value='<?php echo $this->native_session->get('audittrail__date');?>' style='width:100%;'/></td></tr>
<tr><td><input type="text" id="search__users" name="search__users" placeholder="Search for User" data-final='name' class="drop-down searchable clear-on-empty" data-clearfield='user_id' value="<?php echo $this->native_session->get('audittrail__name');?>" style='width:100%;'/>
<input type='hidden' name='user_id' id='user_id' data-final='user_id' value='<?php echo $this->native_session->get('audittrail__user_id');?>' /></td></tr>
<tr><td><select id='search__activitycodes' name='search__activitycodes' data-final='activity_code' class='drop-down' style='width:100%;'><?php echo get_option_list($this, 'activitycodes', 'select', '', array('selected'=>$this->native_session->get('audittrail__activity_code')));?></select></td></tr>
<tr><td><input type='text' id='phrase' name='phrase' placeholder='Details Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('audittrail__phrase');?>' style='width:100%;'/></td></tr>

<tr><td><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('audittrail')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>
<?php echo minify_js('accounts__audit_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.datepicker.js', 'pss.pagination.js'));?>
