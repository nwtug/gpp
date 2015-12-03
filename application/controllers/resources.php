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
	
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_document');
        $this->load->model('_link');
        $this->load->model('_training');


	}
	
	# resources home page
	function index()
	{
		$data = filter_forwarded_data($this);
		$data['area'] = !empty($data['a'])? $data['a']: '';
		if(!empty($data['a'])) $data['area'] = $data['a'];
		$data['documentsList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'system');
		$data['standardList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'standard');
		$data['linksList'] = $this->_link->lists();
		$data['trainingList'] = $this->_training->lists();

		//print_array($data);
		$this->load->view('resources/home', $data);
	}
	
	
	
	# documents lists
	function documents_list()
	{
		$data = filter_forwarded_data($this);
		
		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
        $data['area'] = !empty($data['a'])? $data['a']: '';
		if(!empty($data['a'])) $data['area'] = $data['a'];
		$data['documentsList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'system');
		$data['standardList'] = $this->_document->lists(!empty($data['a'])? $data['a']: 'standard');
		$data['linksList'] = $this->_link->lists();
		$data['trainingList'] = $this->_training->lists();

		$this->load->view('resources/details_list', $data);
	}
	
	# Filter home resources
	function home_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'documents') $folder = 'documents';
		else if($data['t'] == 'important_links') $folder = 'links';
		else if($data['t'] == 'standards') $folder = 'standards';
		else if($data['t'] == 'training_activities') $folder = 'training';
		$this->load->view($folder.'/detail_list_filter', $data);
	}
	
	# Filter home portal resources
	function home_portal_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'documents') $folder = 'documents';
		else if($data['t'] == 'important_links') $folder = 'links';
		else if($data['t'] == 'standards') $folder = 'standards';
		else if($data['t'] == 'training_activities') $folder = 'training';
		$this->load->view($folder.'/portal_list_filter', $data);
	}
	
	
	
}

/* End of controller file */