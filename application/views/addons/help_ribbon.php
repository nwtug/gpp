<?php $page = !empty($page)? $page:'';?>

<tr class='step-ribbon'>
  <td>&nbsp;</td><td><table><tr>
  		<td  class='btn' data-rel='faqs/manage'><a href='javascript:;' <?php echo ($page == 'faqs'? "style='font-weight:bold;color:#999;'": '');?>>FAQs</a></td>

<?php if($this->native_session->get('__user_type') != 'provider'){?>
    	<td  class='btn' data-rel='pages/download/file/<?php echo $this->native_session->get('__user_type');?>_user_manual.pdf'><a href='javascript:;' <?php echo ($page == 'user_manual'? "style='font-weight:bold;color:#999;'": '');?>>User Manual</a></td>
<?php }?>

    	<td  class='btn' data-rel='faqs/contact_us'><a href='javascript:;' <?php echo ($page == 'contact_us'? "style='font-weight:bold;color:#999;'": '');?>>Contact Us</a></td>
    </tr></table></td><td>&nbsp;</td>
</tr>