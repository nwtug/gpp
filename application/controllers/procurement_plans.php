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
	
	
}

/* End of controller file */