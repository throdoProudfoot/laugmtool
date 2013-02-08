/**
 * 
 */

jQuery(document).ready(function($) {

	$('#ca-container').contentcarousel({
		// speed for the sliding animation
		sliderSpeed : 500,
		// easing for the sliding animation
		sliderEasing : 'easeOutExpo',
		// speed for the item animation (open / close)
		itemSpeed : 500,
		// easing for the item animation (open / close)
		itemEasing : 'easeOutExpo',
		// number of items to scroll at a time
		scroll : 1
	});

	$('.ca-item-clickable').click(function() {
		var currentId = $(this).attr('id');
		$('.ca-item-clickable').removeClass("ca-item-selected");
		$(this).addClass("ca-item-selected");
		var splitArray = currentId.split("-");
		var cpt = splitArray.length;
		var key=splitArray[cpt-1];
		$('#peupleSelected').val(key);
	});

});