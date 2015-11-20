<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing resources pages.
 *
 * @author David Buwembo <dbuwembo@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/2/2015
 */
class Resources extends CI_Controller 
{
	# resources home page
	function index()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['a'])) $data['area'] = $data['a'];
		$data['documentsList'] = array();
		
		$this->load->view('resources/home', $data);
	}
	
	
	
	# documents lists
	function documents_list()
	{
		$data = filter_forwarded_data($this);
		
		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();
		
		$this->load->view('resources/details_list', $data);
	}
	
	
	# Filter home resources
	function home_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'documents') $list = 'document_list_filter';
		else if($data['t'] == 'important_links') $list = 'links_list_filter';
		else if($data['t'] == 'standards') $list = 'standards_list_filter';
		else if($data['t'] == 'training_activities') $list = 'training_list_filter';
		$this->load->view('resources/'.$list, $data);
	}
	
	
	
}

/* End of controller file */