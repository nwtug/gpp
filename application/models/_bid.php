<?php
/**
 * This class generates and formats bid details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class _bid extends CI_Model
{
	# list of procurement plans
	function lists($status, $scope=array('phrase'=>'', 'pde'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_bid_list', array(
			'pde_condition'=>(!empty($scope['pde'])? " AND _organization_id='".$scope['pde']."' ": ''),
			'phrase_condition'=>(!empty($scope['phrase'])? " HAVING provider LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
			'status_condition'=>($status == 'awarded'? " AND status = 'awarded' ": ('best_bidders'? " AND status = 'won' ": '')), 
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	
	
	
	
}


?>