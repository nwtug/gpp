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
		if(!empty($data['a'])) $data['area'] = $data['a'];
		$data['activeProvidersList'] =$this->_provider->lists();
		
		//loop thru statuses
		$suspendedProviders = array();
		foreach($this->_provider->lists() as $row){
			if(strtolower($row['status'])!=='active'){
				$suspendedProviders[]=$row;
			}
		}
		
		$data['suspendedProviders']=$suspendedProviders;
		
		//print_array($data);


		$this->load->view('providers/home', $data);
	}



	# providers lists
	function provider_list()
	{
		$data = filter_forwarded_data($this);

		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();
		$data['activeProvidersList'] =$this->_provider->lists();

		$this->load->view('providers/details_list', $data);
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
	
	
	
	# Filter provider
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('providers/list_filter', $data);
	}
	
<<<<<<< HEAD
	# Filter home provider
	function home_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'active_providers') $filter = 'home_active_filter';
		else if($data['t'] == 'suspended_providers') $filter = 'home_suspended_filter';
		$this->load->view('providers/'.$filter, $data);
	}
	
	# Filter home portal providers
	function home_portal_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'active_providers') $filter = 'home_portal_active_filter';
		else if($data['t'] == 'suspended_providers') $filter = 'home_portal_suspended_filter';
		$this->load->view('providers/'.$filter, $data);
	}


# View details of a provider
	function details()
	{
		$data = filter_forwarded_data($this);
		$this->load->model('_user');

		$data['row']=$this->_user->get_info($this->uri->segment(4));

		$data['area'] = 'user_details';
		$this->load->view('addons/basic_addons', $data);


	}

=======
	
	
	
	
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
	
>>>>>>> 15f858f3fd0a8925b751d6626671b3af3e6634a0
}

/* End of controller file */