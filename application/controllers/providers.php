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
		$data['activeProvidersList'] = array();

		$this->load->view('providers/home', $data);
	}



	# providers lists
	function provider_list()
	{
		$data = filter_forwarded_data($this);

		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();

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
	
	# Filter home provider
	function home_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'active_providers') $filter = 'home_active_filter';
		else if($data['t'] == 'suspended_providers') $filter = 'home_suspended_filter';
		$this->load->view('providers/'.$filter, $data);
	}
	{

# View details of a provider
	function details()
	{
		$data = filter_forwarded_data($this);
		$this->load->model('_user');

		$data['row']=$this->_user->get_info($this->uri->segment(4));

		$data['area'] = 'user_details';
		$this->load->view('addons/basic_addons', $data);


	}

}

/* End of controller file */