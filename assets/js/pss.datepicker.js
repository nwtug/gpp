// JavaScript Document


// Initialize the calendars on the page
$(function() {
	if($('.calendar').length > 0){
	
	/*$( ".calendar.birthday" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		dateFormat: 'dd/mm/yy'
	});
	
	$( ".calendar.history" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "-200:+0",
		dateFormat: 'dd/mm/yy'
	});
	*/
	// This will require including the timepicker-addon js file
	if($('.calendar.showtime').length > 0){
		$('.calendar.showtime').datetimepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			timeFormat: "hh:mm tt"
		});
	}
	
	$(".calendar").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy',
		timeFormat: 'hh:mm tt'
	});
	
	}
	
	
	
	
	
	//Handle cases where a user is entering an email
	$(document).on('change', '.future-date', function(e){
		if($(this).val() != ''){
			// current system date (reconstruct to use only the date part)
			var now = new Date();
			var nowDateString = (now.getMonth() + 1) + "/" +  now.getDate() + "/" +  now.getFullYear();
			var nowDate = new Date(nowDateString);
			
			// entered date parts
			var dateParts = $(this).val().split('/');
			var enteredDate = new Date(dateParts[1]+'/'+dateParts[0]+'/'+dateParts[2]);
			
			if(!$(this).hasClass('strict') && nowDate > enteredDate) {
				showServerSideFadingMessage('ERROR: Only current or future dates are allowed for this field.');
				$(this).val('');
			}
			if($(this).hasClass('strict') && nowDate >= enteredDate) {
				showServerSideFadingMessage('ERROR: Only future dates are allowed for this field.');
				$(this).val('');
			}
		}
	});
	
	
	
	
	
	
});

function setDatePicker(obj)
{
	obj.focus();
	
	// Date only
	$( ".calendar.clickactivated:not(.showtime)" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});
	
	// This will require including the timepicker-addon js file
	if($('.calendar.showtime').length > 0){
		// Date and time
		$('.showtime.clickactivated').datetimepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			timeFormat: "hh:mm tt"
		});
	}
}


