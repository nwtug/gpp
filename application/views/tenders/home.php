<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Tender Notices';?></title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.pagination.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php
$this->load->view('addons/public_header');

$this->load->view('addons/public_top_menu', array('__page'=>'tenders'));
?>



<tr>
  <td>&nbsp;</td>
  <td class='one-column' style='height:calc(85vh - 255px); padding-bottom: 20px;'>

<table class='home-list-table'>
<tr><th class='h3 blue rop-icon'>Tender Notices</th><th class='btn closer' data-rel='pages/portal'></th></tr>
<tr><td colspan='2'>
<table class='list-tabs' data-type='paginationdiv__tender' data-page='tenders/tender_list'><tr>
<td id='procurement_plans' data-final='procurement_plan' <?php if($area == 'procurement_plans') echo "class='active'";?>>Procurement Plans</td>
<td id='active_notices' data-final='tender' <?php if($area == 'active_notices') echo "class='active'";?>>Active Notices</td>
<td id='best_evaluated_bidders' data-final='bid' <?php if($area == 'best_evaluated_bidders') echo "class='active'";?>>Best Evaluated Bidders</td>
<td id='contract_awards' data-final='contract' <?php if($area == 'contract_awards') echo "class='active'";?>>Contract Awards</td>
</tr></table>
</td></tr>
<tr><td colspan='2'><div id='paginationdiv__tender_list' class='page-list-div'>
<div id="<?php echo rtrim($folder,'s');?>__1">
<?php $this->load->view($folder.'/details_list',array('list'=>$list));?>
</div>
</div><button type='button' id='refreshlist' name='refreshlist' class='override-url' style='display:none;'></button></td></tr>
<tr><td colspan='2'>
<table><tr><td>

<div id='tender_pagination_div' class='pagination' style="margin:0px;padding:0px; display:inline-block;"><div id="<?php echo rtrim($folder,'s');?>" class="paginationdiv no-scroll"><div class="previousbtn" style='display:none;'>&#x25c4;</div><div class="selected">1</div><div class="nextbtn">&#x25ba;</div></div><input name="paginationdiv__tender_action" id="paginationdiv__tender_action" type="hidden" value="<?php echo base_url()."lists/load/t/tender/area/".$area;?>" />
<input name="paginationdiv__tender_maxpages" id="paginationdiv__tender_maxpages" type="hidden" value="<?php echo NUM_OF_LISTS_PER_VIEW;?>" />
<input name="paginationdiv__tender_noperlist" id="paginationdiv__tender_noperlist" type="hidden" value="<?php echo NUM_OF_ROWS_PER_PAGE;?>" />
<input name="paginationdiv__tender_showdiv" id="paginationdiv__tender_showdiv" type="hidden" value="paginationdiv__tender_list" />
<input name="paginationdiv__tender_extrafields" id="paginationdiv__tender_extrafields" type="hidden" value="" />

<!-- Additional list actions -->
<input name="paginationdiv__contract_action" id="paginationdiv__contract_action" type="hidden" value="<?php echo base_url()."lists/load/t/contract/area/".$area;?>" />
<input name="paginationdiv__bid_action" id="paginationdiv__bid_action" type="hidden" value="<?php echo base_url()."lists/load/t/bid/listtype/best_bidders/area/".$area;?>" />
<input name="paginationdiv__procurement_plan_action" id="paginationdiv__procurement_plan_action" type="hidden" value="<?php echo base_url()."lists/load/t/procurement_plan/area/".$area;?>" />
</div>


</td><td width='1%' class='filter-list shadowbox closable' data-url='<?php echo base_url().'tenders/home_filter/t/'.$area;?>'>FILTER</td></tr></table>
</td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/public_footer');?>

</table>
<?php echo minify_js('tenders__home', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.list.js', 'pss.pagination.js'));?>

<?php if(!empty($action)){ ?>
<script>
$(function() { 
	$(document).find('.filter-list').last().click(); 
});
</script>
<?php }?>
</body>
</html>