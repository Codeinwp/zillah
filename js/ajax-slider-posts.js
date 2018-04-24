/* global requestpost */

// Transform Slider Posts to Normal Posts on mobile.
( function($) {

	// Check if mobile by userAgent.
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent )) {

		var topCarousel = $( '#home-carousel' );

		if ( ( topCarousel !== 'undefined' ) && ( topCarousel.length !== 0 ) ) {

			topCarousel.remove();

			$.ajax(
				{
					url: requestpost.ajaxurl,
					type: 'post',
					data: {
						page: 'index',
						action: 'request_post',
					},
					beforeSend: function () {
						$( '#main' ).prepend( '<div id="post-request"></div>' );
					},
					success: function (result) {
						$( '#post-request' ).html( result );
					}
				}
			);
		}
	}
})( jQuery );
