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
				
				
				
				
				
				
				case 'procurement_plan':
					$this->load->model('_procurement_plan');
					$data = restore_bad_chars_in_array($data);
					
					# Store in session for the filter to use
					$this->native_session->set($data['t'].'__pde_id', (!empty($data['pde_id'])? $data['pde_id']: ''));
					$this->native_session->set($data['t'].'__status', (!empty($data['status'])? $data['status']: ''));
					$this->native_session->set($data['t'].'__phrase', (!empty($data['phrase'])? $data['phrase']: ''));
					
					$data['list'] = $this->_procurement_plan->lists(array(
						'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),  
						'status'=>$this->native_session->get($data['t'].'__status'),
						'phrase'=>$this->native_session->get($data['t'].'__phrase'), 
						'offset'=>$offset, 
						'limit'=>$limit
					));
					
					$this->load->view('procurement_plans/procurement_plan_list', $data);
				break;
				
				
				
				
				
				
				case 'tender':
					$this->load->model('_tender');
					$data = restore_bad_chars_in_array($data);
					
					# Store in session for the filter to use
					$this->native_session->set($data['t'].'__procurement_type', (!empty($data['procurement_type'])? $data['procurement_type']: ''));
					$this->native_session->set($data['t'].'__procurement_method', (!empty($data['procurement_method'])? $data['procurement_method']: ''));
					$this->native_session->set($data['t'].'__pde', (!empty($data['pde'])? $data['pde']: ''));
					$this->native_session->set($data['t'].'__pde_id', (!empty($data['pde_id'])? $data['pde_id']: ''));
					$this->native_session->set($data['t'].'__by_deadline', (!empty($data['by_deadline'])? $data['by_deadline']: ''));
					$this->native_session->set($data['t'].'__phrase', (!empty($data['phrase'])? $data['phrase']: ''));
					
					$data['list'] = $this->_tender->lists(array(
						'procurement_type'=>$this->native_session->get($data['t'].'__procurement_type'), 
						'procurement_method'=>$this->native_session->get($data['t'].'__procurement_method'),
						'pde'=>$this->native_session->get($data['t'].'__pde_id'),
						'by_deadline'=>$this->native_session->get($data['t'].'__by_deadline'),
						'phrase'=>$this->native_session->get($data['t'].'__phrase'), 
						'offset'=>$offset, 
						'limit'=>$limit
					));
					
					$this->load->view('tenders/'.($this->native_session->get('__user_type') == 'provider'? 'manage_list': 'tender_list'), $data);
				break;
				
				
				
				
				
				
				case 'bid':
					$this->load->model('_bid');
					$data = restore_bad_chars_in_array($data);
					
					# Store in session for the filter to use
					$this->native_session->set($data['t'].'__pde', (!empty($data['pde'])? $data['pde']: ''));
					$this->native_session->set($data['t'].'__pde_id', (!empty($data['pde_id'])? $data['pde_id']: ''));
					$this->native_session->set($data['t'].'__provider', (!empty($data['provider'])? $data['provider']: ''));
					$this->native_session->set($data['t'].'__provider_id', (!empty($data['provider_id'])? $data['provider_id']: ''));
					$this->native_session->set($data['t'].'__phrase', (!empty($data['phrase'])? $data['phrase']: ''));
					
					$data['list'] = $this->_bid->lists(array(
						'procurement_type'=>$this->native_session->get($data['t'].'__procurement_type'), 
						'procurement_method'=>$this->native_session->get($data['t'].'__procurement_method'),
						'pde'=>$this->native_session->get($data['t'].'__pde_id'),
						'by_deadline'=>$this->native_session->get($data['t'].'__by_deadline'),
						'phrase'=>$this->native_session->get($data['t'].'__phrase'), 
						'offset'=>$offset, 
						'limit'=>$limit
					));
					
					$this->load->view('tenders/tender_list', $data);
				break;
				
				
				
				
				
				
				
				case 'mybid':
					$this->load->model('_bid');
					$data = restore_bad_chars_in_array($data);
					
					# Store in session for the filter to use
					$this->native_session->set($data['t'].'__pde', (!empty($data['pde'])? $data['pde']: ''));
					$this->native_session->set($data['t'].'__pde_id', (!empty($data['pde_id'])? $data['pde_id']: ''));
					$this->native_session->set($data['t'].'__submit_from', (!empty($data['submit_from'])? $data['submit_from']: ''));
					$this->native_session->set($data['t'].'__submit_to', (!empty($data['submit_to'])? $data['submit_to']: ''));
					$this->native_session->set($data['t'].'__status', (!empty($data['status'])? $data['status']: ''));
					
					$data['list'] = $this->_bid->my_list(array(
						'pde'=>$this->native_session->get($data['t'].'__pde_id'), 
						'submit_from'=>$this->native_session->get($data['t'].'__submit_from'),
						'submit_to'=>$this->native_session->get($data['t'].'__submit_to'),
						'status'=>$this->native_session->get($data['t'].'__status'),
						'offset'=>$offset, 
						'limit'=>$limit
					));
					
					$this->load->view('bids/my_bid_list', $data);
				break;
				
				
				
				
						
				case 'contract':
					$this->load->model('_contract');
					$data = restore_bad_chars_in_array($data);
					
					# Store in session for the filter to use
					$this->native_session->set($data['t'].'__pde', (!empty($data['pde'])? $data['pde']: ''));
					$this->native_session->set($data['t'].'__pde_id', (!empty($data['pde_id'])? $data['pde_id']: ''));
					$this->native_session->set($data['t'].'__tender', (!empty($data['tender'])? $data['tender']: ''));
					$this->native_session->set($data['t'].'__tender_id', (!empty($data['tender_id'])? $data['tender_id']: ''));
					$this->native_session->set($data['t'].'__phrase', (!empty($data['phrase'])? $data['phrase']: ''));
					$this->native_session->set($data['t'].'__status', (!empty($data['status'])? $data['status']: ''));
					
					$data['list'] = $this->_contract->lists(array(
						'pde'=>$this->native_session->get($data['t'].'__pde_id'), 
						'tender'=>$this->native_session->get($data['t'].'__tender_id'),
						'phrase'=>$this->native_session->get($data['t'].'__phrase'),
						'status'=>$this->native_session->get($data['t'].'__status'),
						'offset'=>$offset, 
						'limit'=>$limit
					));
					
					$this->load->view('contracts/contract_list', $data);
				break;
				
				
				
				
				
				
				
				
				
				
				
				
			
				default:
				break;
			}
		}
	}
	
	
	
}

/* End of controller file */