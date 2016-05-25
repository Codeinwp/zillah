/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Logo
	wp.customize( 'custom_logo', function( value ) {
  		value.bind( function( to ) {
			if( to != '' ) {
				$( '.custom-logo-link' ).removeClass( 'zillah-only-customizer' );
				$( '.header-logo-wrap' ).addClass( 'zillah-only-customizer' );
			}
			else {
				$( '.custom-logo-link' ).addClass( 'zillah-only-customizer' );
				$( '.header-logo-wrap' ).removeClass( 'zillah-only-customizer' );
			}
  		} );
	} );

	// Slider
	wp.customize( 'zillah_home_slider_show', function( value ) {
		value.bind( function( to ) {

			alert( to );

			if( to != '' ) {
				$( '#home-carousel' ).removeClass( 'zillah-only-customizer' );
			}
			else {
				$( '#home-carousel' ).addClass( 'zillah-only-customizer' );
			}
		} );
	} );

	// Social repeater
	wp.customize( "zillah_social_icons", function( value ) {
		value.bind( function( to ) {
			var obj = JSON.parse( to );
			var result ="";

			var lastIcon = $( '.social-media-icons li:last-child' );
			
			obj.forEach(function(item) {
				result+=  '<li><a href="' + item.link + '" class="social-icon"><i class="fa ' + item.icon_value + '"></i></a></li>';
			});
			
			if ( ! lastIcon.hasClass("zillah-only-customizer") ){
				result+= '<li><button type="button" class="search-opt search-toggle"><i class="fa fa-search"></i></button><div class="header-search"></div></li>';
			} else {
				result+= '<li class="zillah-only-customizer"><button type="button" class="search-opt search-toggle"><i class="fa fa-search"></i></button><div class="header-search"></div></li>';
			}
			$( '.social-media-icons' ).html( result );
			zillah_header_social_icons_width();
			zillah_menu_toggle_height();
		} );
	} );


	// Page header image
	wp.customize( "zillah_page_header", function( value ) {
		value.bind( function( to ) {
			$('.page-main-header').css('background-image','url("'+ to +'")');
		} );
	} );

} )( jQuery );
