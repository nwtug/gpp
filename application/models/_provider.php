<?php
/**
 * This class generates and formats provider details.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 11/15/2015
 */
class _provider extends CI_Model
{
	# list of providers
	function lists($scope=array('phrase'=>'', 'registration_country'=>'', 'category'=>'', 'ministry'=>'', 'status'=>'', 'offset'=>'0', 'limit'=>NUM_OF_ROWS_PER_PAGE))
	{
		return $this->_query_reader->get_list('get_provider_list', array(
				'category_condition'=>(!empty($scope['category'])? " AND _category_id='".$scope['category']."' ": ''),

				'ministry_condition'=>(!empty($scope['ministry'])? " AND _ministry_id='".$scope['ministry']."' ": ''),

				'country_condition'=>(!empty($scope['category'])? " AND _registration_country_id='".$scope['registration_country']."' ": ''),
				'phrase_condition'=>(!empty($scope['phrase'])? " AND MATCH(name) AGAINST ('+\"".htmlentities($scope['phrase'], ENT_QUOTES)."\"')": ''),

				'status_condition'=>(!empty($scope['status'])? " AND status='".$scope['status']."'": ''),

				'limit_text'=>" LIMIT ".$scope['offset'].",".$scope['limit']." "
		));
	}







	# update the status of a provider
	function update_status($newStatus, $idList)
	{
		$result = FALSE;
		# use appropriate DB status
		$organizationStatus = array('activate'=>'active', 'deactivate'=>'inactive', 'suspend'=>'suspended');
		$userStatus = array('activate'=>'active', 'deactivate'=>'inactive', 'suspend'=>'inactive');

		if(!empty($organizationStatus[$newStatus])) {
			$result = $this->_query_reader->run('update_organization_status', array(
					'new_status'=>$organizationStatus[$newStatus],
					'id_list'=>implode("','",$idList),
					'user_id'=>$this->native_session->get('__user_id') ));
		}

		if(!empty($userStatus[$newStatus]) && $result) {
			$result = $this->_query_reader->run('update_user_status_by_organization_ids', array(
					'new_status'=>$userStatus[$newStatus],
					'id_list'=>implode("','",$idList),
					'user_id'=>$this->native_session->get('__user_id')
			));
		}

		# log action
		$this->_logger->add_event(array(
				'user_id'=>$this->native_session->get('__user_id'),
				'activity_code'=>'update_provider_status',
				'result'=>($result? 'SUCCESS': 'FAIL'),
				'log_details'=>"device=".get_user_device()."|browser=".$this->agent->browser(),
				'uri'=>uri_string(),
				'ip_address'=>get_ip_address()
		));

		return array('boolean'=>$result);
	}




	# send a message to the selected providers
	function message($data)
	{
		$sent = $notSent = array();
		$users = $this->_query_reader->get_list('get_users_in_organizations',array('organization_ids'=>implode("','",explode(',',$data['idlist'])) ));
		$message = array('code'=>'custom_internal_message', 'subject'=>$data['reason__contactreason'], 'details'=>$data['details']);

		foreach($users AS $row) {
			$result = $this->_messenger->send($row['user_id'], $message, array('email'),TRUE);
			if($result) array_push($sent, $row['email_address']);
			else array_push($notSent, $row['email_address']);
		}

		return array('boolean'=>!(empty($sent) && !empty($notSent)), 'not_sent'=>$notSent);
	}







	# generate the provider certificate for the provided period
	function generate_certificate($data)
	{
		$result = FALSE;
		$this->load->model('_account');
		$provider = $this->_account->details($data['providerid'], 'provider');

		if(!empty($provider)){
			$this->load->helper('report');
			$this->load->model('_file');
			$data['provider_name'] = html_entity_decode($provider['name'], ENT_QUOTES);
			$data['certificate_number'] = generate_certificate_number($provider['organization_id']);
			$fileName = 'certificate_'.$data['certificate_number'].'.pdf';

			# now update the provider certificate number
			$result = $this->_query_reader->run('update_provider_certificate', array(
					'rop_number'=>$data['certificate_number'],
					'rop_certificate_url'=>$fileName,
					'registration_fee'=>$data['amount_paid'],
					'expiry_date'=>date('Y-m-d',strtotime(make_us_date($data['valid_until']))) ,
					'organization_id'=>$provider['organization_id'],
					'user_id'=>$this->native_session->get('__user_id')
			));

			$this->_file->generate_pdf(
					generate_certificate_html($data, 'provider_certificate'),
					UPLOAD_DIRECTORY.$fileName,
					'download',
					array('size'=>'A4','orientation'=>'landscape')
			);
		}
		return array('boolean'=>$result, 'file_name'=>($result? $fileName: ''));
	}




	# suspend the providers
	function suspend($data)
	{
		$ids = explode(',', $data['idlist']);

		# add the details of the suspension
		$result = $this->_query_reader->run('add_suspension_reason', array(
				'id_list'=>implode("','", $ids),
				'reason'=>htmlentities($data['reason'], ENT_QUOTES),
				'expiry_date'=>date('Y-m-d',strtotime(make_us_date($data['expiry_date']))),
				'user_id'=>$this->native_session->get('__user_id')
		));

		# update the organization status to suspended and expire the registration period
		if($result) {
			$result = $this->_query_reader->run('update_provider_suspension', array(
					'id_list'=>implode("','", $ids),
					'user_id'=>$this->native_session->get('__user_id')
			));
		}

		# terminate any active projects by the selected providers
		if($result) {
			$result = $this->_query_reader->run('terminate_provider_contracts', array(
					'id_list'=>implode("','", $ids),
					'user_id'=>$this->native_session->get('__user_id')
			));

			if($result){
				$result = $this->_query_reader->run('add_termination_status_due_to_suspension', array(
						'id_list'=>implode("','", $ids),
						'user_id'=>$this->native_session->get('__user_id'),
						'organization_id'=>$this->native_session->get('__organization_id')
				));
			}
		}

		return array('boolean'=>$result);
	}





}


?>