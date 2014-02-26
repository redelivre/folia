jQuery(document).ready(function(){
	jQuery(".children").cycle({
	    speed: 600,
	    manualSpeed: 100,
	    slides: " > li",
	    fx: "carousel",
	    timeout: 0,
	    
	    carouselFluid: true,
	    next:"#filter-cycle-next",
	    prev:"#filter-cycle-prev"
	});
});