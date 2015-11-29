<?php
/**
 * This class generates and formats organization details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/26/2015
 */
class _organization extends CI_Model
{
	
	# get organization details
	function details($id='')
	{
		return $this->_query_reader->get_row_as_array('get_organization_details_by_id', array(
				'organization_id'=>(!empty($id)? $id: $this->native_session->get('__organization_id')) 
			));
	}
	
	
	
	
	# save organization settings
	function settings($data)
	{
		# a) save the main record
		$result = $this->_query_reader->run('update_organization_settings', array(
				'logo_url'=>$data['logo_url'], 
				'name'=>htmlentities($data['name'], ENT_QUOTES),  
				'description'=>htmlentities($data['description'], ENT_QUOTES),
				'contact_address'=>$data['address'],
				'contact_city'=>$data['city'], 
				'contact_region'=>$data['region'], 
				'contact_zipcode'=>$data['zipcode'], 
				'contact_country_id'=>$data['contact__countries'], 
				'date_established'=>(!empty($data['registrationdate'])? $data['registrationdate']: ''),  
				'registration_number'=>$data['registrationno'],  
				'registration_country_id'=>(!empty($data['registration__countries'])? $data['registration__countries']: ''),
				'user_id'=>$this->native_session->get('__user_id'),
				'organization_id'=>$this->native_session->get('__organization_id')
			));
		
		# d) log action
		$this->_logger->add_event(array(
			'user_id'=>$this->native_session->get('__user_id'), 
			'activity_code'=>'updated_organization_settings', 
			'result'=>($result? 'SUCCESS': 'FAIL'), 
			'log_details'=>"organization_id=".$this->native_session->get('__organization_id')."|device=".get_user_device()."|browser=".$this->agent->browser(),
			'uri'=>uri_string(),
			'ip_address'=>get_ip_address()
		));
		
		return array('boolean'=>$result, 'reason'=>'');
	}
	
	
	
	
}


?>