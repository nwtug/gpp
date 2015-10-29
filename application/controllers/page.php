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
	
	
	
}

/* End of controller file */