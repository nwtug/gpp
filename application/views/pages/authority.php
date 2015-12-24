<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': The Public Procurement Authority';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php $this->load->view('addons/public_header');

$this->load->view('addons/public_top_menu', array('__page'=>'directorate'));
?>

<tr>
  <td>&nbsp;</td>
  <td style='height:calc(85vh - 214px);'>
<div class='body-title'>The Public Procurement Authority</div>
<div class="body-content"><table>
<tr><td><table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="69%" valign="top">
The Procurement Policy Unit (PPU) follows the INTERIM PUBLIC PROCUREMENT AND DISPOSAL REGULATIONS whose purpose is to lay down procedures that would be followed by all Procuring Entities in processing public contracts and ensure that: 
<br /><br />
(I).	Public procurement is conducted in a transparent and efficient manner so as to achieve value for money;
<br /><br />
(II).	Contracts are awarded in a structured and collective manner and not in a discretionary manner;
<br /><br />
(III).	All eligible tenders are given equal opportunity to provide goods, works and services via public contracts;
<br /><br />
(IV).	Public contracts are awarded in accordance with requirements of  procuring entity (budget holders) and allocated budget;
<br /><br />
(V).	Public procurement is monitored and action taken against public officials on the one part, and on the other part, suppliers and contractors and consultants that do not comply with these public procurement regulations; 
<br /><br />
(VI).	Any stakeholder , including civil society and private sector, not satisfied with the way public procurement is conducted and/or contracts are awarded and managed can appeal for redress;  
<br /><br />
(VII).	Public confidence in the Government is enhanced; and
<br /><br />
(VIII).	Public stores and equipment are disposed off in a transparent and rational manner. 
<br /><br />
The main goal of the Public Procurement Reform is to put in place a comprehensive public procurement legislation that would, in addition to meeting the above objectives, include but not limited to public procurement policy, oversight, decentralization, institutional and organizational arrangements, mechanisms for dealing with complaints and appeals, capacity building and training and review processes. Future procurement legislation will be consistent with international standards and will provide for adequate public disclosure to enable the civil society and private sector fully participate in all aspects of public procurement. Such legislation will increase the confidence of foreign investors and enable Donors accept use of Southern Sudan public procurement systems. These INTERIM PUBLIC PROCUREMENT AND DISPOSAL REGULATIONS are a forerunner of such future legislation. 
<br /><br />
(3).   In order to enhance the principles of economy, transparency and equal opportunity to tenders, all the contracts should, to the extent possible, be awarded on the basis of competition. The preferred procurement method will be “Open Competitive Tendering” for goods and works and “Quality and Cost Based Selection” for consultancy services.
<br /><br />
(4).   All Procurement will be processed by the Procurement Unit of the Ministry of Finance & Economic Planning. No Ministry, Department or other Government Agency shall undertake procurement unless it is designated as a Procuring Entity.  The Minister of Finance will revise the list from time to time to accommodate newly approved Procuring Entities and to remove any Procuring Entity as the case may be. A Procurement Entity may delegate procurement responsibility to another Procuring Entity only with a written authority of the Minister of Finance & Economic Planning of such delegation. Where a Procuring Entity has been delegated responsibility for procurement, it must comply with all the Rules and Regulations described herein.
<br /><br />
 (5).   The Interim Public Procurement and Disposal Regulations, 2006 supersede any existing procedures on processing contracts.
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