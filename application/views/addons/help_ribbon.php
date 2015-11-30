<?php $page = !empty($page)? $page:'';?>

<tr class='step-ribbon'>
  <td>&nbsp;</td><td><table><tr>
  		<td  class='btn' data-rel='faqs/manage'><a href='javascript:;' <?php echo ($page == 'faqs'? "style='font-weight:bold;color:#999;'": '');?>>FAQs</a></td>
    	<td  class='btn' data-rel='faqs/contact_us'><a href='javascript:;' <?php echo ($page == 'contact_us'? "style='font-weight:bold;color:#999;'": '');?>>Contact Us</a></td>
    </tr></table></td><td>&nbsp;</td>
</tr>