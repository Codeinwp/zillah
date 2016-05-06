<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
		if ( ! is_single() ) {
			if ( has_post_thumbnail() ) {
				echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail" rel="bookmark">';
				the_post_thumbnail();
				echo '</a>';
			}
		}
	?>

	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		 ?>
		 <?php 
		 	echo '<div class="categories-links">' . get_the_category_list( ', ', 'zillah') . '</div>';
		 ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
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
	</div><!-- .entry-content -->

</article><!-- #post-## -->
