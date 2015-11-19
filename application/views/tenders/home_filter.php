<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />

<table class='normal-table filter-container'>

<tr><td colspan="2"><span style="width:50%;padding:0px;">
  <select id='category__disposalentity' name='category__disposalentity' data-final='category' class='drop-down' style='width:100%;' onchange="toggleEmpty('entity__disposalentity','category__disposalentity')">
    <?php echo get_option_list($this, 'disposal_entity', 'select', '', array('selected'=>$this->native_session->get('procurementplan__category') )); ?>
  </select>
</span></td></tr>

<tr><td><span style="width:49%;padding:0px;">
  <select id='procurement_type' name='procurement_type' data-final='procurement_type' class='drop-down' style='width:100%;'>
    <?php echo get_option_list($this, 'procurementtypes', 'select', '', array('selected'=>$this->native_session->get('procurementtypes') )); ?>
  </select>
</span></td>
  <td><span style="width:49%;padding:0px;">
    <select id='procurement_method' name='procurement_method' data-final='procurement_method' class='drop-down' style='width:100%;'>
      <?php echo get_option_list($this, 'procurementmethod', 'select', '', array('selected'=>$this->native_session->get('procurementmethod') )); ?>
    </select>
  </span></td>
</tr>
<tr><td colspan="2"><input type='text' id='date' name='date' data-final='date' class='calendar clickactivated' onclick='setDatePicker()' placeholder='By Deadline' value='<?php echo $this->native_session->get('activenotices__date');?>' style='width:100%;'/></td></tr>
<tr><td colspan="2"><input type='text' id='phrase' name='phrase' placeholder='Name Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('tender__phrase');?>' style='width:100%;'/><input type='hidden' id='hiddenid' name='hiddenid' data-final='hiddenid' value='activenotices' style='width:100%;'/></td></tr>


<tr><td colspan="2"><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('tender')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>
<?php echo minify_js('apply_audit_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js','pss.datepicker.js', 'pss.pagination.js'));?>
