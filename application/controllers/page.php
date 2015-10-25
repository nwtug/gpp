<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing public pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 10/20/2015
 */
class Page extends CI_Controller 
{
	#home page
	function index()
	{
		$data = filter_forwarded_data($this);
		
		$this->load->view('home', $data);
	}
	
	
}

/* End of controller file */