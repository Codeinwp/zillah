<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package zillah
 */

if ( ! function_exists( 'zillah_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function zillah_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

			$posted_on = sprintf(
				/* translators: s: post date */
				esc_html_x( 'Posted on %s', 'post date', 'zillah' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				/* translators: s: post author */
				esc_html_x( 'by %s', 'post author', 'zillah' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'zillah_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function zillah_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			$zillah_tags_show = get_theme_mod( 'zillah_tags_show', false );

			if ( $zillah_tags_show === true || is_customize_preview() ) {
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'zillah' ) );
				if ( $tags_list ) {
					/* translators: 1: tags */
					printf( '<span class="tags-links' . ( $zillah_tags_show === false && is_customize_preview() ? ' zillah-only-customizer' : '' ) . '">' . esc_html__( 'Tagged %1$s', 'zillah' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				}
			}
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( ' Edit %s', 'zillah' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function zillah_categorized_blog() {
	$all_the_cool_cats = get_transient( 'zillah_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'zillah_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so zillah_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so zillah_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in zillah_categorized_blog.
 */
function zillah_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'zillah_categories' );
}
add_action( 'edit_category', 'zillah_category_transient_flusher' );
add_action( 'save_post', 'zillah_category_transient_flusher' );



if ( ! function_exists( 'zillah_posted_date' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date.
	 */
	function zillah_posted_date() {
		$show_updated = get_theme_mod( 'zillah_show_updated', false );
		$time_string  = '<time class="entry-date published updated" datetime="%1$s" itemprop="dateModified">%2$s</time><meta itemprop="datePublished" content="%2$s">';

		if ( ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time><meta itemprop="datePublished" content="%4$s">';
			if ( (bool) $show_updated === true ) {
				$time_string = '%5$s <time datetime="%3$s" itemprop="dateModified">%4$s</time><meta itemprop="datePublished" content="%4$s">';
			}
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() ),
			esc_html__( 'Last Updated:', 'zillah' ),
			esc_html__( 'Posted:', 'zillah' )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;



if ( ! function_exists( 'zillah_category' ) ) :
	/**
	 * Prints HTML with meta information for the category.
	 */
	function zillah_category() {

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'zillah' ) );
		if ( $categories_list ) {
			printf(
				'<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'zillah' ),
				$categories_list
			);
		}
	}
endif;


if ( ! function_exists( 'zillah_comments_number' ) ) :
	/**
	 * Prints comments number.
	 */
	function zillah_comments_number() {

		echo '<span class="alt-comments-number">';

		$comments_number = get_comments_number();
		if ( 1 === $comments_number ) {
			/* translators: %s: post title */
			printf( _x( '1 Comment', 'comments title', 'zillah' ) );
		} else {
			printf(
				/* translators: 1: number of comments, 2: post title */
				_nx(
					'%1$s Comment',
					'%1$s Comments',
					$comments_number,
					'comments title',
					'zillah'
				),
				number_format_i18n( $comments_number )
			);
		}

		echo '</span>';
	}
endif;
