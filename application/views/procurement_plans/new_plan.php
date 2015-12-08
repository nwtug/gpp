<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': New Procurement Plan';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.form.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.pagination.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php 
$this->load->view('addons/secure_header', array('__page'=>'Procurement: Add Plan' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'procurement' ));
?>

<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<?php $this->load->view('addons/procurement_ribbon', array('page'=>'procurement_plans')); ?>

<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>

<table> 

<?php if($this->native_session->get('__user_type') == 'admin'){ ?>
<tr><td class='label long'>Procurement/Disposal Entity</td><td><input type="text" id="search__pdes" name="search__pdes" placeholder="Search PDE Name" class="drop-down searchable clear-on-empty" data-clearfield='pde_id' value="<?php echo (!empty($plan['pde'])? $plan['pde']: '');?>"/>
</td></tr>
<?php }?>

<tr><td class='label'>Plan Name</td><td><input type='text' id='name' name='name' placeholder='Plan Name' value='<?php echo (!empty($plan['name'])? $plan['name']: '');?>'/></td></tr>

<tr><td class='label'>Financial Period</td><td style='padding-right:0px;'>
<table class='default-table'><tr><td style='padding-left:0px;'><select id='fy_start__pastyears' name='fy_start__pastyears' class='drop-down'>
<?php echo get_option_list($this, 'pastyears', 'select', '', array(
	'selected'=>(!empty($plan['fy_start'])? $plan['fy_start']: ''),
	'default'=>'From Year',
	'back_period'=>10
	));?>
</select></td>
<td style='padding-right:0px;'><select id='fy_end__pastyears' name='fy_end__pastyears' class='drop-down'>
<?php echo get_option_list($this, 'pastyears', 'select', '', array(
	'selected'=>(!empty($plan['fy_end'])? $plan['fy_end']: ''),
	'default'=>'To Year',
	'back_period'=>10,
	'start'=>(@date('Y') + 2)
	));?> 
</select></td></tr></table>
</td></tr>

<tr><td class='label'>Summary</td><td><textarea id='summary' name='summary' placeholder='A brief description of the procurement plan (Max 500 characters)' class='limit-chars' data-max='500' style='height: 150px;'><?php echo (!empty($plan['summary'])? $plan['summary']: '');?></textarea></td></tr>

<tr><td class='label'>Document</td><td><input type='text' id='document' name='document' class='filefield' data-val='pdf,doc,docx' data-size='5120000' placeholder='Attach Plan Document (PDF, Word. Max 500MB)' value='<?php echo (!empty($plan['document'])? $plan['document']: '');?>'/></td></tr>

<tr><td class='label'>Status</td><td><select id='status__procurementplanstatus' name='status__procurementplanstatus' class='drop-down' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'procurementplanstatus', 'select', '', array('selected'=>(!empty($plan['status'])? $plan['status']: '') ));?>
</select></td></tr>

<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'procurement_plans/add';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'procurement_plans/manage';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' />
    <input type='hidden' name='pde_id' id='pde_id' data-final='pde_id' value='<?php echo (!empty($plan['pde_id'])? $plan['pde_id']: ($this->native_session->get('__user_type') == 'pde'? $this->native_session->get('__organization_id'): ''));?>' /></td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('procurement_plans__new_plan', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js'));?>
</body>
</html>