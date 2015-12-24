<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': Registration Requirements';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php $this->load->view('addons/public_header');

$this->load->view('addons/public_top_menu', array('__page'=>'registration_requirements'));
?>

<tr>
  <td>&nbsp;</td>
  <td style='height:calc(85vh - 214px);'>
<div class='body-title'>Registration Requirements</div>
<div class="body-content"><table>
<tr><td><table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="69%" valign="top">
To register and obtain certification as a tenderer in public procurement, your organization has to meet the following requirements: 
<br /><br />
(i)	Possess the necessary professional and technical qualifications and competence, financial resources, equipment and other physical facilities, managerial capability, reliability and reputation, experience in the procurement object, and personnel to perform a procurement contract;
<br /><br />
(ii)	Have the legal capacity to enter into a contract;
<br /><br />
(iii)	Be solvent, not be in receivership, bankrupt or in the process of being wound up and not have its business activities suspended.
<br /><br />
(iv)	Have fulfilled his/her obligations to pay taxes and social security contributions and any compensation due for damages caused to property or third party;
<br /><br />
(v)	Have Directors or Officers who have not in any country been convicted of any criminal offence relating to their professional conduct or making false statements or misrepresentations as to their qualifications to enter into a procurement contract, within a period of five years preceding the commencement of the procurement proceedings; and 
<br /><br />
(vi)	Meet such other criteria, as the Procuring Entity considers appropriate.
<br /><br />
<br /><br />
    </td>
  </tr>
</table></td></tr>
</table></div>


</td>
  <td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/public_footer');?>

</table>
<?php echo minify_js('pages__directorate', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js'));?>
</body>
</html>