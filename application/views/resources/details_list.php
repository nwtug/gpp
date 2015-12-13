<div id="resources__1">
<table>


<?php if($type == 'documents'){ ?>
<tr><th>Name</th><th>Type</th><th>Size</th><th>Posted</th></tr>
<?php
            if(isset($documentsList)){
				$stopHtml = "<input name='paginationdiv__resources_stop' id='paginationdiv__resources_stop' type='hidden' value='1' />";
                $listCount = count($documentsList);
				$i = 0;
                foreach($documentsList as $list){
        				$i++;
                    ?>
                    <tr>
                       <td class=<?=document_class($list['url']).'-icon-row'?>><a href="<?=base_url().'pages/download/file/'.$list['url']?>"><?=$list['name']?></a></td>
                       <td><?=$list['category']?></td>
                       <td><?=format_number($list['size'],3)."B"?></td>
                       <td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_entered']))?>
                    <?php if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		              echo $stopHtml;
		           }?>
                      </td>
                   </tr>
                    
			<?php }
                    
              }?>

<?php }  

else if($type == 'important_links'){ ?>
<tr>
  <th colspan="4">Links</th>
  </tr>
             <?php
            if(isset($linksList)){
				$stopHtml = "<input name='paginationdiv__resources_stop' id='paginationdiv__resources_stop' type='hidden' value='1' />";
                $listCount = count($linksList);
				$i = 0;
                foreach($linksList as $list){
       				$i++;
                    ?>
                   <tr> 
                        <td colspan="4" ><a href=<?=$list['url'].apply_open_type($list['open_type'], 'closable')?>><?=$list['name']?></a>

                   <?php if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		              echo $stopHtml;
		           }?> </td>
                  </tr>
                   <?php 
				   }

			}?>


       <?php }  

else if($type == 'standards'){ ?>
<tr><th>Name</th><th>Type</th><th>Size</th><th>Posted</th></tr>

<?php
            if(isset($standardList)){
				
				$stopHtml = "<input name='paginationdiv__resources_stop' id='paginationdiv__resources_stop' type='hidden' value='1' />";
                $listCount = count($standardList);
				$i = 0;
                foreach($standardList as $list){
       				$i++;
                   ?>
                    <tr>
                    <td class=<?=document_class($list['url']).'-icon-row'?>><a href="<?=base_url().'pages/download/file/'.$list['url']?>"><?=$list['name']?></a>
                    </td>
                    <td>
					<?=$list['category']?></td>
                    <td><?=format_number($list['size'],3)."B"?></td>
                    <td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_entered']))?>
                   <?php if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		              echo $stopHtml;
		           }?>                    </td></tr>
                    <?php
					    }
                    
                }?>

<?php }  

else if($type == 'training_activities'){ ?>
<tr><th>Name</th> <th>Category</th>
  <th>Event Date, Time</th>
  <th >Duration</th> <th >Posted</th></tr>
<?php
            if(isset($trainingList)){
				$stopHtml = "<input name='paginationdiv__resources_stop' id='paginationdiv__resources_stop' type='hidden' value='1' />";
                $listCount = count($trainingList);
				$i = 0;
                foreach($trainingList as $list){
       				$i++;
                    ?>
                     <tr>
                        <td ><a href="<?=base_url().'training/description/d/'.$list['training_id'] ?>"class='shadowbox closable'><?=$list['subject']?></a></td>
                        <td ><?=ucwords(str_replace('_',' ',$list['category']))?></td>
                        <td><?=date(FULL_DATE_FORMAT, strtotime($list['event_time']))?></td>
                        <td ><?=$list['duration'].'hrs'?></td>
                        <td ><?=date(SHORT_DATE_FORMAT, strtotime($list['date_entered']))?>
                      <?php if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		              echo $stopHtml;
		           }?>   
                        </td>
                    </tr>
  
  <?php }
  
			}?>


<?php } 


else { 
	echo "<tr><td>".format_notice($this, 'WARNING: List can not be generated.')."</td></tr>";
}?>


</table>
</div>