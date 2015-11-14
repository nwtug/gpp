<?php $actualStep = $this->native_session->get('__step')? $this->native_session->get('__step'): 1;?>

<tr class='step-ribbon'>
  <td>&nbsp;</td><td><table><tr>
  		<td <?php echo ((empty($step) || !empty($step)) || $actualStep > 0? " class='active btn' data-rel='account/register/step/1'": '');?>>1. Choose Account Type</td>
    	<td <?php echo ((!empty($step) && $step > '1') || $actualStep > 1? " class='active btn' data-rel='account/register/step/2'": '');?>>2. About Your Account</td>
    	<td <?php echo ((!empty($step) && $step > '2') || $actualStep > 2? " class='active btn' data-rel='account/register/step/3'": '');?>>3. Confirm Contact</td>
        <td <?php echo ((!empty($step) && $step > '3') || $actualStep > 2? " class='active btn' data-rel='account/login'": '');?>>4. Login</td>
    </tr></table></td><td>&nbsp;</td>
</tr>