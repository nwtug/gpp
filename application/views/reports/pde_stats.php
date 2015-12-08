<div><table class='summary-table'>
<tr><td style='text-align:center;height:30vh;'><span  class='h1'><?php echo !empty($list['plans_submitted'])? $list['plans_submitted']: '0';?></span>
<br /><span class='h3 blue'>Procurement Plans Submitted</span></td></tr>
<tr><td><a href='<?php echo base_url();?>procurement_plans/add'>Add Procurement Plan</a></td></tr>
<tr><td><a href='<?php echo base_url();?>procurement_plans/manage'>Manage Procurement Plan</a></td></tr>
</table></div>

<div><table class='summary-table'>
<tr><td style='text-align:center;height:30vh;'><span  class='h1'><?php echo !empty($list['tenders_advertised'])? $list['tenders_advertised']: '0';?></span>
<br /><span class='h3 blue'>Tenders Advertised</span></td></tr>
<tr><td><a href='<?php echo base_url();?>tenders/add'>Invite For Tenders</a></td></tr>
<tr><td><a href='<?php echo base_url();?>tenders/manage'>Manage Tenders</a></td></tr>
</table></div>

<div><table class='summary-table'>
<tr><td style='text-align:center;height:30vh;'><span  class='h1'><?php echo !empty($list['contracts_awarded'])? $list['contracts_awarded']: '0';?></span>
<br /><span class='h3 blue'>Contracts Awarded</span></td></tr>
<tr><td><a href='<?php echo base_url();?>bids/manage/a/best_bidders'>Award Contract</a></td></tr>
<tr><td><a href='<?php echo base_url();?>contracts/manage'>Manage Contracts</a></td></tr>
</table></div>