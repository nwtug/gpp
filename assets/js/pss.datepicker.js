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
	
	/*$(".calendar").datetimepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy',
		timeFormat: 'hh:mm tt'
	});*/
	
	}
});

function setDatePicker()
{
	// Date only
	$( ".calendar.clickactivated:not(.showtime)" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});
	$( ".calendar.clickactivated:not(.showtime)" ).focus();
	
	// This will require including the timepicker-addon js file
	if($('.calendar.showtime').length > 0){
		// Date and time
		$('.showtime.clickactivated').datetimepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			timeFormat: "hh:mm tt"
		});
		$('.showtime.clickactivated').focus();
	}
}