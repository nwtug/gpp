<?php 
echo "<link rel='stylesheet' href='".base_url()."assets/css/jquery-ui.css'/>";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.list.css' type='text/css' media='screen' />";
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.form.css' type='text/css' media='screen' />"; 
echo "<link rel='stylesheet' href='".base_url()."assets/css/pss.datepicker.css' type='text/css' media='screen' />"; 


echo "<table style='width:100%;' id='plan_details_form'>
<tr><td class='label'>Select Category</td><td><select id='search__procurementcategories' name='search__procurementcategories' class='drop-down' style='width:100%;'>";
echo get_option_list($this, 'procurementcategories', 'select', '', array('selected'=>$categoryId));
echo "</select></td></tr>
<tr><td colspan='2'>&nbsp;</td></tr>

<tr><td class='label'>Brief Description</td><td><input type='text' id='B' name='B' style='width:100%;' value=''/></td></tr>
<tr><td class='label'>Procurement Method</td><td><select id='C' name='C' class='drop-down' style='width:100%;'>";
echo get_option_list($this, 'procurementmethods');
echo "</select></td></tr>
<tr><td class='label'>Estimate in SSP</td><td><input type='text' id='D' name='D' class='numbersonly' style='width:100%;' value=''/></td></tr>
<tr><td class='label'>Tender Document/RFP</td><td><input type='text' id='E' name='E' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Bid/EOI Invitation &amp; Open</td><td><input type='text' id='F' name='F' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Bid/EOI Evaluation/Short List</td><td><input type='text' id='G' name='G' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Issuance of RFP (Services)</td><td><input type='text' id='H' name='H' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Receipt of RFP (Service)</td><td><input type='text' id='I' name='I' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Evaluation /Negotiate</td><td><input type='text' id='J' name='J' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Contract Approval MoFEP</td><td><input type='text' id='K' name='K' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Contract Endorsement MoJ</td><td><input type='text' id='L' name='L' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Contract Award</td><td><input type='text' id='M' name='M' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Commencement of Contract</td><td><input type='text' id='N' name='N' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td class='label'>Contract Completion</td><td><input type='text' id='O' name='O' class='calendar clickactivated' style='width:100%;' value='' onclick='setDatePicker(this)'/></td></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
<tr><td colspan='2'>
<input type='hidden' id='plan_id' name='plan_id' value='".$planId."' />
<button type='button' id='addplan' name='addplan' class='btn green' onclick=\"submitPlanData()\" style='width: 100%;'>Save</button></td></tr>
</table>";


echo minify_js('procurement_plans__add_details', array('jquery-2.1.1.min.js', 'jquery-ui.js', 'jquery.form.js', 'pss.js', 'jquery.datepick.js', 'pss.fileform.js', 'pss.procurement.js', 'pss.datepicker.js'));
?>