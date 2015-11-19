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
  <select id='procurementtypes' name='procurementtypes' data-final='procurementtypes' class='drop-down' style='width:100%;'>
    <?php echo get_option_list($this, 'procurementtypes', 'select', '', array('selected'=>$this->native_session->get('procurementtypes') )); ?>
  </select>
</span></td>
  <td><span style="width:49%;padding:0px;">
    <select id='procurementmethod' name='procurementmethod' data-final='procurementmethod' class='drop-down' style='width:100%;'>
      <?php echo get_option_list($this, 'procurementmethod', 'select', '', array('selected'=>$this->native_session->get('procurementmethod') )); ?>
    </select>
  </span></td>
</tr>
<tr><td colspan="2"><select id='providers' name='procurementtypes' data-final='providers' class='drop-down' style='width:100%;'>
    <?php echo get_option_list($this, 'providers', 'select', '', array('selected'=>$this->native_session->get('providers') )); ?>
  </select></td></tr>


<tr><td colspan="2"><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('tender')" style="width:100%;">Apply Filter</button>
  <input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>
<?php echo minify_js('apply_audit_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js','pss.datepicker.js', 'pss.pagination.js'));?>
