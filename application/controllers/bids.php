<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing bid pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/4/2015
 */
class Bids extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_bid');
	}
	
	
	# to manage bids
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_bid->lists();
		
		$this->load->view('bids/manage', $data);
	}
	
	
}

/* End of controller file */