<?php
/**
 * This class generates and formats public page details. 
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/10/2015
 */
class _page extends CI_Model
{
	
	# send contact message
	public function send_contact_message($formDetails)
	{
		$message['code'] = 'website_contact_message';
		$message['yourname'] = htmlentities($formDetails['yourname'], ENT_QUOTES);
		$message['senderemailaddress'] = $formDetails['emailaddress'];
		$message['sendertelephone'] = (!empty($formDetails['telephone'])? $formDetails['telephone']: '');
		$message['sendtime'] = date(FULL_DATE_FORMAT, strtotime('now'));
		$message['messagesubject'] = htmlentities($formDetails['reason__contactreason'], ENT_QUOTES);
		$message['messagedetails'] = htmlentities($formDetails['details'], ENT_QUOTES);
			
		return $this->_messenger->send_direct_email($formDetails['emailaddress'], '', $message);
	}

	# verify certificate
	public function verify_document($formData)
	{
		$certificate['certificate_type'] = $formData['documenttype__documenttypes'];

		# trackingnumber is expected to be numeric
		$certificate['certificate_id'] = is_numeric($formData['trackingnumber'])?$formData['trackingnumber']:'';



		# [get_certificate] query code provided by rogers
		return $this->_query_reader->get_count('verify_document',$certificate);

	}

	
	
}


?>