// JavaScript Document

$(function() {

	// Handle home-list tabs
	$(document).on('click', '.list-tabs td', function(){
		var clickedCell = $(this);
		var clickedId = $(this).attr('id');
		var tableType = $(this).parents('.list-tabs').first().data('type');
		var page = $(this).parents('.list-tabs').first().data('page');
		
		// a) remove the active class from every other cell
		$(this).parent('tr').children('td').each(function(){
			$(this).removeClass('active');
		});
		
		// b) add the active class to clicked cell
		clickedCell.addClass('active');
		
		// c) change the filter url
		var filterListCell = clickedCell.parents('.home-list-table').first().find('.filter-list').first();
		if(filterListCell.data('url')){
			var url = filterListCell.data('url');
			//...tenders/home_filter/t/procurement_plans
			//...tenders/home_filter/t/[clicked id]
			var url = url.substring(0,url.lastIndexOf("/"))+'/'+clickedId;
			filterListCell.data('url', url);
		}
		
		// d) change the more url
		var moreListCell = clickedCell.parents('.home-list-table').first().find('.load-more').first();
		if(moreListCell.data('rel')){
			var moreUrl = moreListCell.data('rel');
			moreUrl = moreUrl.substring(0,moreUrl.lastIndexOf("/"))+'/'+clickedId;
			moreListCell.data('rel',moreUrl);
		}
		
		// e) change the pagination url and content
		var paginationDiv = $(this).parents('.home-list-table').first().find('.pagination').first().find('div').first();
		var paginationDivId = clickedCell.data('final');
		paginationDiv.attr('id',paginationDivId);
		showOnePageNav(paginationDivId);
		
		var listDivObj = $(this).parents('.home-list-table').first().find('.page-list-div, .home-list-div').first();
		listDivObj.attr('id', 'paginationdiv__'+paginationDivId+'_list');
		var firstDiv = listDivObj.find('div').first();
		firstDiv.attr('id', paginationDivId+'__1');
		
		
		// f) load the clicked cell section list
		updateFieldLayer(getBaseURL()+page+'/t/'+clickedId,'','',firstDiv.attr('id'),'');
	});


	
	
	
	
	
	
	
	
	// Show list actions
	$(document).on('click', '.list-actions', function(event){
		var btnActionId = $(this).attr('id');
		$(this).addClass('selected');
		//is a width specified
		var width = $(this).data('width')? "width:"+$(this).data('width')+"px;": '';
		var height = $(this).data('height')? "height:"+$(this).data('height')+"px;": '';
		
		//Remove the details div and recreate it
		if($('#'+btnActionId+'__div').length > 0) $('#'+btnActionId+'__div').remove();
		$(this).before("<div id='"+btnActionId+"__div' class='list-actions-div' style='"+width+"'></div>");
		
		updateFieldLayer(getBaseURL()+$(this).data('url'),'','',btnActionId+'__div','');
		repositionDropDownDiv(btnActionId);
		
		//Add the action link near the div
		$(this).before("<a href='javascript:;' class='shadowbox' id='"+btnActionId+"__link' style='display:none;'></a>");
	});
	
	
	
	
	
	
	// Close the drop down divs if the user resizes the window
	$(window).resize(function() { 
		$('.list-actions-div').fadeOut('fast');
	});
	
	
	
	
	
	// What happens if you click on a list action div
	$(document).on('click', '.list-actions-div div', function(event){
		var clickedDiv = $(this);
		var url = getBaseURL()+clickedDiv.data('url');
		
		// Get where the target div where the selected items are to be collected from
		var parentDiv = $(this).parents('.list-actions-div').first().attr('id');
		var triggerDiv = parentDiv.replace(/__div/g, '');
		var targetDiv = $('#'+triggerDiv).data('targetdiv');
		
		if(typeof targetDiv !== 'undefined'){
			var selectedIds = [];
			$('#'+targetDiv).find('.bigcheckbox').each(function(){
				if($(this).is(':checked')) selectedIds.push($(this).val());
			});
			
			// Now add the selected ids to the url to send to the backend
			if(selectedIds.length > 0) {
				url += '/list/'+selectedIds.join('--');
				
				//Update the action link and click it
				$('#'+triggerDiv+'__link').attr('href',url);
				$('#'+triggerDiv+'__link').click();
			}
			else showServerSideFadingMessage('You have to check an item for this action.');
		}
		// If the item is independent of the checked items
		else {
			//Update the action link and click it
			$('#'+triggerDiv+'__link').attr('href',url);
			//should we use a shadowbox or go straight to the link
			if(clickedDiv.hasClass('ignore-pop')) document.location.href = url;
			else $('#'+triggerDiv+'__link').click();
		}
		clickedDiv.parents('.list-actions-div').first().remove();
	});
	
	
	
	
	
	
	
	
	
	
	
	// if the user clicked away, then close the div
	$(document).mouseup(function (e)
	{
    	var container = $('.list-actions-div');

    	if (!container.is(e.target) // if the target of the click isn't the container...
        	&& container.has(e.target).length == 0) // ... nor a descendant of the container
    	{
        	container.hide();
			$(document).find('.list-actions').each(function(){
				$(this).removeClass('selected');
			});
    	}
	});
	
	
	
	
	
	
});





// Apply system search
function applySearch()
{
	var searchUrl = $('#search__searchsystem').val();
	if(searchUrl != '') window.parent.document.location.href = getBaseURL()+searchUrl+'/action/search';
}