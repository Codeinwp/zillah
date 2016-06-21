
/********************************************
 *** Palette Control ***
 *********************************************/

jQuery(document).ready(function () {
    jQuery('.zillah_dropdown').on('click', function () {
        jQuery('.zillah_palette_picker').slideToggle('medium');
    });

    jQuery('.zillah_palette_input').on('click', function () {
        jQuery('.zillah_palette_picker').slideToggle('medium');
    });

    jQuery('.zillah_palette_picker').on('click', 'li', function () {
        var th = jQuery(this);
        if (!jQuery(this).hasClass('zillah_pallete_default')) {

            var values = {};
            var it = 0;
            var metro_palette = jQuery(this).html();


            jQuery('.zillah_palette_input').html(metro_palette);

            jQuery('.zillah_palette_input span').each(function () {
                it++;
                var colval = jQuery(this).css('background-color');
                values['color' + it] = colval;
            });
            th.parent().parent().find('.zillah_palette_colector').val(JSON.stringify(values));
            th.parent().parent().find('.zillah_palette_colector').trigger('change');
        } else {
            var zillah_pallete_default = th.text();
            jQuery('.zillah_palette_input').text(zillah_pallete_default);
            th.parent().parent().find('.zillah_palette_colector').val('');
            th.parent().parent().find('.zillah_palette_colector').trigger('change');
        }
    });
});



jQuery( document ).ready( function() {

    jQuery( '.ti-google-fonts input:radio:checked' ).parent( 'label' ).addClass( 'ti-google-fonts-active' );
    jQuery( '.ti-google-fonts input' ).click( function() {
        jQuery( this ).parent().parent().find( '.ti-google-fonts-active' ).removeClass( 'ti-google-fonts-active' );
        jQuery( this ).parent().addClass( 'ti-google-fonts-active' );
    });

});
