<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing faqs pages.
 *
 * @author David Buwembo <dbuwembo@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/2/2015
 */
class Faqs extends CI_Controller 
{
	# faqs home page
	function index()
	{
		$data = filter_forwarded_data($this);
		$data['publicForumsList'] = array();
		
		$this->load->view('faqs/home', $data);
	}
	
	
	
	# faqs lists
	function faqs_list()
	{
		$data = filter_forwarded_data($this);
		
		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();
		
		$this->load->view('faqs/details_list', $data);
	}
	
	
	
	
	
	
}

/* End of controller file */