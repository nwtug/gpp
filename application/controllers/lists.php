<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing sub-lists.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/12/2015
 */
class Lists extends CI_Controller 
{
	
	# Load a list's data
	function load()
	{
		$data = filter_forwarded_data($this);
					
		if(!empty($data['t']))
		{
			$limit = !empty($data['n'])? $data['n']: NUM_OF_ROWS_PER_PAGE;
			$offset = !empty($data['p'])? ($data['p'] - 1)*$limit: 0;
			
			
			# Dynamic loading of system's lists based on the list type and passed parameters
			switch($data['t'])
			{
				case 'audittrail':
					$this->load->model('_account');
					$data = restore_bad_chars_in_array($data);
					
					# Store in session for the filter to use
					$this->native_session->set($data['t'].'__date', (!empty($data['date'])? $data['date']: ''));
					$this->native_session->set($data['t'].'__user_id', (!empty($data['user_id'])? $data['user_id']: ''));
					$this->native_session->set($data['t'].'__activity_code', (!empty($data['activity_code'])? $data['activity_code']: ''));
					$this->native_session->set($data['t'].'__phrase', (!empty($data['phrase'])? $data['phrase']: ''));
					$this->native_session->set($data['t'].'__name', (!empty($data['name'])? $data['name']: ''));
					
					$data['list'] = $this->_account->audit_trail(array(
						'date'=>$this->native_session->get($data['t'].'__date'), 
						'user_id'=>$this->native_session->get($data['t'].'__user_id'), 
						'activity_code'=>$this->native_session->get($data['t'].'__activity_code'), 
						'phrase'=>$this->native_session->get($data['t'].'__phrase'), 
						'offset'=>$offset, 
						'limit'=>$limit
					));
					
					$this->load->view('accounts/audit_list', $data);
				break;
				
				
				
				
				
				
				case 'provider':
					$this->load->model('_provider');
					$data = restore_bad_chars_in_array($data);
					
					# Store in session for the filter to use
					$this->native_session->set($data['t'].'__category', (!empty($data['category'])? $data['category']: ''));
					$this->native_session->set($data['t'].'__ministry', (!empty($data['ministry'])? $data['ministry']: ''));
					$this->native_session->set($data['t'].'__registration_country', (!empty($data['registration_country'])? $data['registration_country']: ''));
					$this->native_session->set($data['t'].'__phrase', (!empty($data['phrase'])? $data['phrase']: ''));
					
					$data['list'] = $this->_provider->lists(array(
						'category'=>$this->native_session->get($data['t'].'__category'), 
						'ministry'=>$this->native_session->get($data['t'].'__ministry'), 
						'registration_country'=>$this->native_session->get($data['t'].'__registration_country'), 
						'phrase'=>$this->native_session->get($data['t'].'__phrase'), 
						'offset'=>$offset, 
						'limit'=>$limit
					));
					
					$this->load->view('providers/provider_list', $data);
				break;
				
				
				
				
				
				
				
				
			
				default:
				break;
			}
		}
	}
	
	
	
}

/* End of controller file */