<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing public pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 10/20/2015
 */
class Pages extends CI_Controller 
{

	#Constructor to set some default values at class load
	public function __construct()
	{
		parent::__construct();
		$this->load->model('_page');

	}

	# home page
	function index()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('home', $data);
	}


	# portal home page
	function portal()
	{
		$data = filter_forwarded_data($this);

		# Load required modules
		$this->load->model('_procurement_plan');
		$this->load->model('_provider');
		$this->load->model('_bid');
		$this->load->model('_document');
		$this->load->model('_link');

		# Collect all data needed for the UI

		$data['procurementPlanList'] = $this->_procurement_plan->lists();
		$data['activeProvidersList'] = $this->_provider->lists();
		$data['documentsList'] = array(
				Array
				(
						'id' => 10,
						'name' => 'Public Procurement Bill MoFEP',
						'date_entered' => '2015-11-16'
				),
				Array
				(
						'id' => 11,
						'name' => 'Public Disposal Bill MoFEP',
						'date_entered' => '2015-11-16'
				)
		);
		$data['publicForumsList'] = array();
		$data['publicLinksList'] =  array(
				Array
				(
						'id' => 10,
						'name' => 'How to register'
				),
				Array
				(
						'id' => 11,
						'name' => 'Dangers in breaching contracts'
				)
		);

		# dummy data
		$data['suspendedProvidersList'] = Array
		(
				'organization_id' => 10,
				'status' => 'suspended',
				'date_registered' => '0000-00-00',
				'expires' => 'Indefinate',
				'contact_name' => 'African United Co. Limited ',
				'category' => 'Audit',
				'ministry' => '',
				'country' => 'Republic of South Sudan'
		);

		//print_array($data);
		$this->load->view('home_portal', $data);
	}


	# load a home list
	function home_list()
	{
		$data = filter_forwarded_data($this);

		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();
		$this->load->view('pages/home_list', $data);
	}


	# about us page
	function about()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('pages/about', $data);
	}

	# terms of use page
	function terms_of_use()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('pages/terms_of_use', $data);
	}

	# privacy policy page
	function privacy_policy()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('pages/privacy_policy', $data);
	}

	# providers page
	function providers()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('pages/providers', $data);
	}

	# government agencies page
	function government_agencies()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('pages/government_agencies', $data);
	}

	# standards page
	function standards()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('pages/standards', $data);
	}

	# verify a document page
	function verify()
	{
		$data = filter_forwarded_data($this);
		 $this->load->view('pages/verify_document', $data);
	}

# Get values filled in by a form layer and put them in a session for layer use
	function get_layer_form_values()
	{
		$data = filter_forwarded_data($this);
		
		switch($data['type'])
		{
			
			
			case 'verify_document':
				# check if verification number exists (Expected result is boolean)
				$msg = $this->_page->verify_document($_POST) ? 'Document exists' : 'ERROR: Document does not exist';

				$this->native_session->set('msg', $msg);


				$data['msg'] = $msg;
				
			break;
			
			default:
			break;
		}
		
		$data['area'] = "basic_msg";
		$this->load->view('addons/basic_addons', $data);
	}
	

	# contact us page
	function contact_us()
	{
		$data = filter_forwarded_data($this);

		if(!empty($_POST)) {
			$msg = $this->_page->send_contact_message($_POST)? 'Your message has been sent': 'ERROR: Your message could not be sent';
			$this->native_session->set('msg',$msg);
		}
		else $this->load->view('pages/contact_us', $data);
	}


	# Generate a custom drop down list
	function get_custom_drop_list()
	{
		$data = filter_forwarded_data($this);

		if (!empty($data['type'])) {
			$searchBy = !empty($data['search_by']) ? $data['search_by'] : '';
			$data['list'] = get_option_list($this, $data['type'], 'div', $searchBy, $data);
		}

		$data['area'] = "dropdown_list";
		$this->load->view('addons/basic_addons', $data);
	}

	
	
	
	
	
	# Download a document
	function download()
	{
		$data = filter_forwarded_data($this);
		if(!empty($data['file'])) force_download((!empty($data['folder'])? $data['folder']: ''),$data['file']);
	}
	

}

/* End of controller file */