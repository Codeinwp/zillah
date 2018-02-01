/********************************************
 * ** Palette Control ***
 *********************************************/
/*global jQuery*/
jQuery( document ).ready(
	function () {
		'use strict';
		jQuery( '.zillah_dropdown' ).on(
			'click', function () {
				jQuery( '.zillah_palette_picker' ).slideToggle( 'medium' );
			}
		);

		jQuery( '.zillah_palette_input' ).on(
			'click', function () {
				jQuery( '.zillah_palette_picker' ).slideToggle( 'medium' );
			}
		);

		jQuery( '.zillah_palette_picker' ).on(
			'click', 'li', function () {
				var th           = jQuery( this );
				var palette      = jQuery( this ).html();
				var palette_name = jQuery( this ).attr( 'class' );

				if ( ! th.hasClass( 'zillah_pallete_default' )) {
					var values = {};
					var it     = 0;

					values.palette_name = palette_name;

					jQuery( '.zillah_palette_input' ).html( palette );
					jQuery( '.zillah_palette_input span' ).each(
						function () {
							it++;
							values['color' + it] = jQuery( this ).css( 'background-color' );
						}
					);
					th.parent().parent().find( '.zillah_palette_colector' ).val( JSON.stringify( values ) );
					th.parent().parent().find( '.zillah_palette_colector' ).trigger( 'change' );
				} else {
					var zillah_pallete_default = th.text();
					jQuery( '.zillah_palette_input' ).text( zillah_pallete_default );
					th.parent().parent().find( '.zillah_palette_colector' ).val( '' );
					th.parent().parent().find( '.zillah_palette_colector' ).trigger( 'change' );
				}
			}
		);
	}
);



jQuery( document ).ready(
	function() {
			'use strict';
			jQuery( '.ti-google-fonts input:radio:checked' ).parent( 'label' ).addClass( 'ti-google-fonts-active' );
			jQuery( '.ti-google-fonts input' ).click(
				function() {
					jQuery( this ).parent().parent().find( '.ti-google-fonts-active' ).removeClass( 'ti-google-fonts-active' );
					jQuery( this ).parent().addClass( 'ti-google-fonts-active' );
				}
			);

	}
);
