/**
 * 
 */

jQuery(document).ready(function($) {

	$("p").click(function() {
		$(this).hide();
	});

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

	$('.ca-item-main > h3').click(function() {
		$('#peupleSelected').val($(this).attr("key"));
		$('#selectionnePeuple').submit();
	});

});