/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize(
		'blogname', function( value ) {
			value.bind(
				function( to ) {
					$( '.site-title a' ).text( to );
				}
			);
		}
	);

	wp.customize(
		'blogdescription', function( value ) {
			value.bind(
				function( to ) {
					$( '.site-description' ).text( to );
				}
			);
		}
	);

	// Header text color.
	wp.customize(
		'header_textcolor', function( value ) {
			value.bind(
				function( to ) {
					var color = '';
					if ( '' !== to ) {
						color = to;

					} else {
						var palette = wp.customize._value.zillah_palette_picker();
						if (typeof palette !== 'undefined' && palette !== '') {
							var obj = JSON.parse( palette );
							if (typeof obj.color2 !== 'undefined') {
								color = obj.color2;
							}
						} else {
							color = '#6ca790';
						}
					}

					if (color !== '') {
						$( '.site-title a' ).css(
							{
								'color': color
							}
						);
					}
				}
			);
		}
	);

	// Hide Site Title
	wp.customize(
		'zillah_tagline_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== false ) {
						$( '.header-title-wrap' ).addClass( 'zillah-only-customizer' );
					} else {
						$( '.header-title-wrap' ).removeClass( 'zillah-only-customizer' );
					}
				}
			);
		}
	);

	// Slider
	wp.customize(
		'zillah_home_slider_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== false ) {
						$( '#home-carousel' ).removeClass( 'zillah-only-customizer' );
					} else {
						$( '#home-carousel' ).addClass( 'zillah-only-customizer' );
					}
				}
			);
		}
	);

	// Slider
	wp.customize(
		'zillah_tags_show', function( value ) {
			value.bind(
				function( to ) {
					if ( to !== false ) {
						$( '.tags-links' ).removeClass( 'zillah-only-customizer' );
					} else {
						$( '.tags-links' ).addClass( 'zillah-only-customizer' );
					}
				}
			);
		}
	);

	// Social repeater
	wp.customize(
		'zillah_social_icons', function( value ) {
			value.bind(
				function( to ) {
					var obj    = JSON.parse( to );
					var result = '';

					var lastIcon = $( '.social-media-icons li:last-child' );

					obj.forEach(
						function(item) {
							result += '<li><a href="' + item.link + '" class="social-icon"><i class="fa ' + item.icon_value + '"></i></a></li>';
						}
					);

					if ( ! lastIcon.hasClass( 'zillah-only-customizer' ) ) {
						result += '<li><button type="button" class="search-opt search-toggle"><i class="fa fa-search"></i></button><div class="header-search"></div></li>';
					} else {
						result += '<li class="zillah-only-customizer"><button type="button" class="search-opt search-toggle"><i class="fa fa-search"></i></button><div class="header-search"></div></li>';
					}
					$( '.social-media-icons' ).html( result );
				}
			);
		}
	);

	// Page header image
	wp.customize(
		'zillah_page_header', function( value ) {
			value.bind(
				function( to ) {
					$( '.page-main-header' ).css( 'background-image','url("' + to + '")' );
				}
			);
		}
	);

	// Sidebar
	wp.customize(
		'zillah_sidebar_show', function( value ) {
			value.bind(
				function( to ) {
					if ( ! $( 'body' ).hasClass( 'single-post' ) && ! $( 'body' ).hasClass( 'page' ) ) {
						if (to !== false) {
							$( '#secondary' ).removeClass( 'zillah-only-customizer' );
							$( '.content-area' ).addClass( 'content-area-with-sidebar' );
						} else {
							$( '#secondary' ).addClass( 'zillah-only-customizer' );
							$( '.content-area' ).removeClass( 'content-area-with-sidebar' );
						}
					}
				}
			);
		}
	);

	// Header Image
	wp.customize(
		'header_image', function( value ) {
			value.bind(
				function( to ) {
					$( '.header-inner-site-branding' ).css( 'background-image', 'url(' + to + ')' );
				}
			);
		}
	);

} )( jQuery );
