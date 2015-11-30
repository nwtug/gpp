<?php $page = !empty($page)? $page:'';?>

<tr class='step-ribbon'>
  <td>&nbsp;</td><td><table><tr>
  		<td  class='btn' data-rel='documents/manage'><a href='javascript:;' <?php echo ($page == 'documents'? "style='font-weight:bold;color:#999;'": '');?>>Documents</a></td>
    	<td  class='btn' data-rel='links/manage'><a href='javascript:;' <?php echo ($page == 'important_links'? "style='font-weight:bold;color:#999;'": '');?>>Important Links</a></td>
        <td class='btn' data-rel='documents/manage/a/standard'><a href='javascript:;' <?php echo ($page == 'standards'? "style='font-weight:bold;color:#999;'": '');?>>Standards</a></td>
    	<td  class='btn' data-rel='training/manage'><a href='javascript:;' <?php echo ($page == 'training_activities'? "style='font-weight:bold;color:#999;'": '');?>>Training Activities</a></td>
    </tr></table></td><td>&nbsp;</td>
</tr>