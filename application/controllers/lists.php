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
					
					if(isset($data['hiddenid'])){
						#switch lists based on active tab
						switch($data['hiddenid']){
							# get procurement plans
							case 'active':
							 $this->load->model('_provider');
								$data['list'] = $this->_provider->lists(array(
									'category__businesscategories'=>$this->native_session->get($data['t'].'__category'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));
                               $data['status'] = 'active';
								$this->load->view('providers/provider_home_details', $data);

								break;
								
								
								case 'suspended':
							 $this->load->model('_provider');
								$data['list'] = $this->_provider->lists(array(
									'category__businesscategories'=>$this->native_session->get($data['t'].'__category'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));
                               $data['status'] = 'suspended';

								$this->load->view('providers/provider_home_details', $data);

								break;
								
								default:
					
					
					$this->load->view('providers/provider_list', $data);
					}
					}
				break;
				
				
				
				
				
				
				case 'procurement_plan':
					$this->load->model('_procurement_plan');
					$data = restore_bad_chars_in_array($data);
					
					# Store in session for the filter to use
					$this->native_session->set($data['t'].'__pde_id', (!empty($data['pde_id'])? $data['pde_id']: ''));
					$this->native_session->set($data['t'].'__phrase', (!empty($data['phrase'])? $data['phrase']: ''));
					
					$data['list'] = $this->_procurement_plan->lists(array(
						'pde_id'=>$this->native_session->get($data['t'].'__pde_id'), 
						'phrase'=>$this->native_session->get($data['t'].'__phrase'), 
						'offset'=>$offset, 
						'limit'=>$limit
					));
					
					$this->load->view('procurement_plans/procurement_plan_list', $data);
				break;
				
							
				
				
				case 'tender':
					$this->load->model('_tender');
					$this->load->model('_procurement_plan');
					$data = restore_bad_chars_in_array($data);
					# Store in session for the filter to use
					$this->native_session->set($data['t'].'__disposal_entity', (!empty($data['disposal_entity'])? $data['disposal_entity']: ''));

					$this->native_session->set($data['t'].'__procurement_type', (!empty($data['procurement_type'])? $data['procurement_type']: ''));
					$this->native_session->set($data['t'].'__procurement_method', (!empty($data['procurement_method'])? $data['procurement_method']: ''));
					$this->native_session->set($data['t'].'__pde', (!empty($data['pde'])? $data['pde']: ''));
					$this->native_session->set($data['t'].'__by_deadline', (!empty($data['by_deadline'])? $data['by_deadline']: ''));
					$this->native_session->set($data['t'].'__phrase', (!empty($data['phrase'])? $data['phrase']: ''));
					$this->native_session->set($data['t'].'__hiddenid', (!empty($data['hiddenid'])? $data['hiddenid']: ''));

					# if filter form details are posted
					if(isset($data['hiddenid'])){
						#switch lists based on active tab
						switch($data['hiddenid']){
							# get procurement plans
							case 'plans':
								$data['list'] = $this->_procurement_plan->lists(array(
									'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('procurement_plans/home_details', $data);

								break;
								
								# get procurement plans home
							case 'planshome':
								$data['list'] = $this->_procurement_plan->lists(array(
									'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('procurement_plans/home_portal_details', $data);

								break;

                            # get best evaluated bidder 
							case 'best_evaluated_bidder':
								$data['list'] = $this->_procurement_plan->lists(array(
									'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('bids/home_details', $data);
								
								break;
								
								 # get best evaluated bidder home
							case 'best_evaluated_bidderhome':
								$data['list'] = $this->_procurement_plan->lists(array(
									'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('bids/home_portal_details', $data);
								
								break;
								
								# get contracts
								case 'contractawards':
								$data['list'] = $this->_procurement_plan->lists(array(
									'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('contracts/home_details', $data);

								break;
								
								# get contracts home
								case 'contractawardshome':
								$data['list'] = $this->_procurement_plan->lists(array(
									'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('contracts/home_portal_details', $data);

								break;
								
							# get notices
							case 'activenotices':
					        $this->load->model('_bid');
								$data['list'] = $this->_bid->lists(array(
									'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('tenders/home_list_details', $data);

								break;
								
								# get notices home
							case 'activenoticeshome':
					        $this->load->model('_bid');
								$data['list'] = $this->_bid->lists(array(
									'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('tenders/home_portal_details', $data);

								break;
								
								# get notices on home portal
							case 'activenoticeshome':
					        $this->load->model('_bid');
								$data['list'] = $this->_bid->lists(array(
									'pde_id'=>$this->native_session->get($data['t'].'__pde_id'),
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('tenders/home_portal_details', $data);

								break;
							default:
								# fall backtr
								$this->load->view('tenders/tender_list', $data);
						}
					}




					

				break;
				
				
				
				
					case 'resources':
					
                    if(isset($data['hiddenid'])){
						#switch lists based on active tab
						switch($data['hiddenid']){
							# get procurement plans
							case 'documentportalfilter':
							 $this->load->model('_resource');
								$data['list'] = $this->_resource->lists(array(
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('resources/document_home_details', $data);

								break;
								
								case 'linksportalfilter':
							 $this->load->model('_resource');
								$data['list'] = $this->_resource->lists(array(
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('resources/links_home_details', $data);

								break;
								
								case 'standard':
							 $this->load->model('_resource');
								$data['list'] = $this->_resource->lists(array(
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('resources/standard_home_details', $data);

								break;
								
								case 'training':
							 $this->load->model('_resource');
								$data['list'] = $this->_resource->lists(array(
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('resources/activity_home_details', $data);

								break;
								
								default:
					
					
                     $this->load->view('resources/details_list', $data);	
					 
					 }
					}					
					
					
				break;
				
				
				
				case 'forums':
					if(isset($data['hiddenid'])){
						#switch lists based on active tab
						switch($data['hiddenid']){
							# get procurement plans
							case 'public':
							 $this->load->model('_forum');
								$data['list'] = $this->_forum->lists(array(
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('forums/public_home_details', $data);
						
					
								break;
								
								
								case 'secure':
							 $this->load->model('_forum');
								$data['list'] = $this->_forum->lists(array(
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('forums/secure_home_details', $data);
						
					
								break;
								
								case 'faq':
							 $this->load->model('_forum');
								$data['list'] = $this->_forum->lists(array(
									'phrase'=>$this->native_session->get($data['t'].'__phrase'),
									'offset'=>$offset,
									'limit'=>$limit
								));

								$this->load->view('forums/faq_home_details', $data);
						
					
								break;
								
						
								
								default:
					
					
					$this->load->view('forums/details_list', $data);
					
					}
			}
				break;
				
				
				
				
				
				
				
			
				default:
				break;
			}
		}
	}
	
	
	
}

/* End of controller file */