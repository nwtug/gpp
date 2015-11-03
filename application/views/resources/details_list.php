<div id="resourcesearch__1">
<table>


<?php if($type == 'documents'){ ?>
<tr><th>Name</th><th>Type</th><th>Size</th><th>Posted</th></tr>
<tr><td class='msdoc-icon-row'>Public Procurement Bill MoFEP</td><td>Legal</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='file-icon-row'>Public Procurement Bill MoFEP</td><td>Legal</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='msppt-icon-row'>Public Procurement Bill MoFEP</td><td>Audit</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='pdf-icon-row'>Effects of Corruption in Developing Countries 2013</td><td>Legal</td><td>567KB</td><td>14/11/2014</td></tr>
<tr><td class='msppt-icon-row'>Public Procurement Bill MoFEP</td><td>Audit</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='file-icon-row'>Effects of Corruption in Developing Countries 2013</td><td>Legal</td><td>567KB</td><td>14/11/2014</td></tr>
<?php }  

else if($type == 'important_links'){ ?>
<tr><th>Name</th><th>Type</th><th>Size</th><th>Posted</th></tr>

<tr><td class='file-icon-row'>How to register</td><td>Legal</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='pdf-icon-row'>The procurement procedure</td><td>Legal</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='msppt-icon-row'>Dangers in breaching contracts</td><td>Audit</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='msdoc-icon-row'>Avoidable Causes of Delays in Bid Evaluation</td><td>Legal</td><td>567KB</td><td>14/11/2014</td></tr>

<?php }  

else if($type == 'standards'){ ?>
<tr><th>Name</th><th>Type</th><th>Size</th><th>Posted</th></tr>

<tr><td class='msdoc-icon-row'>Case Studies</td><td>Legal</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='pdf-icon-row'>Rejection of contracts</td><td>Legal</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='msppt-icon-row'>Dangers in breaching contracts</td><td>Audit</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='pdf-icon-row'>Complaining to the tribunal</td><td>Legal</td><td>567KB</td><td>14/11/2014</td></tr>

<?php }  

else if($type == 'training_activities'){ ?>
<tr><th>Name</th><th>Type</th><th>Size</th><th>Posted</th></tr>

<tr><td class='pdf-icon-row'>Approval Training</td><td>Legal</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='msppt-icon-row'>Bidding Training</td><td>Legal</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='msdoc-icon-row'>Sell of Bidding Document</td><td>Audit</td><td>2.3MB</td><td>14/11/2014</td></tr>
<tr><td class='file-icon-row'>Complaining to the tribunal</td><td>Legal</td><td>567KB</td><td>14/11/2014</td></tr>

<?php } 


else { 
	echo "<tr><td>".format_notice($this, 'WARNING: List can not be generated.')."</td></tr>";
}?>


</table>
</div>