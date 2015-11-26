<?php $page = !empty($page)? $page:'';?>

<tr class='step-ribbon'>
  <td>&nbsp;</td><td><table><tr>
  		<td  class='btn' data-rel='procurement_plans/manage'><a href='javascript:;' <?php echo ($page == 'procurement_plans'? "style='font-weight:bold;color:#999;'": '');?>>Procurement Plans</a></td>
    	<td  class='btn' data-rel='tenders/manage'><a href='javascript:;' <?php echo ($page == 'tenders'? "style='font-weight:bold;color:#999;'": '');?>>Tender Notices</a></td>
        <td class='btn' data-rel='bids/manage'><a href='javascript:;' <?php echo ($page == 'bids'? "style='font-weight:bold;color:#999;'": '');?>>Bids</a></td>
<<<<<<< HEAD

    	<td  class='btn' data-rel='bids/manage/a/best_bidders'><a href='javascript:;' <?php echo ($page == 'best_bidders'? "style='font-weight:bold;color:#999;'": '');?>>Best Evaluated Bidders</a></td>
        <td class='btn' data-rel='bids/manage/a/awards'><a href='javascript:;' <?php echo ($page == 'awards'? "style='font-weight:bold;color:#999;'": '');?>>Contract Awards</a></td>

=======
    	<td  class='btn' data-rel='bids/manage/t/best_bidders'><a href='javascript:;' <?php echo ($page == 'best_bidders'? "style='font-weight:bold;color:#999;'": '');?>>Best Evaluated Bidders</a></td>
        <td class='btn' data-rel='bids/manage/t/awards'><a href='javascript:;' <?php echo ($page == 'awards'? "style='font-weight:bold;color:#999;'": '');?>>Contract Awards</a></td>
>>>>>>> 702c46b4c75d490103d264ddc3f007cf8f437efa
    </tr></table></td><td>&nbsp;</td>
</tr>