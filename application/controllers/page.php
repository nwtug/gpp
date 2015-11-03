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
	
	# Verify a document page
	function verify()
	{
		$data = filter_forwarded_data($this);
		
		$this->load->view('page/verify_document', $data);
	}
	
	# Contact Us page
	function contact_us()
	{
		$data = filter_forwarded_data($this);
		
		$this->load->view('page/contact_us', $data);
	}
	
}

/* End of controller file */