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
    <td width="69%" valign="top">
  
  <table>
    <tr>
      <td valign="top"><div class="about"><p>The Procurement Policy Unit in the Ministry of Finance and  Economic Planning developed this information management system (the portal or  website) in order to provide interested stakeholders with timely access to  public procurement information. This website supports an effective and  transparent procurement opportunities by encouraging suppliers and contracting  entities to adopt best practices and use information technology to provide all  the information needed to deliver transparency and value for money in public  procurement. For suppliers the site gives background information about public  procurement and links to other sites with appropriate information about  procurement opportunities in South Sudan and beyond. For procurement  professionals and public officers,   the  website presents information on regulations and procedures, host discussion  forum on how to improve procurement skills and to provide links to different  sources on best practices. It is also linked to the existing MoFEP website.</p>
 <p>The portal has the  following key components;</p>
<ul>
  <li><strong>A website</strong>
  <p>This is the  first point of access for the dynamic Register of Providers (ROP) and the  Procurement Tracking System (PTS). It is repository of information on  procurement regulations and guidelines, updates, discussion forums, standard  forms, catalogue of debarred providers, documents, standards, important links  and so forth. </p></li>
</ul>

<ul>
  <li><strong>A Register of Providers (ROP)</strong>
  <p>The ROP  enables the Directorate of Procurement to regulate, certify and debar Service  Providers. Certified providers are those that have met all registration  criteria. Besides the registration and profiling of Providers of Works, Goods  and Services for the Government of South Sudan, the ROP offers certified  providers authenticated and verifiable certificates and messages of  opportunities from the PTS.</p></li>
</ul>

<ul>
  <li><strong>An automated Procurement Tracking System (PTS)</strong>
  <p>The PTS  helps the Directorate of Public Procurement in its monitoring and compliance  role via on-demand and automatically generated reports to measure procurement  performance. It also enables participating agencies to easily generate various  procurement related reports. </p>
  </li>
</ul></div>
      </td>
      <td  valign="top">
      
      <div class="sitemap-left"><table class='summary-table'>
<tr><th class='h3 blue'>Site Map</th></tr>
<tr><td><a href='<?php echo BASE_URL;?>pages'>Home</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>pages/portal'>Portal</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>pages/about'>About This Portal</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>tenders'>Tenders</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>providers'>Providers</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>documents'>Resources</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>forums/index/a/frequently_asked_questions'>FAQs</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>accounts/register'>Register</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>accounts/login'>Login</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>pages/verify'>Verify Document</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>pages/contact_us'>Contact Us</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>pages/terms_of_use'>Terms</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>pages/privacy_policy'>Privacy Policy</a></td></tr>
<tr><td><a href='<?php echo BASE_URL;?>pages/government_agencies'>Government Agencies</a></td></tr>
<tr><td>&nbsp;</td></tr>

</table></div>

      </td>
    </tr>
  </table></td>
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