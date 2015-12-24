<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing provider pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 10/30/2015
 */
class Providers extends CI_Controller
{
	
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_provider');
	}
	
	# providers home page
	function index()
	{
		$data = filter_forwarded_data($this);
		$data['area'] = !empty($data['a'])? $data['a']: 'active_providers';
		$status = $data['area'] == 'suspended_providers'? 'suspended':'active';
		$this->native_session->delete('__view');
		
		$data['list'] = $this->_provider->lists(array('status'=>$status, 'offset'=>0, 'limit'=>NUM_OF_ROWS_PER_PAGE));
		$this->load->view('providers/home', $data);
	}



	# providers lists
	function provider_list()
	{
		$data = filter_forwarded_data($this);
		$data['area'] = !empty($data['t'])? $data['t']: 'active_providers';
		$status = $data['area'] == 'suspended_providers'? 'suspended':'active';
		
		$data['list'] = $this->_provider->lists(array('status'=>$status, 'offset'=>0, 'limit'=>NUM_OF_ROWS_PER_PAGE));
		$this->load->view('providers/details_list', $data);
	}
	
	
	
	# filter providers for the home page
	function home_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('providers/list_filter', $data);
	}
	
	
	
	# manage the providers list
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_provider->lists();
		
		$this->load->view('providers/manage', $data);
	}
	
	
	
	
	
	# provider list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'provider_list_actions', 'div');
	}
	
	
	
	# filter provider
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('providers/list_filter', $data);
	}




	# update a provider's status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $response = $this->_provider->update_status($data['t'], explode('--',$data['list']));
		
		# all good
		if(!empty($response) && $response['boolean']){
			$data['msg'] = 'The provider status has been updated.';
			$data['area'] = 'refresh_list_msg';
		} 
		# there was an error
		else {
			$data['msg'] = (!empty($data['t']) && !empty($data['list']))? 'ERROR: There was an error updating the provider status.': 'ERROR: This action can not be resolved';
			$data['area'] = 'basic_msg';
		}
		
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	
	# suspend a provider
	function suspend()
	{
		$data = filter_forwarded_data($this);
		
		# user has posted
		if(!empty($_POST)){
			$response = $this->_provider->suspend($_POST);
			# there was an error
			if(!(!empty($response) && $response['boolean'])) echo 'ERROR: There was an error suspending the selected providers.';
		} 
		# success
		else if(!empty($data['result'])){
			$data['msg'] = 'The selected providers have been suspended.';
			$data['area'] = 'refresh_list_msg';
			$this->load->view('addons/basic_addons', $data);
		}
		
		# simply going to a form
		else {
			$data['id_list'] = implode(',',explode('--',$data['list']));
			$this->load->view('providers/suspend', $data);
		}
	}
	
	
	
	# send a message to a list of selected providers
	function message()
	{
		$data = filter_forwarded_data($this);
		
		# user has posted
		if(!empty($_POST)){
			$response = $this->_provider->message($_POST);
			# there was an error
			if(!(!empty($response) && $response['boolean'])){
				$data['msg'] = 'ERROR: There was an error sending to';
				if(!empty($response['unsent'])) $data['msg'] .= ' the following emails: '.implode(', ', $response['unsent']);
				else $data['msg'] .= ' the selected providers.';
				
				$data['area'] = 'basic_msg';
			}
		} 
		# success
		else if(!empty($data['result'])){
			$data['msg'] = 'The messages have been sent.';
			$data['area'] = 'refresh_list_msg';
			$this->load->view('addons/basic_addons', $data);
		}
		
		# simply going to a form to send message
		else {
			$data['action'] = 'providers/message';
			$data['redirect'] = 'providers/message/result/sent';
			$data['id_list'] = implode(',',explode('--',$data['list']));
			$this->load->view('pages/send_from_list', $data);
		}
	}
	
	
	
	
	
	# generate a provider certificate
	function generate_certificate()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_POST)){
			$this->native_session->set('providerid', $_POST['providerid']);
			$this->native_session->set('amount_paid', $_POST['amount_paid']);
			$this->native_session->set('valid_until', $_POST['valid_until']);
		}
		
		# success
		else if(!empty($data['a'])){
			$response = $this->_provider->generate_certificate(array(
				'providerid'=>$this->native_session->get('providerid'),
				'amount_paid'=>$this->native_session->get('amount_paid'),
				'valid_until'=>$this->native_session->get('valid_until')
			));
			
			$data['msg'] = (!empty($response) && $response['boolean'])? 'The certificate has been generated.': 'ERROR: The certificate could not be generated.';
			$data['area'] = 'refresh_list_msg';
			$this->load->view('addons/basic_addons', $data);
		}
		
		else $this->load->view('providers/certificate_specs', $data);
	}
	
		
}

/* End of controller file */