<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing account pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 10/30/2015
 */
class Account extends CI_Controller 
{
	# login
	function login()
	{
		$data = filter_forwarded_data($this);
		
		$this->load->view('account/login', $data);
	}
	
	
	
	
	
	
}

/* End of controller file */