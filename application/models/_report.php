<?php
/**
 * This class manages reports. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/27/2015
 */
class _report extends CI_Model
{
	
	# advanced search list of bids
	function lists($scope=array('pde'=>'', 'provider'=>'', 'phrase'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		/*return $this->_query_reader->get_list('get_bid_list', array(
			'provider_condition'=>(!empty($scope['provider'])? " AND _organization_id='".$scope['pde']."' ": ''),
			
			'phrase_condition'=>(!empty($scope['phrase'])? " HAVING tender_notice LIKE '%".htmlentities($scope['phrase'], ENT_QUOTES)."%' ": ''),
			
			'pde_condition'=>(!empty($scope['pde'])? (!empty($scope['phrase'])? ' AND ': '')." pde_id = '".$scope['pde']."' ": ''),
			
			'status_condition'=>($status == 'awarded'? " AND status = 'awarded' ": ($status == 'best_bidders'? " AND status = 'won' ": '')), 
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));*/
		
		return array();
	}
	
}


?>