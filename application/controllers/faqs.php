<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing FAQs.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/27/2015
 */
class Faqs extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_faq');
	}
	
	
	
	# to manage FAQs
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_faq->lists();
		
		$this->load->view('faqs/manage', $data);
	}
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'faq_list_actions', 'div');
	}
	
	
	
	# filter list
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('faqs/list_filter', $data);
	}
	
	
	
	# add an FAQ
	function add()
	{
		$data = filter_forwarded_data($this);
		
		# user has posted the permission form
		if(!empty($_POST)){
			$result = $this->_faq->add($_POST);
			if(!$result['boolean']) echo "ERROR: The FAQ could not be added. ".$result['reason'];
		} 
		# just viewing the form
		else {
			if(!empty($data['d'])) $data['faq'] = $this->_faq->details($data['d']);
			$this->load->view('faqs/new_faq', $data);
		}
	}
	
	
	
	
	
	# update an FAQ status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $result = $this->_faq->update_status($data['t'], explode('--',$data['list']));
		
		$data['msg'] = (!empty($result['boolean']) && $result['boolean'])? (!empty($data['t']) && $data['t'] == 'delete'? 'The FAQ has been deleted.': 'The FAQ status has been changed.'): 'ERROR: The FAQ status could not be changed.';
		
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	
	# internal help form
	function contact_us()
	{
		$data = filter_forwarded_data($this);
		
		$this->load->view('faqs/contact_us', $data);
	}
	
	
}

/* End of controller file */