<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
    <title><?php echo SITE_TITLE.': Register of Providers';?></title>

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

    $this->load->view('addons/public_top_menu', array('__page'=>'providers'));
    ?>



    <tr>
        <td>&nbsp;</td>
        <td class='one-column' style='height:calc(85vh - 255px); padding-bottom: 20px;'>

            <table class='home-list-table'>
                <tr><th class='h3 blue rop-icon'>Registry of Providers</th><th class='btn closer' data-rel='page/portal'></th></tr>
                <tr><td colspan='2'>
                        <table class='list-tabs' data-type='paginationdiv__provider' data-page='providers/provider_list'><tr>


                                <td id='active_providers' <?php if(empty($area) || !empty($area) &&  $area == 'active_providers') echo "class='active'";?>>Active Providers</td>


                                <td id='suspended_providers' <?php if(!empty($area) && $area == 'suspended_providers') echo "class='active'";?>>Suspended Providers</td>
                            </tr></table>
                    </td></tr>
                <tr><td colspan='2'><div id='paginationdiv__provider_list' class='page-list-div'>
  <?php $this->load->view('providers/details_list',array('type'=>(!empty($area)? $area:'active_providers'),'list'=>$activeProvidersList));?> 
							
                        </div><button type='button' id='refreshlist' name='refreshlist' style='display:none;'></button></td></tr>
                <tr><td colspan='2'>
                        <table><tr><td>

                                    <div id='provider_pagination_div' class='pagination' style="margin:0px;padding:0px; display:inline-block;"><div id="provider" class="paginationdiv no-scroll"><div class="previousbtn" style='display:none;'>&#x25c4;</div><div class="selected">1</div><div class="nextbtn">&#x25ba;</div></div><input name="paginationdiv__provider_action" id="paginationdiv__provider_action" type="hidden" value="<?php echo base_url()."lists/load/t/provider";?>" />
                                        <input name="paginationdiv__provider_maxpages" id="paginationdiv__provider_maxpages" type="hidden" value="<?php echo NUM_OF_LISTS_PER_VIEW;?>" />
                                        <input name="paginationdiv__provider_noperlist" id="paginationdiv__provider_noperlist" type="hidden" value="<?php echo NUM_OF_ROWS_PER_PAGE;?>" />
                                        <input name="paginationdiv__provider_showdiv" id="paginationdiv__provider_showdiv" type="hidden" value="paginationdiv__provider_list" />
                                        <input name="paginationdiv__provider_extrafields" id="paginationdiv__provider_extrafields" type="hidden" value="" /></div>


                                </td><td width='1%' class='filter-list shadowbox closable' data-url='<?php echo base_url().'providers/home_filter/t/active_providers';?>'>FILTER</td></tr></table>
                    </td></tr>
            </table>







        </td>
        <td>&nbsp;</td>
    </tr>

    <?php $this->load->view('addons/public_footer');?>

</table>

<?php echo minify_js('providers__home', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.list.js', 'pss.pagination.js'));?>

</body>
</html>