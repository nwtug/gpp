//Procurement plan functionality
//for processing viewing, addition and editing the procurement plan details 



$(function() {
	//Trigger the addition activity based on the button
	$(document).on('click', "#applyplantemplate", function(){ 
		//Update the form instructions to submit using the apply button
		if($('#pde_id').val() != '' && $('#name').val().trim() != '' && $('#fystart__financialperiods').val().trim() != ''){
			
			if(!$('#applyplantemplate').hasClass('submitmicrobtn')){
				// a) store the old form instructions
				var action = $('#action').val();
				var redirectAction = $('#redirectaction').val();
				var resultsDiv = $('#resultsdiv').val();
			
				// b) add the new form instructions
				$('#action').val(getBaseURL()+'procurement_plans/add_details');
				$('#redirectaction').val('');
				$('#resultsdiv').val('plan_details_div');
				$('#applyplantemplate').addClass('submitmicrobtn');
				// c) submit the form
				$('#applyplantemplate').click();
			
			}
			// d) then restore the old form instructions
			else {
				$('#action').val(getBaseURL()+'procurement_plans/add');
				$('#redirectaction').val(getBaseURL()+'procurement_plans/manage');
				$('#resultsdiv').val('');
				$('#applyplantemplate').removeClass('submitmicrobtn');
				$('#save').addClass('submitmicrobtn');
			}
		}
		else showServerSideFadingMessage('ERROR: The PDE, title and financial period must be entered to Apply changes.');
	});
	
	
	
	
	
	
	// Confirm the plan status
	$(document).on('click', "#confirmplanstatus", function(){ 
		var formData = {status:$('#status__procurementplanstatus').val(), pdeid:$('#pde_id').val(), name:replaceBadChars($('#name').val()), financialyear:$('#fystart__financialperiods').val()};
		
		// Process the form data submitted
		$.ajax({
        	type: "POST",
       		url: $('#action').val(),
      		data: formData,
      		beforeSend: function() {},
			error: function( xhr, textStatus, errorThrown) {
    			showServerSideFadingMessage('ERROR: Something went wrong. We can not submit your data.');
			},
      		success: function(data) {
				if(data.match(/php error/i)) {
					showServerSideFadingMessage('ERROR: Something went wrong. We can not submit your data');
				} else {
					if(data.length > 0) showServerSideFadingMessage(data);
					else document.location.href = $('#redirectaction').val();
				}
			}
   		});
	});
	
	
	
	
	
	// Removing a procurement plan spreadsheet item
	$(document).on('click', ".remove-plan-item", function(){ 
		var clickedObj = $(this);
		var rowId = $(this).data('id');
		
		if(window.confirm('Are you sure you want to remove this item?')){
			$.ajax({
        	type: "POST",
       		url: getBaseURL()+'procurement_plans/remove_item',
      		data: {id:rowId},
      		beforeSend: function() {},
			error: function( xhr, textStatus, errorThrown) {
    			showServerSideFadingMessage('ERROR: Something went wrong. We can not submit your data.');
			},
      		success: function(data) {
				if(data.match(/php error/i)) {
					showServerSideFadingMessage('ERROR: Something went wrong. We can not submit your data');
				} else {
					if(data.length == 0) clickedObj.parents('tr').first().remove();
					else showServerSideFadingMessage(data);
				}
			}
   			});
		}
	});
	
	
	
	
	
	// Adding a procurement plan spreadsheet item
	$(document).on('click', ".add-plan-item", function(){ 
		var clickedObj = $(this);
		var rowId = $(this).data('id');
		var linkId = '__item_'+rowId+'_add';
		
		if($('#'+linkId).length) $('#'+linkId).remove();
		$(this).after("<a href='"+getBaseURL()+"procurement_plans/add_item/d/"+rowId+"' id='"+linkId+"' class='shadowbox'></a>");
		$('#'+linkId).click();
	});
	
	
	
	
	
	// Refereshes the procurement plan details list
	
	
});


	
	
	
function submitPlanData()
{
	var submitForm = true;
	
	$('#plan_details_form').find('input').each(function(){
		if($(this).val() == '') {
			showServerSideFadingMessage('WARNING: All fields are required to continue.');
			submitForm = false;
			return false;
		}
	});
	
	//If you can submit the form, go ahead
	if(submitForm){
		var inputs = $('#plan_details_form').find('input, select');
		
		$.ajax({
        	type: "POST",
       		url: getBaseURL()+'procurement_plans/add_item',
      		data: inputs.serializeArray(),
      		beforeSend: function() {},
			error: function( xhr, textStatus, errorThrown) {
    			showServerSideFadingMessage('ERROR: Something went wrong. We can not submit your data.');
			},
      		success: function(data) {
				if(data.match(/php error/i) || data.match(/error: /i)) {
					if(data.match(/error: /i)) showServerSideFadingMessage(data);
					else showServerSideFadingMessage('ERROR: Something went wrong. We can not submit your data');
				} else {
					window.parent.document.getElementById('refreshlist').click();
					window.parent.document.getElementById('__shadowbox_closer').click();
				}
			}
   		});
	}
}