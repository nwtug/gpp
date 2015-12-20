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

<tr><td class='label'>Title</td><td><input type='text' id='name' name='name' placeholder='Title' value='<?php echo (!empty($plan['name'])? $plan['name']: '');?>'/></td></tr>

<tr><td class='label'>Financial Period</td><td><select id='fystart__financialperiods' name='fystart__financialperiods' class='drop-down' style="width:calc(100% + 18px)">
<?php echo get_option_list($this, 'financialperiods', 'select', '', array(
	'selected'=>(!empty($plan['financial_year'])? $plan['financial_year']: ''), 'back_period'=>10));?>
</select>
</td></tr>


<tr><td class='label'>Details</td><td style='padding-right:0px;'>
<table class='default-table'>
<tr>
<td style='padding-left:0px;'><input type='text' id='plantemplate' name='plantemplate' class='filefield' data-val='xls' data-size='5120000' placeholder='Attach Filled Plan Template' value=''/></td>
<td style='padding-left:20px;width:1%;'><button type="button" id="applyplantemplate" name="applyplantemplate" class="smallbtn blue" style='min-width:90px; width:90px;height:38px;'>Apply</button></td>
<td style='width:1%;vertical-align:bottom;'><a href='<?php echo base_url().'procurement_plans/template';?>' style='font-weight:bold;'>Download<br />Template</a></td>
</tr>
<tr>
<td style='padding-left:0px;' colspan='3' class='h5 bold'>CAUTION: Clicking Apply overwrites the procurement plan for the PDE financial period.
</td>
</tr>
<tr>
<td style='padding-left:0px;' colspan='3'>
	<div id='plan_details_div' style="display:block; position:absolute; max-width:calc(100% - 250px); max-height: 500px; overflow-x:auto;overflow-y:auto;"><?php 
	if(!empty($plan['list'])) {
		$this->load->view('procurement_plans/plan_details', array('list'=>$plan['list']));
	} ?></div>
    <div id='plan_details_div_show' style="display:none"><a href='javascript:;' onclick="showLayerSet('plan_details_div');hideLayerSet('plan_details_div_show')">Show Details</a></div>
    
    <a href="javascript:updateFieldLayer('<?php echo BASE_URL.'procurement_plans/view_details/d/'.$this->native_session->get('plan_id');?>','','','plan_details_div','')" id='refreshlist'></a>
</td>
</tr>
</table>
</td></tr>


<tr><td class='label'>Status</td><td><select id='status__procurementplanstatus' name='status__procurementplanstatus' class='drop-down' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'procurementplanstatus', 'select', '', array('selected'=>(!empty($plan['status'])? $plan['status']: '') ));?>
</select></td></tr>

<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="confirmplanstatus" name="confirmplanstatus" class="btn green" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'procurement_plans/add';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'procurement_plans/manage';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' />
    
    <input type='hidden' name='plan_id' id='plan_id' value='<?php echo (!empty($plan['procurement_plan_id'])? $plan['procurement_plan_id']: '');?>' />
    <input type='hidden' name='pde_id' id='pde_id' value='<?php echo (!empty($plan['pde_id'])? $plan['pde_id']: ($this->native_session->get('__user_type') == 'pde'? $this->native_session->get('__organization_id'): ''));?>' />
    </td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('home', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.procurement.js'));?>
</body>
</html>