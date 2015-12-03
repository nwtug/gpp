<div id="provider__1">
	<table>


		<?php if($type == 'active_providers'){ ?>
			<tr><th>Provider</th><th>Category</th><th>Registered</th><th>Location</th><th>Founded</th></tr>

		<?php
            if(isset($activeProvidersList)){
                foreach($activeProvidersList as $list){
                    ?>	<tr><td><?=$list['name']?></td><td><?=$list['category']?></td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_created']))?></td><td><?=$list['address']?></td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_registered']))?></td></tr>
                    <?php }
					
			}?>
		<?php }

		else if($type == 'suspended_providers'){ ?>
			<tr><th>Provider</th><th>Category</th><th>Registered</th><th>Location</th><th>Founded</th></tr>

			<?php
            if(isset($suspendedProviders)){
                foreach($suspendedProviders as $list){
                    ?>	<tr><td><?=$list['name']?></td><td><?=$list['category']?></td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_created']))?></td><td><?=$list['address']?></td><td><?=date(SHORT_DATE_FORMAT, strtotime($list['date_registered']))?></td></tr>
                    <?php }
					
			}?>
		<?php }


		else {
			echo "<tr><td>".format_notice($this, 'WARNING: List can not be generated.')."</td></tr>";
		}?>


	</table>
</div>