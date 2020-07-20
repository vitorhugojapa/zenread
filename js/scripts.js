//monitors scroll position
var prevScrollPos = 0;

//determines if the user is scrolling up or down
function isScrollUp(prev){
	if(prev > jQuery('body').scrollTop()){
		jQuery('body').addClass('scrolling-up');
		jQuery('body').removeClass('scrolling-down');
		
		if(jQuery('body').scrollTop() < (jQuery(window).height()/2)){
			jQuery('body').addClass('near-top');
		}else{
			jQuery('body').removeClass('near-top');
		}
	}else{
		jQuery('body').removeClass('scrolling-up');
		jQuery('body').addClass('scrolling-down');

		if(jQuery('body').scrollTop() < (jQuery(window).height()/2)){
			jQuery('body').addClass('near-top');
		}else{
			jQuery('body').removeClass('near-top');
		}
	}
}
jQuery(window).scroll(function() {
	isScrollUp(prevScrollPos);
	prevScrollPos = jQuery('body').scrollTop();
});