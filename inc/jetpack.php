<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package zillah
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function zillah_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'zillah_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	add_theme_support( 'jetpack-related-posts' );

	add_theme_support(
		'social-links', array(
			'facebook',
			'twitter',
			'linkedin',
			'google_plus',
			'tumblr',
		)
	);

}
add_action( 'after_setup_theme', 'zillah_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function zillah_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

/**
 * Add theme support for Pirate Forms
 */
function zillah_theme_setup() {

	add_theme_support( 'pirate-forms' );

}
add_action( 'after_setup_theme', 'zillah_theme_setup' );
