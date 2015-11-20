<?php
/**
 * This class generates and formats procurement plan details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class _procurement_plan extends CI_Model
{
	# list of procurement plans
	function lists($scope=array('phrase'=>'', 'pde'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_procurement_plan_list', array(
			'pde_condition'=>(!empty($scope['pde'])? " AND _organization_id='".$scope['pde']."' ": ''),
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	
	
	
	
}


?>