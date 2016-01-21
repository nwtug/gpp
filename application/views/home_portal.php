<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Procurement Portal for Southern Sudan';?></title>
    
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

$this->load->view('addons/public_top_menu', array('__page'=>'home_portal'));
?>



<tr>
  <td>&nbsp;</td>
  <td class='two-columns multiple' style='height:calc(85vh - 255px); padding-bottom: 20px;'>



<div><table class='home-list-table'>
<tr><th class='h3 blue tender-icon'>Tender Notices</th></tr>
<tr><td>
<table class='list-tabs' data-type='paginationdiv__procurement_plan' data-page='tenders/tender_list'><tr>
<td id='procurement_plans' data-final='procurement_plan' class='active'>Procurement Plans</td>
<td id='active_notices' data-final='tender'>Active Notices</td>
<td id='best_evaluated_bidders' data-final='bid'>Best Evaluated Bidders</td>
<td id='contract_awards' data-final='contract'>Contract Awards</td>
</tr></table>
</td></tr>

<tr><td style="vertical-align:top;"><div id='paginationdiv__procurement_plan_list' class='home-list-div'>
<div id='procurement_plan__1'><?php $this->load->view('procurement_plans/details_list',array('area'=>'procurement_plans','list'=>$procurementPlanList));?></div>
</div>
<button type='button' id='refreshlist' name='refreshlist' style='display:none;'></button>

<input name="paginationdiv__tender_action" id="paginationdiv__tender_action" type="hidden" value="<?php echo base_url()."lists/load/t/tender/area/active_notices";?>" />
<input name="paginationdiv__contract_action" id="paginationdiv__contract_action" type="hidden" value="<?php echo base_url()."lists/load/t/contract/area/contract_awards";?>" />
<input name="paginationdiv__bid_action" id="paginationdiv__bid_action" type="hidden" value="<?php echo base_url()."lists/load/t/bid/listtype/best_bidders/area/best_evaluated_bidders";?>" />
<input name="paginationdiv__procurement_plan_action" id="paginationdiv__procurement_plan_action" type="hidden" value="<?php echo base_url()."lists/load/t/procurement_plan/area/procurement_plans";?>" /></td></tr>
<tr><td>


<table><tr><td class='h6' width='98%'>Last Updated: <span class='dark-grey'><?php echo !empty($procurementPlanLatestDate)? date(SHORT_DATE_FORMAT, strtotime($procurementPlanLatestDate)): 'NONE';?></span></td><td width='1%' class='filter-list shadowbox closable' data-url='<?php echo base_url().'tenders/home_filter/t/procurement_plans';?>'>FILTER</td><td width='1%' class='btn load-more' data-rel='tenders/index/a/procurement_plans'>MORE</td></tr></table>
</td></tr>
</table></div>




<div><table class='home-list-table'>
<tr><th class='h3 blue rop-icon'>Register of Providers</th></tr>
<tr><td>
<table class='list-tabs' data-type='paginationdiv__provider' data-page='providers/provider_list'><tr>
<td id='active_providers' data-final='provider' class='active'>Active Providers</td>
<td id='suspended_providers' data-final='provider'>Suspended Providers</td>
</tr></table>
</td></tr>
<tr><td><div id='paginationdiv__provider_list' class='home-list-div'>
<div id='provider__1'><?php $this->load->view('providers/details_list',array('area'=>'active_providers','list'=>$activeProviderList));?></div>
</div>
<button type='button' id='refreshlist' name='refreshlist' style='display:none;'></button>

<input name="paginationdiv__provider_action" id="paginationdiv__provider_action" type="hidden" value="<?php echo base_url()."lists/load/t/active_providers";?>" />

</td></tr>
<tr><td>

<table><tr><td class='h6' width='98%'>Last Updated: <span class='dark-grey'><?php echo !empty($activeProviderLatestDate)? date(SHORT_DATE_FORMAT, strtotime($activeProviderLatestDate)): 'NONE';?></span></td><td width='1%' class='filter-list shadowbox closable' data-url='<?php echo base_url().'providers/home_filter/t/active_providers';?>'>FILTER</td><td width='1%' class='btn load-more' data-rel='providers/index/a/active_providers' >MORE</td></tr></table>

