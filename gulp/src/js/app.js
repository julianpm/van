jQuery(document).ready(function($){

	// SLIDER
	$('.slider').slick({
		dots:true,
		arrows:false,
		adaptiveHeight:true
	});

	// FLYOUT NAV CLICK FUNCTION
	$('.header-right .fa-bars').click(function(){
		$('.flyout').slideToggle();
		$(this).toggleClass('active');
		$(this).toggleClass('fa-bars fa-times');
	});



});