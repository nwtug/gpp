<?php
/**
 * This file contains functions that are used in a number of classes or views.
 *
 * @author Al Zziwa <azziwa@newwavetech.co.ug>
 * @version 1.0.0
 * @copyright PSS
 * @created 10/31/2015
 */




# Get a list of options 
# Allowed return values: [div, option]
function get_option_list($obj, $list_type, $return = 'select', $searchBy="", $more=array())
{
	$optionString = '';
	$types = array();
	
	switch($list_type)
	{
		case "financialyears":
			for($i=@date('Y'); $i>(@date('Y') - MAXIMUM_FINANCIAL_HISTORY); $i--)
			{
				if($return == 'div') $optionString .= "<div data-value='".$i."'>Financial Year ".$i."</div>";
				else $optionString .= "<option value='".$i."'>Financial Year ".$i."</option>";
			}
		break;
		
		
		case "organizationtypes":
			$types = array('provider'=>'Provider', 'pde'=>'Procurement or Disposal Entity');
			foreach($types AS $key=>$row)
			{
				if($return == 'div') $optionString .= "<div data-value='".$key."'>".$row."</div>";
				else $optionString .= "<option value='".$key."' onclick=\"updateFieldLayer('".base_url()."accounts/type_explanation/t/".$key."','','','type_explanation','')\" ".(!empty($more['selected']) && $more['selected'] == $key? 'selected': '').">".$row."</option>";
			}
		break;
		
		
		case "documenttypes":
			$types = array('provider_registration'=>'Provider Registration Certificate', 'training_completion'=>'Training Completion Certificate');
			foreach($types AS $key=>$row)
			{
				if($return == 'div') $optionString .= "<div data-value='".$key."'>".$row."</div>";
				else $optionString .= "<option value='".$key."'>".$row."</option>";
			}
		break;
		
		
		case "contactreason":
			$types = array('Issues With Registration', 'Report Error On System', 'Can Not Find Document', 'Report Provider Fraud');
			foreach($types AS $key=>$row)
			{
				if($return == 'div') $optionString .= "<div data-value='".$key."'>".$row."</div>";
				else $optionString .= "<option value='".$key."'>".$row."</option>";
			}
		break;
		
		
		case "businesscategories":
			$types = $obj->_query_reader->get_list(($more['type'] == 'pde'? 'get_government_ministries': 'get_business_categories'));
			$categoryName = $more['type'] == 'pde'? 'Ministry': 'Category';
			
			if($return == 'div') $optionString .= "<div data-value=''>Select a ".$categoryName."</div>";
			else $optionString .= "<option value=''>Select a ".$categoryName."</option>";
			
			foreach($types AS $row)
			{
				if($return == 'div') $optionString .= "<div data-value='".$row['id']."'>".$row['name']."</div>";
				else $optionString .= "<option value='".$row['id']."' ".(!empty($more['selected']) && $more['selected'] == $row['id']? 'selected': '').">".$row['name']."</option>";
			}
		break;
		
		
		case "countries":
			$types = $obj->_query_reader->get_list('get_countries_list');
			
			if($return == 'div') $optionString .= "<div data-value=''>Select Country</div>";
			else $optionString .= "<option value=''>Select Country</option>";
			
			foreach($types AS $row)
			{
				if($return == 'div') $optionString .= "<div data-value='".$row['id']."'>".$row['name']."</div>";
				else $optionString .= "<option value='".$row['id']."' ".(!empty($more['selected']) && $more['selected'] == $row['id']? 'selected': '').">".$row['name']."</option>";
			}
		break;
		
		
		case "secretquestions":
			$types = $obj->_query_reader->get_list('get_secret_questions');
			
			if($return == 'div') $optionString .= "<div data-value=''>Select Secret Question</div>";
			else $optionString .= "<option value=''>Select Secret Question</option>";
			
			foreach($types AS $row)
			{
				if($return == 'div') $optionString .= "<div data-value='".$row['id']."'>".$row['question']."</div>";
				else $optionString .= "<option value='".$row['id']."' ".(!empty($more['selected']) && $more['selected'] == $row['id']? 'selected': '').">".$row['question']."</option>";
			}
		break;
		
		
		case "users":
			$types = $obj->_query_reader->get_list('search_user_list', array('phrase'=>htmlentities($searchBy, ENT_QUOTES), 'limit_text'=>' LIMIT '.NUM_OF_ROWS_PER_PAGE));
			
			foreach($types AS $row)
			{
				if($return == 'div') $optionString .= "<div data-value='".$row['user_id']."' onclick=\"universalUpdate('user_id','".$row['user_id']."')\">".$row['name']."</div>";
				else $optionString .= "<option value='".$row['user_id']."' onclick=\"universalUpdate('user_id','".$row['user_id']."'>".$row['name']."</option>";
			}
		break;
		
		
		case "activitycodes":
			$types = $obj->_query_reader->get_list('get_activity_codes');
			
			if($return == 'div') $optionString .= "<div data-value=''>Select Activity Code</div>";
			else $optionString .= "<option value=''>Select Activity Code</option>";
			
			foreach($types AS $row)
			{
				if($return == 'div') $optionString .= "<div data-value='".$row['code']."'>".ucwords($row['display_code'])."</div>";
				else $optionString .= "<option value='".$row['code']."' ".(!empty($more['selected']) && $more['selected'] == $row['code']? 'selected': '').">".ucwords($row['display_code'])."</option>";
			}
		break;
		
		
		
		
		
		
		case "users_list_actions":
		case "provider_users_list_actions":
			
			if($list_type == "users_list_actions") $types = array('message'=>'Message', 'activate'=>'Activate', 'deactivate'=>'Deactivate', 'update_type'=>'Update Type', 'update_permission_group'=>'Update Permission Group');
			else if($list_type == "provider_users_list_actions") $types = array('message'=>'Message');
			
			foreach($types AS $key=>$row)
			{
				if($key == 'message') $url = 'users/message';
				else if(in_array($key, array('activate', 'deactivate'))) $url = 'users/update_status/t/'.$key;
				else if($key == 'update_type') $url = 'users/update_type';
				
				if($return == 'div') $optionString .= "<div data-value='".$key."' data-url='".$url."'>".$row."</div>";
				else $optionString .= "<option value='".$key."'>".$row."</option>";
			}
		
		break;
		
		
		
		
		
		
		case "provider_list_actions":
			
			$types = array('message'=>'Message', 'activate'=>'Activate', 'deactivate'=>'Deactivate', 'suspend'=>'Suspend');
			
			foreach($types AS $key=>$row)
			{
				if($key == 'message') $url = 'providers/message';
				else if(in_array($key, array('activate', 'deactivate', 'suspend'))) $url = 'providers/update_status/t/'.$key;
				
				if($return == 'div') $optionString .= "<div data-value='".$key."' data-url='".$url."'>".$row."</div>";
				else $optionString .= "<option value='".$key."'>".$row."</option>";
			}
		
		break;
		
		
		
		
		case "procurement_plan_list_actions":
			$types = array('publish'=>'Publish', 'deactivate'=>'Deactivate', 'edit'=>'Edit');
			
			foreach($types AS $key=>$row)
			{
				if($key == 'edit') $url = 'procurement_plans/add';
				else if(in_array($key, array('publish', 'deactivate'))) $url = 'procurement_plans/update_status/t/'.$key;
				
				if($return == 'div') $optionString .= "<div data-value='".$key."' data-url='".$url."'>".$row."</div>";
				else $optionString .= "<option value='".$key."'>".$row."</option>";
			}
		break;
		
		
		
		
		case "tender_list_actions":
			$types = array('publish'=>'Publish', 'deactivate'=>'Deactivate', 'edit'=>'Edit');
			
			foreach($types AS $key=>$row)
			{
				if($key == 'edit') $url = 'tenders/add';
				else if(in_array($key, array('publish', 'deactivate'))) $url = 'tenders/update_status/t/'.$key;
				
				if($return == 'div') $optionString .= "<div data-value='".$key."' data-url='".$url."'>".$row."</div>";
				else $optionString .= "<option value='".$key."'>".$row."</option>";
			}
		break;
		
		
		
		
		case "all_bid_list_actions":
		case "best_bidders_bid_list_actions":
		case "awards_bid_list_actions":
			
			if($list_type == 'all_bid_list_actions') $types = array('message_bidder'=>'Message Bidder', 'mark_as_won'=>'Mark As Won', 'mark_as_awarded'=>'Mark As Awarded', 'reject_bid'=>'Reject Bid');
			
			else if($list_type == 'best_bidders_bid_list_actions') $types = array('message_bidder'=>'Message Bidder', 'mark_as_awarded'=>'Mark As Awarded', 'retract_win'=>'Retract Win');
			
			else if($list_type == 'awards_bid_list_actions') $types = array('message_bidder'=>'Message Bidder', 'retract_award'=>'Retract Award');
			
			
			
			foreach($types AS $key=>$row)
			{
				if($key == 'message_bidder') $url = 'bids/message';
				else if(in_array($key, array('mark_as_won', 'mark_as_awarded', 'retract_win', 'reject_bid', 'retract_award'))) $url = 'bids/update_status/t/'.$key;
				
				if($return == 'div') $optionString .= "<div data-value='".$key."' data-url='".$url."'>".$row."</div>";
				else $optionString .= "<option value='".$key."'>".$row."</option>";
			}
		break;
		
		
		
		
		case "pdes":
			$types = $obj->_query_reader->get_list('search_pde_list', array('phrase'=>htmlentities($searchBy, ENT_QUOTES), 'limit_text'=>' LIMIT '.NUM_OF_ROWS_PER_PAGE));
			
			foreach($types AS $row)
			{
				if($return == 'div') $optionString .= "<div data-value='".$row['pde_id']."' onclick=\"universalUpdate('pde_id','".$row['pde_id']."')\">".$row['name']."</div>";
				else $optionString .= "<option value='".$row['pde_id']."' onclick=\"universalUpdate('pde_id','".$row['pde_id']."'>".$row['name']."</option>";
			}
		break;
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
	
	
	# Determine which value to return
	if($return == 'objects'){
		return $types;
	}
	else if($return == 'div'){
		return !empty($optionString)? $optionString: "<div data-value=''>No Options</div>";
	}
	else {
		return !empty($optionString)? $optionString: "<option value=''>No Options</option>";
	}
	
}

	



# Get an item from a position in a drop down list
function get_list_item($array, $current, $direction, $return='key')
{
	if(array_key_exists($current, $array)){
		$keys = array_keys($array);
		$length = count($keys);
		$position = array_search($current, $keys);
		
		$newPosition = $position;
		if($direction == 'next') {
			$newPosition = ($position + 1) == $length? 0: ($position + 1);
		} else {
			$newPosition = ($position - 1) < 0? ($length - 1): ($position - 1);
		}
		
		# return the new list item
		return $return == 'value'? $array[$keys[$newPosition]]: $keys[$newPosition];
	}
	return '';
}




?>