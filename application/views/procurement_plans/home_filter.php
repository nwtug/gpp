<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>

<tr><td colspan="2"><span style="width:50%;padding:0px;">
  <select id='search__disposalentity' name='search__disposalentity' data-final='disposal_entity' class='drop-down' style='width:100%;'>
    <?php echo get_option_list($this, 'disposal_entity', 'select', '', array('selected'=>$this->native_session->get('tender__disposal_entity') )); ?>
  </select>
</span></td></tr>


<tr><td><span style="width:49%;padding:0px;">
  <select id='procurementplans__startyear' name='procurementplans__startyear' data-final='stratyear' class='drop-down' style='width:100%;'>
    <?php echo get_option_list($this, 'financialyears_start', 'select', '', array('selected'=>$this->native_session->get('tender_startyear') )); ?>
  </select>
</span></td>
  <td><span style="width:49%;padding:0px;">
    <select id='procurementplans__endyear' name='procurementplans__endyear' data-final='endyear' class='drop-down' style='width:100%;'>
      <?php echo get_option_list($this, 'financialyears_end', 'select', '', array('selected'=>$this->native_session->get('tender_endyear') )); ?>
    </select>
  </span></td>
</tr>

<tr><td colspan="2"><input type='text' id='phrase' name='phrase' placeholder='Name Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('tender__phrase');?>' style='width:100%;'/><input type='hidden' id='hiddenid' name='hiddenid' data-final='hiddenid' value='plans' style='width:100%;'/></td></tr>



<tr><td colspan="2"><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('tender')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>
<?php echo minify_js('apply_audit_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.pagination.js'));?>
