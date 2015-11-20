<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing contract pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/4/2015
 */
class Contracts extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_contract');
	}
	
	
	# to manage contracts
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_bid->lists();
		
		$this->load->view('contracts/manage', $data);
	}
	
	# Filter contracts
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('contracts/list_filter', $data);
	}
	
}

/* End of controller file */