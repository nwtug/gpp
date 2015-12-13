<div id="provider__1">
	<table>


		<?php if($type == 'active_providers'){ ?>
			<tr><th>Provider</th><th>Category</th><th>Registered</th><th>Location</th><th>Founded</th></tr>

		<?php
            if(isset($activeProvidersList)){
				$stopHtml = "<input name='paginationdiv__provider_stop' id='paginationdiv__provider_stop' type='hidden' value='1' />";
                $listCount = count($activeProvidersList);
				$i = 0;
                foreach($activeProvidersList as $list){
						$i++;
                    ?>
                    <tr>
                         <td><?=$list['name']?></td><td><?=$list['category']?></td>
                         <td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_created']))?></td>
                         <td><?=$list['address']?></td>
                         <td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_registered']))?>
                          <?php if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		              echo $stopHtml;
		           }
				   ?>
                         </td>
                      </tr>
                    <?php
					
					 }
					
			}?>
		<?php }

		else if($type == 'suspended_providers'){ ?>
			<tr><th>Provider</th><th>Category</th><th>Registered</th><th>Location</th><th>Founded</th></tr>

			<?php
            if(isset($suspendedProviders)){
				$stopHtml = "<input name='paginationdiv__provider_stop' id='paginationdiv__provider_stop' type='hidden' value='1' />";
                $listCount = count($activeProvidersList);
				$i = 0;
                foreach($suspendedProviders as $list){
					$i++;
                   ?>
                   <tr>
                       <td><?=$list['name']?></td>
                       <td><?=$list['category']?></td>
                       <td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_created']))?></td>
                       <td><?=$list['address']?></td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_registered']))?>
                       <?php if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		              echo $stopHtml;
		           }
				   ?>             
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