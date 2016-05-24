<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content-wrap' ); ?>>

	<header class="entry-header">
		<div class="content-inner-wrap">
			<?php
			zillah_posted_date();
			the_title( '<h1 class="entry-title">', '</h1>' );
			zillah_category();
			?>
		</div>
	</header><!-- .entry-header -->

	<?php
	if ( has_post_thumbnail() ) {
		echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail" rel="bookmark">';
		the_post_thumbnail( 'post-thumbnail' );
		echo '</a>';
	}
	?>

	<div class="entry-content">
		<div class="content-inner-wrap">
			<?php

				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'zillah' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zillah' ),
					'after'  => '</div>',
				) );

			?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
