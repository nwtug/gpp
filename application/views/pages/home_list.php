<div id="<?php 
#change ID depending on the type passed
if(($type == 'procurement_plans')||($type == 'active_notices')||($type == 'best_evaluated_bidders')||($type == 'contract_awards')){
	echo "tender__1"; 
}
elseif(($type == 'active_providers')||($type == 'suspended_providers')){
	echo "provider__1"; 
}
elseif(($type == 'documents')||($type == 'important_links')||($type == 'standards')||($type == 'training_activities')){
	echo "resources__1";
}
elseif(($type == 'frequently_asked_questions')||($type == 'secure_forums')||($type == 'public_forums')){
	echo "forums__1";
}
?>">

<table>

<?php if($type == 'procurement_plans'){?>

 <?php
            if(isset($procurementPlanList)){
                foreach($procurementPlanList as $list){
                    ?>
                    <tr>
                        <td  colspan="2"><span class="bold"><?=$list['pde']?></span>
                      <br><a href="<?=base_url().'procurement_plans/view_one/d/'.$list['procurement_plan_id']?>" class="shadowbox blue-box closable">Details of <?=substr($list['financial_year_start'],0,4).'-'.substr($list['financial_year_end'],0,4) .' '.$list['name']?></a>
                    </tr>
                    <?php
                }

            }
        ?>

<?php } 


else if($type == 'active_notices'){?>


<?php
            if(isset($tenderList)){
                foreach($tenderList as $list){ ?>
       
<tr>
  <td>
<span class='bold'><?=$list['subject']?></span>
<br><span class='grey-box'><?=$list['procurement_type']?> </span> <span class='dark-grey'>[<?=ucwords(str_replace('_',' ',$list['procurement_method']))?>]</span>
<br><span class='dark-grey'><span class='bold'>Posted:</span> <?=date(SHORT_DATE_FORMAT, strtotime($list['date_created']))?></span></td>
<td class='dark-grey'><span class='bold'>Entity:</span> <?=$list['pde']?></td></tr>

<?php
                
				}

            }?>

<?php } 


else if($type == 'best_evaluated_bidders'){?>

<?php
            if(isset($bebList)){
                foreach($bebList as $list){
                    ?> <tr><td><span class='bold'><?=$list['tender_notice']?></span><br>
<span class='dark-grey'><span class='bold'>Date BEB Expires:</span> <?=date(SHORT_DATE_FORMAT, strtotime($list['valid_end_date']))?></span> 
<br><span class='dark-grey'><span class='bold'>Posted:</span> <?=date(SHORT_DATE_FORMAT, strtotime($list['last_updated']))?></span></td>
<td class='dark-grey'><span class='bold'>Entity: </span><?=$list['pde']?><br><span class='bold'>Provider:</span> <?=$list['provider']?><br><span class='bold'>BEB Amount: </span><?=$list['bid_amount']?><?=$list['bid_currency']?><br><span class='bold'>Status:</span> <div class="green-box"><?=$list['status']?></div></td></tr>

      <?php
                }

            }?>


<?php } 


else if($type == 'contract_awards'){?>

<?php
            if(isset($contractList)){
                foreach($contractList as $list){
                    ?> <tr><td><span class='bold'><?=$list['tender_notice']?></span><br><span class='dark-grey'><span class='bold'>Contract Value:</span></span> <?=$list['contract_amount']?><?=$list['contract_currency']?>
<br><span class='dark-grey'><span class='bold'>Date Signed:</span> <?=$list['date_started']?></span></td>
<td class='dark-grey'><span class='bold'>Entity:</span> <?=$list['pde']?> <br><span class='bold'>Provider:</span> <?=$list['provider']?><br><span class='bold'>Status: </span> <span class="orange-box"><?=$list['status']?></span></td></tr>
      
 <?php
                }

            }?>

<?php } 


else if($type == 'active_providers'){ ?>
          
<?php
            if(isset($activeProvidersList)){
                foreach($activeProvidersList as $list){
                    ?>

<tr><td><span class='bold'><?=$list['name']?></span>
<br><span class='grey-box'><?=$list['category']?></span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Registered: <?=date(SHORT_DATE_FORMAT, strtotime($list['date_registered']))?></td></tr>
 <?php }
					
			}?>

<?php }  


