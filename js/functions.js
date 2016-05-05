/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, subMenus, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.parentNode.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

} )();


/**
 * Those two functions are global because they need to be accesible from customizer.js
 */
function theMotion_header_social_icons_width() {
	var totalWidth = 0;
	jQuery( '.header-social-icons li' ).each( function() {
		totalWidth += jQuery( this ).outerWidth();
	} );
	jQuery( '.header-social-icons' ).css( 'width', totalWidth+10 );
}

function theMotion_menu_toggle_height() {
	var menuToggleBtn = jQuery( 'button.menu-toggle' );
	var siteHeader = jQuery( '.site-header' );
	if( ! menuToggleBtn ) {
		return false;
	}
	menuToggleBtn.css( 'min-height', '1px' );
	menuToggleBtn.css( 'min-height', siteHeader.outerHeight() );
}

( function($) {

	$( document ).ready( function() {
		theMotion_header_social_icons_width();
		theMotion_menu_toggle_height();
	} );

	$( window ).resize( function() {
		theMotion_header_social_icons_width();
		theMotion_menu_toggle_height();
	} );



	$( '.search-toggle' ).click( function( event ) {
		if( $( this ).hasClass( 'search-toggle' ) ) {
			$( '.search-opt' ).removeClass( 'search-toggle' );
			$( '.header-search' ).addClass( 'search-toggle-open' );
		} else {
			$( '.search-toggle-open' ).removeClass( 'search-toggle-open' );
			$( '.search-opt' ).addClass( 'search-toggle' );
		}
		event.stopPropagation();
	} );

	$( 'html' ).click( function() {
		$( '.search-toggle-open' ).removeClass( 'search-toggle-open' );
		$( '.search-opt' ).addClass( 'search-toggle' );
	} );

} )(jQuery);




//ACCESSIBILITY MENU
( function( $ ) {

    function initMainNavigation( container ) {
        // Add dropdown toggle that display child menu items.
        container.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false">' + screenReaderText.expand + '</button>' );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
            var _this = $( this );
            e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			_this.html( _this.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		});
    }
    
    initMainNavigation( $( '.main-navigation' ) );
    
    masthead = $( '#masthead' );
	menuToggle       = masthead.find( '#menu-toggle' );
	siteHeaderMenu   = masthead.find( '#site-header-menu' );
	siteNavigation   = masthead.find( '#site-navigation' ); 
    
    // Enable menuToggle.
	( function() {
		// Return early if menuToggle is missing.
        if ( ! menuToggle ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggle.click(function() {
			$( this ).add( siteHeaderMenu ).toggleClass( 'toggled-on' );
		} );
	} )();


    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
        if ( ! siteNavigation || ! siteNavigation.children().length ) {
			return;
		}

		if ( 'ontouchstart' in window ) {
			siteNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart.parallax-one', function( e ) {
				var el = $( this ).parent( 'li' );
				if ( ! el.hasClass( 'focus' ) ) {
					e.preventDefault();
					el.toggleClass( 'focus' );
					el.siblings( '.focus' ).removeClass( 'focus' );
				}
			} );
		}

		siteNavigation.find( 'a' ).on( 'focus.parallax-one blur.parallax-one', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();


	// Add he default ARIA attributes for the menu toggle and the navigations.
	function onResizeARIA() {
		if ( 910 > window.innerWidth ) {
			if ( menuToggle.hasClass( 'toggled-on' ) ) {
				menuToggle.attr( 'aria-expanded', 'true' );
			} else {
				menuToggle.attr( 'aria-expanded', 'false' );
			}

			if ( siteHeaderMenu.hasClass( 'toggled-on' ) ) {
				siteNavigation.attr( 'aria-expanded', 'true' );
			} else {
				siteNavigation.attr( 'aria-expanded', 'false' );
			}

			menuToggle.attr( 'aria-controls', 'site-navigation social-navigation' );
		} else {
			menuToggle.removeAttr( 'aria-expanded' );
			siteNavigation.removeAttr( 'aria-expanded' );
			menuToggle.removeAttr( 'aria-controls' );
		}
	}
    
    $( document ).ready( function() {
		$( window ).on( 'load.parallax-one', onResizeARIA )
	} );
    
    
} )( jQuery );
