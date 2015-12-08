<tr class="purple-bg">
  <td>&nbsp;</td>
  <td><div class='h4 left-div small-div-padding'><?php echo date('l, F j, Y g:iA T', strtotime('now'));?></div>
<div class='right-div row-divs small-padding'>
	<div class='btn h5' data-rel='users/settings/view/Y'><?php echo $this->native_session->get('__first_name').' '.$this->native_session->get('__last_name').' ['.$this->native_session->get('__user_type').']'?></div>
    <div class='btn h5' data-rel='accounts/logout'>Log Out</div>
</div></td>
  <td>&nbsp;</td>
</tr>


<tr>
  <td>&nbsp;</td>
  <td style='height:6vh;'>
<table class='normal-table'><tr><td style='width:1%'><img src='<?php echo IMAGE_URL.'logo.png';?>' border='0' style="height:30px;"/></td>
<td style='width:99%'><span class='h2'><?php echo $__page;?></span></td></tr>
</table>
</td>
  <td>&nbsp;</td>
</tr>
