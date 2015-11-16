<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing tender pages.
 *
 * @author David Buwembo <dbuwembo@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/4/2015
 */
class Tenders extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_tender');
	}
	
	# tender notices home page
	function index()
	{
		$data = filter_forwarded_data($this);
		$data['procurementPlanList'] = array();
		
		$this->load->view('tenders/home', $data);
	}
	
	
	
	# tender notices lists
	function tenders_list()
	{
		$data = filter_forwarded_data($this);
		
		$data['type'] = $data['t'];
		# TODO: Select list based on type passed
		$data['list'] = array();
		
		$this->load->view('tenders/details_list', $data);
	}
	
	
	
	# to manage tenders
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_tender->lists();
		
		$this->load->view('tenders/manage', $data);
	}
	
	
}

/* End of controller file */