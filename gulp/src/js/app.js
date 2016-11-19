jQuery(document).ready(function($){

	// SLIDER
	$('.slider').slick({
		dots:true,
		arrows:false,
		adaptiveHeight:true
	});

	// FLYOUT NAV CLICK FUNCTION
	$('.menu-toggle').click(function(){
		$('.flyout').slideToggle();
		$(this).toggleClass('active');
	});

});