</td></tr>
</table></div>




<div><table class='home-list-table'>
<tr><th class='h3 blue resources-icon'>Resources</th></tr>
<tr><td>
<table class='list-tabs' data-type='paginationdiv__document' data-page='documents/document_list'><tr>
<td id='documents' data-final='document' class='active'>Documents</td>
<td id='important_links' data-final='link'>Important Links</td>
<td id='standards' data-final='document'>Standards</td>
<td id='training_activities' data-final='training'>Training Activities</td>
</tr></table>
</td></tr>
<tr><td style="vertical-align:top;"><div id='document_list' class='home-list-div'>
<div id='document__1'><?php $this->load->view('documents/details_list',array('area'=>'documents','list'=>$documentList));?></div>
</div>
<button type='button' id='refreshlist' name='refreshlist' style='display:none;'></button>

<input name="paginationdiv__document_action" id="paginationdiv__document_action" type="hidden" value="<?php echo base_url()."lists/load/t/documents";?>" />
<input name="paginationdiv__link_action" id="paginationdiv__link_action" type="hidden" value="<?php echo base_url()."lists/load/t/link/area/important_links";?>" />
<input name="paginationdiv__training_action" id="paginationdiv__training_action" type="hidden" value="<?php echo base_url()."lists/load/t/training/area/training_activities";?>" />
</td></tr>
<tr><td>

<table><tr><td class='h6' width='98%'>Last Updated: <span class='dark-grey'><?php echo !empty($documentLatestDate)? date(SHORT_DATE_FORMAT, strtotime($documentLatestDate)): 'NONE';?></span></td><td width='1%' class='filter-list shadowbox closable' data-url='<?php echo base_url().'documents/home_filter/t/documents';?>'>FILTER</td><td width='1%' class='btn load-more'  data-rel='documents/index/a/documents'>MORE</td></tr></table>
</td></tr>
</table></div>




<div><table class='home-list-table'>
<tr><th class='h3 blue forums-icon'>Forums</th></tr>
<tr><td>
<table class='list-tabs' data-type='paginationdiv__forum' data-page='forums/forum_list'><tr>
<td id='public_forums' data-final='forum' class='active'>Public</td>
<td id='secure_forums' data-final='forum'>Secure</td>
<td id='frequently_asked_questions' data-final='faq'>Frequently Asked Questions</td>
</tr></table>
</td></tr>
<tr><td style="vertical-align:top;"><div id='forum_list' class='home-list-div'>
<div id='forum__1'><?php $this->load->view('forums/details_list',array('area'=>'public_forums', 'list'=>$publicForumList));?></div>
</div><button type='button' id='refreshlist' name='refreshlist' style='display:none;'></button>

<input name="paginationdiv__forum_action" id="paginationdiv__forum_action" type="hidden" value="<?php echo base_url()."lists/load/t/public_forums";?>" />
<input name="paginationdiv__faq_action" id="paginationdiv__faq_action" type="hidden" value="<?php echo base_url()."lists/load/t/faq/area/frequently_asked_questions";?>" />
</td></tr>
<tr><td>

        

        
<table><tr><td class='h6' width='98%'>Last Updated: <span class='dark-grey'><?php echo !empty($publicForumLatestDate)? date(SHORT_DATE_FORMAT, strtotime($publicForumLatestDate)): 'NONE';?></span></td><td width='1%' class='filter-list shadowbox closable' data-url='<?php echo base_url().'forums/home_filter/t/public_forums';?>'>FILTER</td><td width='1%' class='btn load-more'  data-rel='forums/index/a/public_forums'>MORE</td></tr></table>

</td></tr>
</table></div>

</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/public_footer');?>

</table>

<?php echo minify_js('home_portal', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.list.js', 'pss.pagination.js'));?>
<script>
$(function() {	
	resizeHomeTables();
	$(window).resize(function() { resizeHomeTables(); });
});

function resizeHomeTables(){
	var listTable = $(document).find('.home-list-table').first();
	$('.home-list-table').height(listTable.height());
	$('.home-list-div').width(listTable.width());
}
</script>
</body>
</html>