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
		echo '<div class="post-thumbnail-wrap">';
		the_post_thumbnail();
		echo '</div>';
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

	<footer class="entry-footer">
		<div class="content-inner-wrap">
			<?php zillah_entry_footer(); ?>
		</div>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

<div class="author-details-wrap">
	<div class="content-inner-wrap">
		<div class="author-details-img-wrap">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?>
		</div>
		<div class="author-details-title">
			<?php echo get_the_author_meta( 'first_name' ) . ' ' . get_the_author_meta( 'last_name' ); ?>
		</div>
		<div class="author-details-content"><?php echo nl2br(get_the_author_meta('description')); ?></div>
	</div>
</div>