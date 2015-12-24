<tr>
  <td class='grey-menu-bg'>&nbsp;</td>
  <td class='grey-menu-bg row-divs'>
  <div class='left-div top-divs'>
  	<div class='btn<?php if($__page == 'my_dashboard') echo " active";?>'  data-rel='accounts/admin_dashboard'>My Dashboard</div>
    <div class='btn<?php if($__page == 'procurement') echo " active";?>' data-rel='procurement_plans/manage'>Procurement</div>
    <div class='btn<?php if($__page == 'providers') echo " active";?>' data-rel='providers/manage'>Providers</div>
    <div class='btn<?php if($__page == 'contracts') echo " active";?>'  data-rel='contracts/manage'>Contracts</div>
   
    <div class='btn<?php if($__page == 'resources') echo " active";?>' data-rel='documents/manage'>Resources</div>
    <div class='btn<?php if($__page == 'forums') echo " active";?>' data-rel='forums/manage'>Forums</div>
    <div class='btn<?php if($__page == 'reports') echo " active";?>' data-rel='reports/manage'>Reports</div>
    <div class='btn<?php if($__page == 'users') echo " active";?>' data-rel='users'>Users</div>
    <div class='btn<?php if($__page == 'settings') echo " active";?>' data-rel='users/settings/view/Y'>Settings</div>
    <div class='btn<?php if($__page == 'help') echo " active";?>' data-rel='faqs/manage'>Help</div>
  </div>
  <div class='right-div'><div class='trigger-search shadowbox closable' data-url='<?php echo base_url().'pages/system_search/t/secure/area/admin';?>'>&nbsp;</div></div></td>
  <td class='grey-menu-bg'>&nbsp;</td>
</tr>
