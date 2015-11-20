<?php
/**
 * This class generates and formats bid details. 
 *
 * @author David Buwembo <dbuwembo@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/17/2015
 */
class _contract extends CI_Model
{
	# list of procurement plans
	function lists($scope=array('phrase'=>'', 'pde'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return array();/*$this->_query_reader->get_list('get_bid_list', array(
			'pde_condition'=>(!empty($scope['pde'])? " AND _organization_id='".$scope['pde']."' ": ''),
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));*/
	}
	
	
	
	
	
	
	
	
	
}


?>