<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />


<table class='normal-table filter-container'>

<tr><td><select id='search__forumcategories' name='search__forumcategories' data-final='category' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'forumcategories', 'select', '', array('selected'=>$this->native_session->get('forum__category')));?>
</select></td></tr>

<?php if($this->native_session->get('__user_id')){?>
<tr><td><select id='search__forumaccess' name='search__forumaccess' data-final='is_public' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'forumaccess', 'select', '', array('selected'=>$this->native_session->get('forum__is_public')));?>
</select></td></tr>
<?php }?>

<?php if($this->native_session->get('__user_type') == 'admin'){?>
<tr><td><select id='search__forumstatus' name='search__forumstatus' data-final='status' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'forumstatus', 'select', '', array('selected'=>$this->native_session->get('forum__status')));?>
</select></td></tr>
<?php }?>

<tr><td><input type='text' id='phrase' name='phrase' placeholder='Topic Search Phrase' data-final='phrase' value='<?php echo $this->native_session->get('forum__phrase');?>' style='width:100%;'/></td></tr>


<tr><td><button type="button" id="applyfilterbtn" name="applyfilterbtn" class="btn blue" onClick="applyFilter('forum')" style="width:100%;">Apply Filter</button>
<input name="layerid" id="layerid" type="hidden" value="" /></td></tr>
</table>
<?php echo minify_js('forums__list_filter', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.datepicker.js', 'pss.pagination.js'));?>
