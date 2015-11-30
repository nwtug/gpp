<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Forums';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.form.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.pagination.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php 
$this->load->view('addons/secure_header', array('__page'=>'Forums' ));
$this->load->view('addons/'.$this->native_session->get('__user_type').'_top_menu', array('__page'=>'forums' ));
?>

<tr>
  <td>&nbsp;</td>
  <td class='one-column body-form-area microform ignoreclear'>

<table> 

<tr><td class='label'>Topic</td><td><input type='text' id='topic' name='topic' placeholder='Enter Topic' value='<?php echo (!empty($forum['topic'])? $forum['topic']: '');?>'/></td></tr>

<tr><td class='label'>Details</td><td><textarea id='details' name='details' placeholder='Briefly explain details about this topic to your intended audience (Max 1,000 characters)' class='limit-chars' data-max='1000' style='height: 150px;'><?php echo (!empty($forum['details'])? $forum['details']: '');?></textarea></td></tr>

<tr><td class='label'>Attachment (Optional)</td><td><input type='text' id='document' name='document' class='filefield optional' data-val='pdf,doc,docx,jpeg,jpg,png,tiff' data-size='500000' placeholder='Attach (OPTIONAL: PDF, Word, JPEG, JPG, PNG, TIFF. Max 500MB)' value='<?php echo (!empty($forum['document'])? $forum['document']: '');?>'/></td></tr>


<tr><td class='label'>Category</td><td><select id='forum__forumcategories' name='forum__forumcategories' class='drop-down' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'forumcategories', 'select', '', array('selected'=>(!empty($forum['category'])? $forum['category']: '') ));?>
</select></td></tr>

<tr><td class='label'>Access</td><td><select id='forum__forumaccess' name='forum__forumaccess' class='drop-down' style="width:calc(100% + 15px);">
<?php echo get_option_list($this, 'forumaccess', 'select', '', array('selected'=>(!empty($forum['is_public'])? $forum['is_public']: '') ));?>
</select></td></tr>

<tr><td class='label'>Moderator</td><td><input type='text' id='moderator__users' name='moderator__users' class="drop-down searchable clear-on-empty" data-clearfield='user_id' placeholder='Search Moderator Name' value='<?php echo (!empty($forum['moderator'])? $forum['moderator']: $this->native_session->get('__first_name').' '.$this->native_session->get('__last_name'));?>'/>
<input type='hidden' id='user_id' name='user_id' value='<?php echo (!empty($forum['moderator_id'])? $forum['moderator_id']: $this->native_session->get('__user_id'));?>' /></td></tr>


<tr><td>&nbsp;</td><td style="text-align:right; padding-right:0px;padding-top:30px; padding-bottom:20px;"><button type="button" id="save" name="save" class="btn green submitmicrobtn" style='width: calc(100% + 10px);'>Save</button>
    <input type='hidden' id='action' name='action' value='<?php echo base_url().'forums/add';?>' />
    <input type='hidden' id='redirectaction' name='redirectaction' value='<?php echo base_url().'forums/manage';?>' />
    <input type='hidden' id='resultsdiv' name='resultsdiv' value='' /></td></tr>
</table>







</td>
<td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/secure_footer');?>

</table>
<?php echo minify_js('forums__new_forum', array('jquery-2.1.1.min.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js', 'pss.pagination.js', 'pss.fileform.js', 'pss.list.js'));?>
</body>
</html>