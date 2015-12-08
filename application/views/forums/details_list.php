<div id="forums__1">
<table>


<?php if($type == 'public_forums'){ ?>
<tr><th>Question</th><th>Category</th><th>Contributors</th><th>Date</th></tr>
<?php
            if(isset($publicForumsList)){
                foreach($publicForumsList as $list){
                    ?><tr><td ><?=$list['topic']?></td><td><span class='grey-box'><?=$list['category']?></span></td><td>(<?=$list['no_of_contributors']?>)</td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['last_updated']))?></td></tr>

<?php }
  
			}?>
<?php }  

else if($type == 'secure_forums'){ ?>


<tr><th>Question</th><th>Category</th><th>Contributors</th><th>Date</th></tr>

<?php
            if(isset($secureForumsList)){
                foreach($secureForumsList as $list){
                    ?><tr><td ><?=$list['topic']?></td><td><span class='grey-box'><?=$list['category']?></span></td><td>(<?=$list['no_of_contributors']?>)</td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['last_updated']))?></td></tr>

<?php }
  
			}?>

<?php }  

else if($type == 'frequently_asked_questions'){ ?>
<tr><th>Question</th>
  <th colspan="3">Answer</th></tr>


<?php
            if(isset($faqList)){
                foreach($faqList as $list){
                    ?><tr><td ><?=$list['question']?></td><td colspan="3"><?=$list['answer']?></td></tr>
 <?php }
  
			}?>

<?php }  

else { 
	echo "<tr><td>".format_notice($this, 'WARNING: List can not be generated.')."</td></tr>";
}?>


</table>
</div>