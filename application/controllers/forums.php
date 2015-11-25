<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing forums pages. [Renamed from FAQs]
 *
 * @author David Buwembo <dbuwembo@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/2/2015
 */
class Forums extends CI_Controller 
{
	# faqs home page
	function index()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['a'])) $data['area'] = $data['a'];
		$data['publicForumsList'] = array();
		
		$this->load->view('forums/home', $data);
	}
	
	
	
	# forums lists
	function forums_list()
	{
		$data = filter_forwarded_data($this);
		
		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();
		
		$this->load->view('forums/details_list', $data);
	}
	
	
	# Filter resources details
	function home_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'public_forums') $filter = 'public_list_filter';
		else if($data['t'] == 'secure_forums') $filter = 'secure_list_filter';
		else if($data['t'] == 'frequently_asked_questions') $filter = 'faq_list_filter';
		
		$this->load->view('forums/'.$filter, $data);
	}
	
	# Filter home portal resources
	function home_portal_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'public_forums') $filter = 'public_portal_list_filter';
		else if($data['t'] == 'secure_forums') $filter = 'secure_portal_list_filter';
		else if($data['t'] == 'frequently_asked_questions') $filter = 'faq_portal_list_filter';
		
		$this->load->view('forums/'.$filter, $data);
	}
	
	
}

/* End of controller file */