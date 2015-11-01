<table>

<?php if($type == 'procurement_plans'){?>
<tr><td><span class='bold'>25/12/2015 &nbsp; &nbsp; Construction Works on Yei-Juba Road (340km)</span>
<br><span class='grey-box'>Works</span> <span class='dark-grey'>Open International Bidding</span>
<br><span class='dark-grey'><span class='bold'>Posted:</span> 04/10/2015</span></td>
<td class='dark-grey'>By: Ministry of Roads and Infrastructure</td></tr>

<tr><td><span class='bold'>25/12/2015 &nbsp; &nbsp; Construction Works on Yei-Juba Road (340km)</span>
<br><span class='grey-box'>Works</span> <span class='dark-grey'>Open International Bidding</span>
<br><span class='dark-grey'><span class='bold'>Posted:</span> 04/10/2015</span></td>
<td class='dark-grey'>By: Ministry of Roads and Infrastructure</td></tr>

<tr><td><span class='bold'>25/12/2015 &nbsp; &nbsp; Construction Works on Yei-Juba Road (340km)</span>
<br><span class='grey-box'>Works</span> <span class='dark-grey'>Open International Bidding</span>
<br><span class='dark-grey'><span class='bold'>Posted:</span> 04/10/2015</span></td>
<td class='dark-grey'>By: Ministry of Roads and Infrastructure</td></tr>

<?php } 






else if($type == 'active_providers'){ ?>
<tr><td><span class='bold'>PricewaterhouseCoopers, LLP</span>
<br><span class='grey-box'>Audit</span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Registered: 28/02/2014</td></tr>

<tr><td><span class='bold'>Millenial Publishing Ltd</span>
<br><span class='grey-box'>Education</span></td>
<td class='dark-grey'>Registered: 14/11/2014</td></tr>

<tr><td><span class='bold'>Millenial Publishing Ltd</span>
<br><span class='grey-box'>Education</span></td>
<td class='dark-grey'>Registered: 14/11/2014</td></tr>
<?php }  








else if($type == 'documents'){ ?>
<tr><td class='pdf-icon-row'><span class='bold'>Public Procurement Bill MoFEP</span>
<br><span class='grey-box'>Legal</span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Posted: 04/10/2015 <br>Size: 256KB</td></tr>

<tr><td class='msppt-icon-row'><span class='bold'>How Local Contractors Transform for International Procurem..</span>
<br><span class='grey-box'>Case Studies</span></td>
<td class='dark-grey'>Posted: 03/10/2015 <br>Size: 1.35MB</td></tr>

<tr><td class='msdoc-icon-row'><span class='bold'>Effects of Corruption in Developing Countries 2013</span>
<br><span class='grey-box'>Reports</span></td>
<td class='dark-grey'>Posted: 03/10/2015<br>Size: 124KB</td></tr>

<tr><td class='file-icon-row'><span class='bold'>Avoidable Causes of Delays in Bid Evaluation</span>
<br><span class='grey-box'>Reports</span></td>
<td class='dark-grey'>Posted: 01/10/2015<br>Size: 256KB</td></tr>
<?php }  



else if($type == 'public_forums'){ ?>
<tr><td><span class='bold'>What’s causing the delay in Kima Road construction?</span>
<br><span class='grey-box'>Works</span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Started: 28/05/2015<br>Contributors: 189</td></tr>

<tr><td><span class='bold'>Ways to reward honest contractors</span>
<br><span class='grey-box'>General</span></td>
<td class='dark-grey'>Started: 12/05/2015<br>Contributors: 1,453</td></tr>

<tr><td><span class='bold'>Mistakes in disposal of Sekit Dam equipment</span>
<br><span class='grey-box'>Goods</span></td>
<td class='dark-grey'>Started: 19/04/2015<br>Contributors: 41</td></tr>

<tr><td><span class='bold'>How to use the new registration section</span>
<br><span class='grey-box'>Reports</span></td>
<td class='dark-grey'>Started: 27/06/2015<br>Contributors: 189</td></tr>
<?php } 



else { 
	echo "<tr><td>".format_notice($this, 'WARNING: List can not be generated.')."</td></tr>";
}?>










</table>