<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />


<table class='normal-table'>

<tr><td><select id='search__searchsystem' name='search__searchsystem' class='drop-down' style='width:100%;'>
<?php echo get_option_list($this, 'search'.$t.$area);?>
</select></td></tr>

<tr><td><button type="button" id="selectsearcharea" name="selectsearcharea" class="btn blue" onclick="applySearch()" style="width:100%;">Search</button>
</td></tr>
</table>
<?php echo minify_js('pages__system_search', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'jquery.datepick.js', 'pss.js', 'pss.shadowbox.js', 'pss.fileform.js', 'pss.list.js'));?>