else if($type == 'suspended_providers'){ ?>

<?php
            if(isset($suspendedProviders)){
                foreach($suspendedProviders as $list){
                    ?>	
<tr><td><span class='bold'><?=$list['name']?></span>
<br><span class='grey-box'><?=$list['category']?></span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Registered: <?=date(SHORT_DATE_FORMAT, strtotime($list['date_registered']))?><br>
Expires: todo</td></tr>

                    <?php }
					
			}
			
else { 
	echo "<tr><td>".format_notice($this, 'WARNING: No suspended list at the moment.')."</td></tr>";
}			?>
		

<?php }  







else if($type == 'documents'){ ?>

<?php
            if(isset($documentsList)){
                foreach($documentsList as $list){
                    ?>
<tr><td class=<?=document_class($list['url']).'-icon-row'?>><span class='bold'><a href="<?=base_url().'pages/download/file/'.$list['url']?>"><?=$list['name']?></a></span>
<br><span class='grey-box'><?=$list['category']?></span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Posted: <?=date(SHORT_DATE_FORMAT, strtotime($list['date_entered']))?> <br>Size: <?=format_number($list['size'],3)."B"?></td></tr>

                    <?php }
                    
                    }?>
<?php }  


else if($type == 'important_links'){ ?>

<?php
            if(isset($linksList)){
                foreach($linksList as $list){
                    ?>
<tr><td colspan="2" ><span class='bold'><a href=<?=$list['url'].apply_open_type($list['open_type'], 'closable')?>><?=$list['name']?></a></span>
  </td>
</tr>
<?php }

	}?>

<?php }  


else if($type == 'standards'){ ?>
<?php
            if(isset($standardList)){
                foreach($standardList as $list){
                    ?>
<tr><td class=<?=document_class($list['url']).'-icon-row'?>><span class='bold'><a href="<?=base_url().'pages/download/file/'.$list['url']?>"><?=$list['name']?></a></span>
<br><span class='grey-box'><?=$list['category']?></span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Posted: <?=date(SHORT_DATE_FORMAT, strtotime($list['date_entered']))?> <br>Size: <?=format_number($list['size'],3)."B"?></td></tr>

                    <?php }
                    
                    }?>
<?php }  

else if($type == 'training_activities'){ ?>

<?php
            if(isset($trainingList)){
                foreach($trainingList as $list){
                    ?>

<tr><td ><span class='bold'><a href="<?=base_url().'training/description/d/'.$list['training_id'] ?>"class='shadowbox closable'><?=$list['subject']?></a></span>
<br><span class='grey-box'><?=ucwords(str_replace('_',' ',$list['category']))?></span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Date: <?=date(FULL_DATE_FORMAT, strtotime($list['event_time']))?><br>Duration: <?=$list['duration'].'hrs'?></td>
 </tr>

<?php }
  
			}?>
<?php }  


else if($type == 'public_forums'){ ?>

<?php
            if(isset($publicForumsList)){
                foreach($publicForumsList as $list){
                    ?>

<tr><td><span class='bold'><a href="<?=base_url()?>forums/view_one/d/<?=$list['forum_id']?>" class='shadowbox closable'><?=$list['topic']?></a></span>
<br><span class='grey-box'><?=$list['category']?></span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Started: <?=date(SHORT_DATE_FORMAT, strtotime($list['last_updated']))?><br>Contributors: <?=$list['no_of_contributors']?></td></tr>

<?php }
  
			}?>

<?php } 

else if($type == 'secure_forums'){ ?>

<?php
            if(isset($publicForumsList)){
                foreach($publicForumsList as $list){
                    ?>

<tr><td><span class='bold'><a href="<?=base_url()?>forums/view_one/d/<?=$list['forum_id']?>" class='shadowbox closable'><?=$list['topic']?></a></span>
<br><span class='grey-box'><?=$list['category']?></span></td>
<td class='dark-grey' style="width:1%;white-space:nowrap;">Started: <?=date(SHORT_DATE_FORMAT, strtotime($list['last_updated']))?><br>Contributors: <?=$list['no_of_contributors']?></td></tr>

<?php }
  
			}?>
<?php } 

else if($type == 'frequently_asked_questions'){ ?>
<?php
            if(isset($faqList)){
                foreach($faqList as $list){
                    ?><tr><td ><span class='bold'><?=$list['question']?></span></td><td colspan="3"><?=$list['answer']?></td></tr>
 <?php }
  
			}?>
<?php } 

else { 
	echo "<tr><td>".format_notice($this, 'WARNING: List can not be generated.')."</td></tr>";
}?>










</table></div>