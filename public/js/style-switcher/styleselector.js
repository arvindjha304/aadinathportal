(function($) {
 "use strict";

$(document).ready(function($) {

	$('body').addClass('bg-cover');

	// Style Selector	
	// $('#style-selector').animate({
		// left: '-224px'
		
		// alert('0000');
	// });

//        $('#style-selector').hide();
	$('#style-selector a.close').click(function(e){
		e.preventDefault();
		var div = $('#style-selector');
		if (div.css('left') === '-224px') {
			$('#style-selector').animate({
				left: '0'
			});
		//	alert('1111');
	
			$( "body" ).css( "background-color", "black" );
			$( "body" ).css( "opacity", "0.3" );
			$( "#style-selector" ).css( "opacity", "1" );
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
				left: '-224px'
			});
		//	alert('2222');
			
			$( "body" ).css( "background-color", "white" );
			$( "body" ).css( "opacity", "1" );
			$( "#style-selector" ).css( "opacity", "1" );
			$(window).disablescroll("undo");
			
			$(this).removeClass('icon-chevron-right');
			$(this).addClass('icon-chevron-left');
		}
	})


	

});

})(jQuery);
