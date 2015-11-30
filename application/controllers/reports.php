<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing reports pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/27/2015
 */
class Reports extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_report');
	}
	
	# manage home page
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_report->lists();
		
		$this->load->view('reports/manage', $data);
	}
	
	
	
	
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, (!empty($data['t'])? $data['t']: '').'report_list_actions', 'div');
	}
	
	
	
	
	
	
	
	
}

/* End of controller file */