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
 * Scroll to top
 */
( function($) {

	$( document ).ready( function() {

		$( '#to-top' ).click(function(){
			$( 'html, body' ).animate( {
				scrollTop : 0
			}, 800 );
			return false;
		});

	} );

} )(jQuery);



//ACCESSIBILITY MENU
( function( $ ) {

	/* global screenReaderText */

    function initMainNavigation( container ) {

        // Add dropdown toggle that display child menu items.
        container.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"><span class="dropdown-toggle-inner">' + screenReaderText.expand + '</span></button>' );

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
			_this.find( '.dropdown-toggle-inner' ).html( _this.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		});
    }
    
    initMainNavigation( $( '.main-navigation' ) );
    
    var masthead = $( '#masthead' ),
	    menuToggle       = masthead.find( '#menu-toggle' ),
	    siteHeaderMenu   = masthead.find( '#site-header-menu' ),
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
		$( window ).on( 'load.parallax-one', onResizeARIA );


		$( '#carousel-post-gallery' ).carousel({
			interval: 2000
		});

	} );

	// Enable menuToggle.
	( function() {

		var $sidebarButton = $( '.sidebar-mobile-title' );

		if ( ! $sidebarButton ) {
			return;
		}

		// Add an initial values for the attribute.
		$sidebarButton.click(function() {
			$( this ).parent().toggleClass( 'widget-area-mobile-open' );
		} );
        
	} )();

    
} )( jQuery );



/* scroll down sticky header */
(function($,window) {

    var headerHeight,
        isAdminBar,
        lastScrollTop       = 0,
        initTop             = 0,
        changeDirection     = false,
        lastDirectionDown   = false;
    var $headerToHide       = $( '.header-inner-top' ),
        $body               = $( 'body' );

    if( window.innerWidth >= 992 ) {

        $(document).ready(function () {
            headerHeight    = $headerToHide.height();
            isAdminBar      = $( '#wpadminbar' ).length > 0 ? true : false;
            initTop         = isAdminBar && window.innerWidth > 768 ? 32 : 0;
            $body.css( 'padding-top', headerHeight );

        });

        $(window).resize(function () {
            headerHeight    = $headerToHide.height();
            initTop         = isAdminBar && window.innerWidth > 992 ? 32 : 0;
			$body.css( 'padding-top', window.innerWidth > 992 ? headerHeight : 0 );
        });

        $(window).scroll(function () {
            var thisScrollTop = $(this).scrollTop();
            changeDirection = ( thisScrollTop > headerHeight && (thisScrollTop > lastScrollTop && lastDirectionDown === false) || (thisScrollTop < lastScrollTop && lastDirectionDown === true) ? true : false );
            if (changeDirection === true) {
                $headerToHide.toggleClass('hide-header');
                lastDirectionDown = ( lastDirectionDown === false ? true : false );
            }
            $headerToHide.css( {
                'top': $headerToHide.hasClass('hide-header') ? (-1) * headerHeight : initTop
            } );
            lastScrollTop = thisScrollTop;
        });

    } else {
        $body.css( 'padding-top', '0' );
    }

} )(jQuery,window);
