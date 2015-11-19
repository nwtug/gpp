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
		if(!empty($data['a'])) $data['area'] = $data['a'];
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
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'tender_list_actions', 'div');
	}
	
	
	
	# filter tender
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('tenders/list_filter', $data);
	}
	
	
	
	# filter tenders for the home page
	function home_filter()
	{
		$data = filter_forwarded_data($this);
		
		if($data['t'] == 'procurement_plans') $folder = 'procurement_plans';
		else if($data['t'] == 'active_notices') $folder = 'tenders';
		else if($data['t'] == 'best_evaluated_bidders') $folder = 'bids';
		else if($data['t'] == 'contract_awards') $folder = 'bids';
		
		$this->load->view($folder.'/home_filter', $data);
	}
	
	
	
}

/* End of controller file */