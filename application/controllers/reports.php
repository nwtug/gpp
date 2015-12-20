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
		
		# Updating the report parameters
		if(!empty($_POST)){
			$data['list'] = $this->_report->lists(array(
				'type'=>$_POST['report__reporttypes'], 
				'quarter'=>$_POST['report__pastyears'].'-'.$_POST['report__quarters'], 
				'pde'=>$_POST['pde_id']
			));
			
			$data['report_type'] = $_POST['report__reporttypes'];
			$this->native_session->set('__report_type', $data['report_type']);
			
			$this->load->view('reports/report_list', $data);
		}
		else {
			$data['list'] = $this->_report->lists();
			$this->load->view('reports/manage', $data);
		}
	}
	
	
	
	
	
	
	# list actions
	function list_actions()
	{
		$data = filter_forwarded_data($this);
		echo get_option_list($this, (!empty($data['t'])? $data['t']: '').'report_list_actions', 'div');
	}
	
	
	
	# download a report that has been generated
	function download()
	{
		$data = filter_forwarded_data($this);
		$this->load->helper('report');
		$report = $this->_report->report_to_array($data['t']);
		
		# download CSV
		if($data['t'] == 'download_csv'){
			send_download_headers("file_".strtotime('now').".csv");
			echo array2csv($report);
			die();
		}
		# download PDF
		else if($data['t'] == 'download_pdf'){
			$this->load->model('_file');
			$reportType = $this->native_session->get('__report_type')? $this->native_session->get('__report_type'): 'procurement_plan_tracking';
			$this->_file->generate_pdf(generate_report_html($report, $reportType), UPLOAD_DIRECTORY.'file_'.strtotime('now').'.pdf', 'download', array('size'=>'A4','orientation'=>'landscape'));
		}
	}
	
	
	
	
	
	# update the view being displayed for a financial report
	function update_financial_report()
	{
		$data = filter_forwarded_data($this);
		$data['list'] = $this->_report->stats($data['t'],$data['y']); 
		
		$this->load->view('reports/'.$data['t'].'_stats', $data);
	}
	
	
}

/* End of controller file */