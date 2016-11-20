jQuery(document).ready(function($){

	// SLIDER
	$('.slider').slick({
		dots:true,
		arrows:false,
		adaptiveHeight:true
	});

	// PROJECT SLIDER
	$('.project-slider').slick();

	// FLYOUT NAV CLICK FUNCTION
	$('.header-right button').click(function(){
		$('.flyout').slideToggle();
		$('.header-right i').toggleClass('fa-bars fa-times');
	});

});