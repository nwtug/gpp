<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class controls viewing training activity pages.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/25/2015
 */
class Training extends CI_Controller 
{
	#Constructor to set some default values at class load
	public function __construct()
    {
        parent::__construct();
        $this->load->model('_training');
	}
	
	# manage home page
	function manage()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_training->lists();
		
		$this->load->view('training/manage', $data);
	}
	
	
	
	
	# add a training record
	function add()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($_POST)){
			$result = $this->_training->add($_POST);
			if(!$result['boolean']) echo "ERROR: The training information could not be added. ".$result['reason'];
		} else {
			$this->load->view('training/new_training', $data);
		}
	}
	
	
	
	
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, 'training_list_actions', 'div');
	}
	
	
	
	
	
	# update a training's status
	function update_status()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['t']) && !empty($data['list'])) $result = $this->_training->update_status($data['t'], explode('--',$data['list']));
		
		$data['msg'] = (!empty($result['boolean']) && $result['boolean'])? (!empty($data['t']) && $data['t'] == 'delete'? 'The training record has been deleted.': 'The training status has been changed.'): 'ERROR: The training status could not be changed.';
		
		$data['area'] = 'refresh_list_msg';
		$this->load->view('addons/basic_addons', $data);
	}
	
	
	
	
	
	# filter training list
	function list_filter()
	{
		$data = filter_forwarded_data($this);
		$this->load->view('training/list_filter', $data);
	}
	
	
	
	
	# view a training description
	function description()
	{
		$data = filter_forwarded_data($this);
		
		if(!empty($data['d'])) $data['details'] = $this->_training->details($data['d']);
		if(empty($data['details'])) $data['msg'] = 'ERROR: The training details could not be resolved.';
		
		$this->load->view('training/description', $data);
	}
	
	
	
	
}

/* End of controller file */