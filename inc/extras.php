<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package zillah
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function zillah_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'zillah_body_classes' );


/**
 * Slider Posts to body Posts on mobile.
 */
function zillah_slider_to_posts() {

	$zillah_categ = get_theme_mod( 'zillah_home_slider_category' );
	if ( ! empty( $zillah_categ ) ) {
		$args = array(
			'posts_per_page'      => 6,
			'cat'                 => $zillah_categ,
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) { ?>

			<?php
			/* Start the Loop */
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				/*
	            * Include the Post-Format-specific template for the content.
	            * If you want to override this in a child theme, then include a file
	            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	            */
				get_template_part( 'template-parts/content', get_post_format() );
			}
			the_posts_navigation();
		} else {
			get_template_part( 'template-parts/content', 'none' );
		}
		/* Restore original Post Data */
		wp_reset_postdata();
	}
	die();
}

add_action( 'wp_ajax_nopriv_request_post', 'zillah_slider_to_posts' );
add_action( 'wp_ajax_request_post', 'zillah_slider_to_posts' );
