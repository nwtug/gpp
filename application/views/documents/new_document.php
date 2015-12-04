<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Document';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.form.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.pagination.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.datepicker.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php 
$this->load->view('addons/secure_header', array('__page'=>'Resources: Add Document' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'resources' ));
?>

<tr>
  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<?php $this->load->view('addons/resources_ribbon', array('page'=>($area == 'standard'? 'standards': 'documents') )); ?>


<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>

<table> 

<tr><td class='label'>Name</td><td><input type='text' id='name' name='name' placeholder='Enter Name' value='<?php echo (!empty($document['name'])? $document['name']: '');?>'/>
<input type='hidden' id='document_type' name='document_type' value='<?php echo $area;?>' /></td></tr>

<tr><td class='label'>Document</td><td>
<input type='text' id='document' name='document' class='filefield' data-val='pdf,doc,docx' data-size='5120000' placeholder='Select Document (PDF, Word. Max 500MB)' value=''/></td></tr>

<tr><td class='label'>Comment</td><td><textarea id='description' name='description' placeholder='Briefly describe the document (OPTIONAL, Max 500 characters)' class='limit-chars optional' data-max='500' style='height:150px;width:calc(100% - 2px);'><?php echo (!empty($document['description'])? $document['description']: '');?></textarea></td></tr>

<tr><td class='label'>Type</td><td><select id='document__publicdocumenttypes' name='document__publicdocumenttypes' class='drop-down' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'publicdocumenttypes', 'select', '', array('selected'=>(!empty($document['type'])? $document['type']: '') ));?>
</select></td></tr>

<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'documents/add/a/'.$area;?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'documents/manage/a/'.$area;?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' /></td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('documents/new_document', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.datepick.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js', 'pss.datepicker.js'));?>
</body>
</html>