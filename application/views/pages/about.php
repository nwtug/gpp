<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMAGE_URL;?>favicon.ico">
	<title><?php echo SITE_TITLE.': About This Portal';?></title>
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/external-fonts.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.list.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/pss.shadowbox.css" type="text/css" media="screen" />
</head>

<body>
<table class='body-table water-mark-bg'>
<?php $this->load->view('addons/public_header');

$this->load->view('addons/public_top_menu', array('__page'=>'about'));
?>

<tr>
  <td>&nbsp;</td>
  <td style='height:calc(85vh - 214px);'>
<div class='body-title'>About This Portal</div>
<div class="body-content"><table>
<tr><td><table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="69%" valign="top"><p>The    Procurement Policy Unit (PPU) was established in the Ministry of Finance and    Economic Planning (MOFEP) and is responsible for formulating and implementing    procurement policies, regulations and procedures and ensuring compliance    throughout the Government of Republic of South Sudan.  It eventually will be transformed into the South    Sudan Public Procurement and Disposal Authority once the public procurement    bill is enacted.</p>
      <p>The    objectives of the PPU are to:</p>
      <ul>
        <li>regulate    and monitor Procurement in South Sudan and to advise Government Institutions    on issues relating to Procurement;</li>
        <li>ensure    the application of fair, competitive, transparent, non-discriminatory and    value for  money Procurement and Disposal    standards and practices;</li>
        <li>harmonise    the Procurement and Disposal policies, systems and practices of Government    Institutions at all levels of government in South Sudan, and</li>
        <li>ensure    that Procuring Entities are staffed at appropriate levels in order to    efficiently and effectively manage Procurement activities.</li>
      </ul>
      <p>The    functions of the PPU are to:</p>
      <ul>
        <li>formulate    policies and standards on Procurement and Disposal and to ensure compliance    by all parties to Procurement and Disposal Processes;</li>
        <li>provide    advisory services to Government Institutions on Procurement and Disposal    policies, principles and practices;</li>
        <li>monitor    and report on the performance of the Procurement and Disposal systems in    South Sudan and advise on desirable changes;</li>
        <li>adopt    international training standards in Procurement and Disposal development    paths in consultation with Competent Authorities;</li>
        <li>prepare,    update and issue authorised versions of standardised Bidding Documents,    procedural forms and any other attendant documents to Procuring Entities;</li>
        <li>ensure    that any deviation from the use of the standardised Bidding Documents,    procedural forms and any other attendant documents is effected only after the    prior, written approval of the Directorate;</li>
        <li>advise    the Minister on the issuance of the regulations made under this Act;</li>
        <li>issue    guidelines under section 82 of this Act;</li>
        <li>organise    and maintain a system for the publication of data on Procurement and Disposal    opportunities, Awards and any other information of public interest as may be    determined by the Directorate;</li>
        <li>maintain    a register of Providers of Supplies, Works, and Services;</li>
        <li>conduct    periodic review and inspections of the records and proceedings of the    Procuring Entities to ensure full and correct application of this Act;</li>
        <li>adopt,    adapt and update common Specifications standards, the use of which shall be    mandatory for all Procuring Entities;</li>
        <li>determine,    develop, introduce, maintain and update related system-wide data-bases and    technology;</li>
        <li>develop    policies and maintain an operational plan on capacity building for    procurement officers in all Procuring Entities, both for institutional and    human resource development;</li>
        <li>agree    and advise on a list, which shall be reviewed annually, of Works, Services    and Supplies in common use by more than one Procuring Entity which may be    subject to common Procurement or Disposal Processes;</li>
        <li>establish    and maintain institutional linkages with entities with professional and    related interest in public procurement and disposal;</li>
        <li>undertake    procurement and disposal research and surveys nationally and internationally;</li>
        <li>undertake    any activity that may be necessary for the execution of its functions;</li>
        <li>receive    and address complaints from a Bidder;</li>
        <li>administer    and enforce compliance with all the provisions of the Procurement Act, and    the regulations made under the Procurement Act; and</li>
        <li>coordinate    the management and deployment of procurement officers in Procuring Entities,    in accordance with the Public Financial Management and Accountability Act,    2011.</li>
      </ul></td>
  </tr>
</table></td></tr>
</table></div>


</td>
  <td>&nbsp;</td>
</tr>

<?php $this->load->view('addons/public_footer');?>

</table>
<?php echo minify_js('pages__about', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'pss.shadowbox.js'));?>
</body>
</html>