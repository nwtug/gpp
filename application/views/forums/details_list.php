<div id="forums__1">
<table>


<?php if($type == 'public_forums'){ ?>
<tr><th>Question</th><th>Category</th><th>Contributors</th><th>Date</th></tr>
<?php
            if(isset($publicForumsList)){
				$stopHtml = "<input name='paginationdiv__forums_stop' id='paginationdiv__forums_stop' type='hidden' value='1' />";
                $listCount = count($publicForumsList);
				$i = 0;
                foreach($publicForumsList as $list){
       				$i++;
                    ?>
                    <tr>
                         <td ><a href="<?=base_url()?>forums/view_one/d/<?=$list['forum_id']?>" class='shadowbox closable'><?=$list['topic']?></a></td>
                         <td><span class='grey-box'><?=$list['category']?></span></td>
                         <td>(<?=$list['no_of_contributors']?>)</td>
                         <td><?=date(SHORT_DATE_FORMAT, strtotime($list['last_updated']))?>
                    <?php if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		              echo $stopHtml;
		           }?> 
                   </td></tr>

                  <?php }
  
			}?>
<?php }  

else if($type == 'secure_forums'){ ?>


<tr><th>Question</th><th>Category</th><th>Contributors</th><th>Date</th></tr>

<?php
            if(isset($secureForumsList)){
				$stopHtml = "<input name='paginationdiv__forums_stop' id='paginationdiv__forums_stop' type='hidden' value='1' />";
                $listCount = count($secureForumsList);
				$i = 0;
                foreach($secureForumsList as $list){
       				$i++;
                    ?>
                    <tr>
                        <td ><a href="<?=base_url()?>forums/view_one/d/<?=$list['forum_id']?>" class='shadowbox closable'><?=$list['topic']?></a></td>
                        <td><span class='grey-box'><?=$list['category']?></span></td>
                        <td>(<?=$list['no_of_contributors']?>)</td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['last_updated']))?>
                   <?php if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		              echo $stopHtml;
		           }?>  
                    </td></tr>

<?php }
  
			}?>

<?php }  

else if($type == 'frequently_asked_questions'){ ?>
<tr><th>Question</th>
  <th colspan="3">Answer</th></tr>


<?php
            if(isset($faqList)){
				$stopHtml = "<input name='paginationdiv__forums_stop' id='paginationdiv__forums_stop' type='hidden' value='1' />";
                $listCount = count($faqList);
				$i = 0;
                foreach($faqList as $list){
       				$i++;
                    ?>
                    <tr>
                    <td ><?=$list['question']?></td><td colspan="3"><?=$list['answer']?>
                     <?php if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		              echo $stopHtml;
		           }?>
                    </td></tr>
 <?php }
  
			}?>

<?php }  

else { 
	echo "<tr><td>".format_notice($this, 'WARNING: List can not be generated.')."</td></tr>";
}?>


</table>
</div>