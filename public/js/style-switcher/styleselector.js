(function($) {
 "use strict";

$(document).ready(function($) {
	var projectBaseUrl= $('#projectBaseUrl').val();
	$('body').addClass('bg-cover');

	// Style Selector	
	// $('#style-selector').animate({
		// left: '-225px'
		// alert('0000');
	// });
//  $('#style-selector').hide();

	$('#style-selector a.close').click(function(e){
		e.preventDefault();
		var div = $('#style-selector');
		if (div.css('left') === '-225px') {
			$('#style-selector').animate({
				left: '0'
			});
		//	alert('1111');
	
	
	//z-index:100000000; background-color:#000; opacity:0.9;background-image:url(images/block-bg.png);
	
			$( "#backgroundImage" ).css( "z-index", "100000000000000" );
			$( "#backgroundImage" ).css( "background-image", "url("+projectBaseUrl+"/public/images/block-bg.png)" );	
			$( "#backgroundImage" ).css( "width", "100%" );
			
			
			//$( "#style-selector" ).css( "opacity", "1" );
			$(window).disablescroll();
			
			// window.onmousewheel = document.onmousewheel = function(e) {
				// e = e || window.event;
				// if (e.preventDefault)
					// e.preventDefault();
				// e.returnValue = false;
			// };

			
			
			$(this).removeClass('icon-chevron-left');
			$(this).addClass('icon-chevron-right');
		} else {
			$('#style-selector').animate({
				left: '-225px'
			});
		//	alert('2222');
			
			$( "#backgroundImage" ).css( "z-index", "1000" );
			$( "#backgroundImage" ).css( "background-color", "none" );		
			$( "#backgroundImage" ).css( "width", "0%" );
			
			
			$(window).disablescroll("undo");
			
			$(this).removeClass('icon-chevron-right');
			$(this).addClass('icon-chevron-left');
		}
	})


	

});

})(jQuery);
