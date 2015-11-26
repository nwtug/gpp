<?php
/**
 * This class generates and formats tender details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class _tender extends CI_Model
{
	# list of providers
	function lists($scope=array('phrase'=>'', 'procurement_type'=>'', 'procurement_method'=>'', 'pde'=>'', 'by_deadline'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_tender_list', array(
			'method_condition'=>(!empty($scope['procurement_method'])? " AND method='".$scope['procurement_method']."' ": ''),
			
			'type_condition'=>(!empty($scope['procurement_type'])? " AND category='".$scope['procurement_type']."' ": ''),
			
			'phrase_condition'=>(!empty($scope['phrase'])? " AND MATCH(name) AGAINST ('+\"".htmlentities($scope['phrase'], ENT_QUOTES)."\"')": ''),
			
			'deadline_condition'=>(!empty($scope['by_deadline'])? " AND DATE(deadline) <= DATE('".$scope['deadline']."') ": ''),
			
			'pde_condition'=>(!empty($scope['pde'])? " HAVING pde_id = '".$scope['pde']."' ": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	
	
	
	
}


?>