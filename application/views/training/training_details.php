<?php 
$stopHtml = "<input name='paginationdiv__resources_stop' id='paginationdiv__resources_stop' type='hidden' value='1' />";

$listCount = count($list);
$i = 0;

echo "<table><tr><th>Name</th>
  <th>Category</th>
  <th>Event Date, Time</th>
  <th>Duration</th>
  <th colspan='2'>Posted</th></tr>
";

foreach($list AS $row) {
		$i++;
		echo "
<tr><td ><a href=".base_url().'training/description/d/'.$row['training_id']." class='shadowbox closable'>".$row['subject']."</a></td><td>".ucwords(str_replace('_',' ',$row['category']))."</td>
  <td>".date(FULL_DATE_FORMAT, strtotime($row['event_time']))."</td>
  <td>".$row['duration']."hrs</td>
  <td colspan='2'>".date(SHORT_DATE_FORMAT, strtotime($row['date_entered']))."</td></tr>
<tr>";
		
		 # Check whether you need to stop the loading of the next pages
		if($i == $listCount && ((!empty($n) && $listCount < $n) || (empty($n) && $listCount < NUM_OF_ROWS_PER_PAGE))){
		 echo $stopHtml;
		}
		  echo "</td></tr>";
		  }
echo "</table>";
?>
      
      <?php
            if(isset($trainingList)){
                foreach($trainingList as $list){
                    ?>
<tr><td ><a href="<?=base_url().'training/description/d/'.$list['training_id'] ?>"class='shadowbox closable'><?=$list['subject']?></a></td><td ><?=ucwords(str_replace('_',' ',$list['category']))?></td><td><?=date(FULL_DATE_FORMAT, strtotime($list['event_time']))?></td>
  <td ><?=$list['duration'].'hrs'?></td><td ><?=date(SHORT_DATE_FORMAT, strtotime($list['date_entered']))?></td></tr>
  
  <?php }
  
			}?>
      