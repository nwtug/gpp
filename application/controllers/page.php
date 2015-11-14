<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing public pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 10/20/2015
 */
class Page extends CI_Controller
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

		# Collect all data needed for the UI
		$data['procurementPlanList'] = array();
		$data['activeProvidersList'] = array();
		$data['documentsList'] = array();
		$data['publicForumsList'] = array();

		$this->load->view('home_portal', $data);
	}


	# load a home list
	function home_list()
	{
		$data = filter_forwarded_data($this);

		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();

		$this->load->view('page/home_list', $data);
	}


	# about us page
	function about()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('page/about', $data);
	}

	# terms of use page
	function terms_of_use()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('page/terms_of_use', $data);
	}

	# privacy policy page
	function privacy_policy()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('page/privacy_policy', $data);
	}

	# providers page
	function providers()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('page/providers', $data);
	}

	# government agencies page
	function government_agencies()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('page/government_agencies', $data);
	}

	# standards page
	function standards()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('page/standards', $data);
	}

	# verify a document page
	function verify()
	{
		$data = filter_forwarded_data($this);

		# assumption a certificate belongsTo an organisation (one-to-one relationship)
		# if form is submitted
		if (!empty($_POST)) {

			# check if verification number exists (Expected result is boolean)
			$msg = $this->_page->verify_certificate($_POST) ? 'Document exists' : 'ERROR: Document does not exist';

			$this->native_session->set('msg', $msg);

		} else
			$this->load->view('page/verify_document', $data);
	}

	# contact us page
	function contact_us()
	{
		$data = filter_forwarded_data($this);

		if (!empty($_POST)) {
			$msg = $this->_page->send_contact_message($_POST) ? 'Your message has been sent' : 'ERROR: Your message could not be sent';
			$this->native_session->set('msg', $msg);
		} else $this->load->view('page/contact_us', $data);
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
}

/* End of controller file */