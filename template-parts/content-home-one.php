<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-sm-12 col-md-12 col-lg-6  recently-posted-item' ); ?>>
	<header class="entry-header">
		
		<?php 
			echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';

			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'post-thumbnail' );
			} else {
				echo '<img width="790" height="300" src="' . get_template_directory_uri() . '/images/default-thumbnail.jpg" class="attachment-post-thumbnail wp-post-image" alt="">';
			}
			the_title( '<span class="home-entry-title">', '</span>' );
			echo '</a>'; 
		?>

	</header><!-- .entry-header -->
</article><!-- #post-## -->
