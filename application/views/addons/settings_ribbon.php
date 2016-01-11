<?php $page = !empty($page)? $page:'';?>

<tr class='step-ribbon'>
  <td>&nbsp;</td><td><table><tr>
  		<td  class='btn' data-rel='users/settings/view/Y'><a href='javascript:;' <?php echo ($page == 'user_settings'? "style='font-weight:bold;color:#999;'": '');?>>User Settings</a></td>
        
<?php if($this->native_session->get('__is_owner') == 'Y'){?>
    	<td  class='btn' data-rel='organizations/settings/view/Y'><a href='javascript:;' <?php echo ($page == 'organization_settings'? "style='font-weight:bold;color:#999;'": '');?>>Organization Settings</a></td>
<?php }?>

<?php if($this->native_session->get('__user_type') == 'admin'){?>
    	<td  class='btn' data-rel='permissions/manage'><a href='javascript:;' <?php echo ($page == 'permission_groups'? "style='font-weight:bold;color:#999;'": '');?>>Permission Groups</a></td>
<?php }?>
        
    </tr></table></td><td>&nbsp;</td>
</tr>