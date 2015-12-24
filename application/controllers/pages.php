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
		$this->load->model('_procurement_plan');
		$this->load->model('_provider');
		$this->load->model('_document');
        $this->load->model('_forum');
		
		$this->native_session->set('__view', 'portal');

		# Collect all data needed for the UI
		$data['procurementPlanList'] = $this->_procurement_plan->lists(array('status'=>'published', 'offset'=>0, 'limit'=>NUM_OF_ROWS_PER_PAGE));
		$data['activeProviderList'] = $this->_provider->lists(array('status'=>'active', 'offset'=>0, 'limit'=>NUM_OF_ROWS_PER_PAGE));
		$data['documentList'] = $this->_document->lists('system');
		$data['publicForumList'] = $this->_forum->lists(array('is_public'=>'Y', 'offset'=>0, 'limit'=>NUM_OF_ROWS_PER_PAGE));
		
		
		$data['procurementPlanLatestDate'] = $this->_procurement_plan->statistics('latest_date');
		$data['activeProviderLatestDate'] = $this->_provider->statistics('latest_date');
		$data['documentLatestDate'] = $this->_document->statistics('latest_date');
		$data['publicForumLatestDate'] = $this->_forum->statistics('latest_date');
		
		
		$this->load->view('home_portal', $data);
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

	# authority page
	function authority()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('pages/authority', $data);
	}
	
	# regulations page
	function regulations()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('pages/regulations', $data);
	}
	
	# registration requirements page
	function registration_requirements()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('pages/registration_requirements', $data);
	}

	# government agencies page
	function government_agencies()
	{
		$data = filter_forwarded_data($this);
        $this->load->model('_organization');
		$data['list'] = $this->_organization->lists(array('type'=>'pde', 'offset'=>0, 'limit'=>50));
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
		
		# user has posted the document details
		if(!empty($_POST)){
			$this->load->model('_document');
			$response = $this->_document->verify($_POST);
			
			$msg = $response['boolean']? 'Document is VALID.': 'WARNING: Document is INVALID';
			if(!empty($response['expiry_date'])) {
				$msg .= '<br>Expiry Date: '.date(SHORT_DATE_FORMAT, strtotime($response['expiry_date']));
			}
			echo format_notice($this, $msg);
		}
		else $this->load->view('pages/verify_document', $data);
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
	
	
	
	
	
	# system search
	function system_search()
	{
		$data = filter_forwarded_data($this);
		
		# force to public if user is not logged in
		if(!(!empty($data['t']) && $data['t'] == 'secure' && $this->native_session->get('__user_id'))) $data['t'] = 'public';
		# default area to empty string (e.g. for public search)
		if(empty($data['area'])) $data['area'] = '';
		
		$this->load->view('pages/system_search', $data);
	}
	
	
	
	
}

/* End of controller file */