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


        $this->load->model('_document');
        $this->load->model('_link');
        $this->load->model('_training');
		$this->load->model('_provider');
		$this->load->model('_page');
		$this->load->model('_tender');
		$this->load->model('_procurement_plan');
		$this->load->model('_tender');
		$this->load->model('_bid');
		$this->load->model('_contract');
        $this->load->model('_forum');
        $this->load->model('_faq');
        $this->load->model('_organization');
	}

	# home page
	function index()
	{
		$data = filter_forwarded_data($this);
		$data['procurementPlanList'] = $this->_procurement_plan->lists();
		$data['tenderList'] = $this->_tender->lists();
		$data['bebList'] = $this->_bid->lists(!empty($data['a'])? $data['a']: '');
		$data['contractList']=$this->_contract->lists();
		$data['activeProvidersList'] =$this->_provider->lists();
        $data['documentsList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'system');
		$data['standardList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'standard');
		$data['linksList'] = $this->_link->lists();
		$data['trainingList'] = $this->_training->lists();		
		$data['faqList'] = $this->_faq->lists();
		$data['publicForumsList']= $this->_forum->lists();
		$this->load->view('home', $data);
	}


	# portal home page
	function portal()
	{
		$data = filter_forwarded_data($this);

		# Collect all data needed for the UI
		
		$data['procurementPlanList'] = $this->_procurement_plan->lists();
		$data['tenderList'] = $this->_tender->lists();
		$data['bebList'] = $this->_bid->lists(!empty($data['a'])? $data['a']: '');
		$data['contractList']=$this->_contract->lists();
		$data['activeProvidersList'] =$this->_provider->lists();
        $data['documentsList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'system');
		$data['standardList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'standard');
		$data['linksList'] = $this->_link->lists();
		$data['trainingList'] = $this->_training->lists();		$data['publicForumsList'] = array();
        $data['faqList'] = $this->_faq->lists();
		$data['publicForumsList']= $this->_forum->lists();
		$data['secureForumsList']= $this->_forum->lists();	
		$data['faqList'] = $this->_faq->lists();
		$data['publicForumsList']= $this->_forum->lists();
		$this->load->view('home_portal', $data);
	}


	# load a home list
	function home_list()
	{
		$data = filter_forwarded_data($this);

		$data['type'] = $data['t'];
		
		
		switch($data['type'] )
		{
			case 'procurement_plans':
			$data['procurementPlanList'] = $this->_procurement_plan->lists();
						
			break;
			
			case 'active_notices':
			$data['tenderList'] = $this->_tender->lists();
			break;
			
			case 'best_evaluated_bidders':
			$data['bebList'] = $this->_bid->lists(!empty($data['a'])? $data['a']: '');
			break;
			
			case 'contract_awards':
			$data['contractList']=$this->_contract->lists();
			break;
			
			case 'active_providers':
			$data['activeProvidersList'] =$this->_provider->lists();
			break;
			
			case 'documents':
			$data['documentsList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'system');
			break;
			
			case 'standards':
			$data['standardList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'standard');
			break;
			
			case 'important_links':
			$data['linksList'] = $this->_link->lists();
			break;
			
			case 'training_activities':
			$data['trainingList'] = $this->_training->lists();	
			break;
			
			case 'frequently_asked_questions':
			$data['faqList'] = $this->_faq->lists();
			break;
			
			case 'public_forums':
			$data['publicForumsList']= $this->_forum->lists();
			break;
			
			case 'secure_forums':
		    $data['publicForumsList']= $this->_forum->lists();	
			break;
			
			 default:
			 break;
		}
		
				# TODO: Select list based on type passed
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
		//$data['pdeList']= $this->_organization->lists();
		$this->load->model('_query_reader');
		$data['pdeList'] = $this->_query_reader->get_list('search_pde_list', array('phrase'=>htmlentities('', ENT_QUOTES), 'limit_text'=>' LIMIT '.NUM_OF_ROWS_PER_PAGE));
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