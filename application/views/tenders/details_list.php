<div id="tender__1">
  <table>



    <?php if($type == 'procurement_plans'){ ?>

     <tr><th>Procuring/Disposal Entity</th><th colspan="3">&nbsp;</th></tr>
        <?php
            if(isset($procurementPlanList)){
                foreach($procurementPlanList as $list){
                    ?>
                    <tr>
                        <td ><span class=""><?=$list['pde']?></span></td>
                        <td colspan="3"><a href="<?=base_url().'procurement_plans/view_one/d/'.$list['procurement_plan_id']?>" class="shadowbox blue-box closable">Details of <?=substr($list['financial_year_start'],0,4).'-'.substr($list['financial_year_end'],0,4) .' '.$list['name']?></a></td>
                    </tr>
                    <?php
                }

            }
        ?>

    <?php }

    else if($type == 'active_notices'){ ?>
      <tr><th>Procuring/Disposal Entity</th><th>Subject of Procurement</th><th>Procurement Type [Procurement Method]</th><th>Deadline</th></tr>
       <?php
            if(isset($tenderList)){
                foreach($tenderList as $list){
                    ?>
      
<tr><td ><?=$list['pde']?></td><td><?=$list['subject']?><br><a href="<?=base_url().'tenders/view_one/d/'.$list['tender_id']?>" class='shadowbox closable blue-box'>View Details</a>
</td>
  <td><span class="grey-box"><?=$list['procurement_type']?>  </span> <span class="dark-grey">[<?=ucwords(str_replace('_',' ',$list['procurement_method']))?>]</span></td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_created']))?></td></tr>
<?php
                }

            }?>
    <?php }

    else if($type == 'best_evaluated_bidders'){ ?>
      <tr><th>Date Posted</th><th>Procuring/Disposing Entity</th><th>Selected Provider</th><th>Subject</th><th>Date BEB Expires</th><th>Status</th><th>BEB Price</th></tr>
    <?php
            if(isset($bebList)){
                foreach($bebList as $list){
                    ?>   <tr><td ><?=date(SHORT_DATE_FORMAT, strtotime($list['last_updated']))?></td><td><?=$list['pde']?></td><td><?=$list['provider']?></td><td><?=$list['tender_notice']?><br><a href="<?=base_url().'bids/view_one/d/'.$list['bid_id']?>" class="shadowbox blue-box closable">View Details</a>
        </td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['valid_end_date']))?></td><td><div class="green-box"><?=$list['status']?></div></td><td><?=$list['bid_amount']?><?=$list['bid_currency']?></td></tr>
      <?php
                }

            }?>

    <?php }

    else if($type == 'contract_awards'){ ?>
      <tr><th>Procuring/Disposing Entity</th><th>Subject Of Procurement<br> </th><th>Service Provider</th><th>Date Signed</th><th>Date of Commencement <br>
          [Date of Completion]</th><th>Contract Value</th><th>Status</th></tr>
     <?php
            if(isset($contractList)){
                foreach($contractList as $list){
                    ?>    <tr><td><?=$list['pde']?> </td><td> <?=$list['tender_notice']?> <br>
          </td><td><?=$list['provider']?> </td><td><?=$list['date_started']?></td><td>to do <br>
         to do</td><td><?=$list['contract_amount']?><?=$list['contract_currency']?></td><td><div class="orange-box"><?=$list['status']?></div></td></tr>
      
 <?php
                }

            }?>
    <?php }

    else {
      echo "<tr><td>".format_notice($this, 'WARNING: List can not be generated.')."</td></tr>";
    }?>


  </table>
</div>