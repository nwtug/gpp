<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing procurement plan pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class Procurement_plans extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_procurement_plan');
	}
	
	
	
	# to manage procurement plans
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_procurement_plan->lists();
		
		$this->load->view('procurement_plans/manage', $data);
	}
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'procurement_plan_list_actions', 'div');
	}
	
	
	# list filters
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('procurement_plans/list_filter', $data);
	}
	
	
	
	# to add a procurement plan
	function add()
	{
		$data = filter_forwarded_data($this);
		
		$this->load->view('procurement_plans/new_plan', $data);
	}
	
}

/* End of controller file */