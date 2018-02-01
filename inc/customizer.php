<?php
/**
 * Zillah Theme Customizer.
 *
 * @package zillah
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zillah_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default    = '7fcaad';
	$wp_customize->get_setting( 'header_image' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'header_image_data' )->transport = 'postMessage';

	require_once( 'class/class-zillah-category-control.php' );
	require_once( 'class/class-zillah-google-fonts-control.php' );

	$wp_customize->get_control( 'blogname' )->priority        = 3;
	$wp_customize->get_control( 'blogdescription' )->priority = 4;

	$custom_logo = $wp_customize->get_control( 'custom_logo' );
	if ( ! empty( $custom_logo ) ) {
		$wp_customize->get_control( 'custom_logo' )->priority = 5;
	}

	/* Title tagline */
	$wp_customize->add_setting(
		'zillah_tagline_show', array(
			'default'           => 0,
			'sanitize_callback' => 'zillah_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zillah_tagline_show', array(
			'label'    => esc_html__( 'Hide Site Title', 'zillah' ),
			'section'  => 'title_tagline',
			'priority' => 50,
			'type'     => 'checkbox',
		)
	);

	/* Advanced options */
	$wp_customize->add_section(
		'zillah_home_theme_option_section', array(
			'title'    => esc_html__( 'Theme options', 'zillah' ),
			'priority' => 20,
		)
	);

	/* Alternative layout */
	$wp_customize->add_setting(
		'zillah_alt_layout', array(
			'default'           => false,
			'sanitize_callback' => 'zillah_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zillah_alt_layout', array(
			'label'       => esc_html__( 'Alternative layout', 'zillah' ),
			'description' => esc_html__( 'If you check this box, the alternative layout will be used on blog and single page.', 'zillah' ),
			'section'     => 'zillah_home_theme_option_section',
			'priority'    => 1,
			'type'        => 'checkbox',
		)
	);

	/* Show sidebar */
	$wp_customize->add_setting(
		'zillah_sidebar_show', array(
			'default'           => false,
			'sanitize_callback' => 'zillah_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zillah_sidebar_show', array(
			'label'       => esc_html__( 'Show sidebar', 'zillah' ),
			'description' => esc_html__( 'If you check this box, the sidebar will appear on homepage and archive page.', 'zillah' ),
			'section'     => 'zillah_home_theme_option_section',
			'priority'    => 1,
			'type'        => 'checkbox',
		)
	);

	/* Show Tags */
	$wp_customize->add_setting(
		'zillah_tags_show', array(
			'default'           => false,
			'sanitize_callback' => 'zillah_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zillah_tags_show', array(
			'label'       => esc_html__( 'Show tags', 'zillah' ),
			'description' => esc_html__( 'If you check this box, the tags will appear in posts.', 'zillah' ),
			'section'     => 'zillah_home_theme_option_section',
			'priority'    => 2,
			'type'        => 'checkbox',
		)
	);

	/* Get image as featured */
	$wp_customize->add_setting(
		'zillah_image_as_thumbnail', array(
			'default'           => false,
			'sanitize_callback' => 'zillah_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zillah_image_as_thumbnail', array(
			'label'    => esc_html__( 'Get 1st image in the post as featured.', 'zillah' ),
			'section'  => 'zillah_home_theme_option_section',
			'priority' => 2,
			'type'     => 'checkbox',
		)
	);

	/* Show updated date */
	$wp_customize->add_setting(
		'zillah_show_updated', array(
			'default'           => false,
			'sanitize_callback' => 'zillah_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'zillah_show_updated', array(
			'label'    => esc_html__( 'Show updated date in post header.', 'zillah' ),
			'section'  => 'zillah_home_theme_option_section',
			'priority' => 3,
			'type'     => 'checkbox',
		)
	);

	/* Featured Content Slider */
	$wp_customize->add_section(
		'zillah_featured_content_slider_section', array(
			'title'    => esc_html__( 'Featured content slider', 'zillah' ),
			'priority' => 25,
		)
	);

	$wp_customize->add_setting(
		'zillah_home_slider_show', array(
			'default'           => 0,
			'sanitize_callback' => 'zillah_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'zillah_home_slider_show', array(
			'label'       => esc_html__( 'Show slider', 'zillah' ),
			'description' => esc_html__( 'If you check this box, the slider area will appear on the homepage.', 'zillah' ),
			'section'     => 'zillah_featured_content_slider_section',
			'priority'    => 1,
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'zillah_home_slider_category', array(
			'default'           => 0,
			'sanitize_callback' => 'zillah_sanitize_category_dropdown',
		)
	);

	$wp_customize->add_control(
		new Zillah_Category_Control(
			$wp_customize, 'zillah_home_slider_category', array(
				'label'    => 'Category',
				'section'  => 'zillah_featured_content_slider_section',
				'priority' => 2,
			)
		)
	);

	/* Colors */
	require_once( 'class/class-zillah-palette.php' );
	$wp_customize->add_setting(
		'zillah_palette_picker', array(
			'sanitize_callback' => 'zillah_sanitize_palette',
		)
	);

	$wp_customize->add_control(
		new Zillah_Palette(
			$wp_customize, 'zillah_palette_picker', array(
				'label'    => esc_html__( 'Change the color scheme', 'zillah' ),
				'section'  => 'colors',
				'priority' => 1,
			)
		)
	);

	/* Google fonts  */
	$wp_customize->add_setting(
		'zillah_google_fonts_one', array(
			'default'           => 0,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new Zillah_Google_Fonts_Control(
			$wp_customize, 'zillah_google_fonts_one', array(
				'label'           => 'Select first font family ( content )',
				'section'         => 'zillah_home_theme_option_section',
				'priority'        => 4,
				'ti_google_fonts' => apply_filters( 'zillah_filter_body_fonts', array(
					array(
						'font_family' => 'Merriweather',
						'type'        => 'serif',
						'subset'      => '400',
					),
					array(
						'font_family' => 'Open Sans',
						'type'        => 'sans-serif',
						'subset'      => '400',
					),
					array(
						'font_family' => 'Josefin Slab',
						'type'        => 'serif',
						'subset'      => '400',
					),
					array(
						'font_family' => 'Ubuntu',
						'type'        => 'sans-serif',
						'subset'      => '400',
					),
					array(
						'font_family' => 'Vollkorn',
						'type'        => 'serif',
						'subset'      => '400',
					),

				) ),
			)
		)
	);

	$wp_customize->add_setting(
		'zillah_google_fonts_two', array(
			'default'           => 0,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new Zillah_Google_Fonts_Control(
			$wp_customize, 'zillah_google_fonts_two', array(
				'label'           => 'Select second font family ( headings )',
				'section'         => 'zillah_home_theme_option_section',
				'priority'        => 5,
				'ti_google_fonts' => array(
					array(
						'font_family' => 'Cabin',
						'type'        => 'sans-serif',
						'subset'      => '400',
					),
					array(
						'font_family' => 'Lato',
						'type'        => 'sans-serif',
						'subset'      => '400',
					),
					array(
						'font_family' => 'Arvo',
						'type'        => 'serif',
						'subset'      => '400',
					),
					array(
						'font_family' => 'Open Sans',
						'type'        => 'sans-serif',
						'subset'      => '400',
					),
					array(
						'font_family' => 'Ubuntu',
						'type'        => 'sans-serif',
						'subset'      => '400',
					),
				),
			)
		)
	);

	/* Font size */
	$wp_customize->add_setting(
		'zillah_select_box_font_size', array(
			'default'           => '16px',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'zillah_select_box_font_size', array(
			'label'    => 'Select Font Size:',
			'section'  => 'zillah_home_theme_option_section',
			'priority' => 6,
			'type'     => 'select',
			'choices'  => array(
				'14px' => 'Small',
				'16px' => 'Medium',
				'18px' => 'Large',
			),
		)
	);

	if ( ! $custom_logo ) {

		$wp_customize->add_setting(
			'zillah_logo_old', array(
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize, 'zillah_logo_old', array(
					'label'    => __( 'Logo', 'zillah' ),
					'section'  => 'title_tagline',
					'settings' => 'zillah_logo_old',
				)
			)
		);

	}

}
add_action( 'customize_register', 'zillah_customize_register' );

/**
 * Sanitization functions
 */
function zillah_sanitize_checkbox( $input ) {
	return ( isset( $input ) && true == $input ? true : false );
}

/**
 * Function to sanitize the select controls
 *
 * @param string $input The value to sanitize.
 * @param object $setting The setting of the control.
 *
 * @return mixed
 */
function zillah_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Function to sanitize the categories controls
 *
 * @param integer $input The value to sanitize (selected id of category).
 *
 * @return string
 */
function zillah_sanitize_category_dropdown( $input ) {
	$cat = get_the_category_by_ID( $input );
	if ( empty( $cat ) ) {
		return '';
	}
	return $input;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zillah_customize_preview_js() {
	wp_enqueue_script( 'zillah_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.1', true );
}
add_action( 'customize_preview_init', 'zillah_customize_preview_js' );

/**
 * Function to sanitize the palette control
 *
 * @param string $input The value to sanitize.
 *
 * @return string
 */
function zillah_sanitize_palette( $input ) {
	if ( ! empty( $input ) ) {
		$json         = json_decode( $input, true );
		$palette_name = array( 'p1', 'p2', 'p3' );
		$red          = '';
		$green        = '';
		$blue         = '';

		foreach ( $json as $key => $value ) {
			switch ( $key ) {
				case 'palette_name':
					if ( ! in_array( $value, $palette_name, true ) ) {
						return '';
					}
					break;
				default:
					$value = str_replace( ' ', '', $value );
					sscanf( $value, 'rgb(%d,%d,%d)', $red, $green, $blue );
					$value = 'rgb(' . $red . ',' . $green . ',' . $blue . ')';
					if ( ! zillah_is_color( $red ) || ! zillah_is_color( $green ) || ! zillah_is_color( $blue ) ) {
						return '';
					} else {
						$json[ $key ] = $value;
					}
			}
		}
		return json_encode( $json );
	}
	return '';
}

/**
 * Check if the value is a color
 *
 * @param string $value The value to check.
 *
 * @return bool
 */
function zillah_is_color( $value ) {
	return $value >= 0 && $value <= 255;
}
