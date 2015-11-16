<?php
/**
 * This class generates and formats provider details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class _provider extends CI_Model
{
	# list of providers
	function lists($scope=array('phrase'=>'', 'registration_country'=>'', 'category'=>'', 'ministry'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_provider_list', array(
			'category_condition'=>(!empty($scope['category'])? " AND _category_id='".$scope['category']."' ": ''),
			
			'ministry_condition'=>(!empty($scope['ministry'])? " AND _ministry_id='".$scope['ministry']."' ": ''),
			
			'country_condition'=>(!empty($scope['category'])? " AND _registration_country_id='".$scope['registration_country']."' ": ''),
			'phrase_condition'=>(!empty($scope['phrase'])? " AND MATCH(name) AGAINST ('+\"".htmlentities($scope['phrase'], ENT_QUOTES)."\"')": ''),
			
			'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}
	
	
	
	
	
	
	
	
	
}


?>