<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'recently-item' ); ?>>

	<?php
		if ( has_post_thumbnail() ) {
			echo '<a href="' . esc_url( get_permalink() ) . '" class="recently-image-wrap">';
			the_post_thumbnail();
			echo '</a>';
		}
	?>

	<div class="recently-content-wrap">
		<header class="entry-header">
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php

				the_excerpt();

				echo '<span class="clearfix"></span><a href="'. esc_url( get_permalink() ) . '" class="more-link">' . __('Read more ', 'zillah' ) . the_title( '<span class="screen-reader-text">"', '"</span>', false ) . ' <span class="meta-nav">&rarr;</span></a>';

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zillah' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>

</article><!-- #post-## -->
