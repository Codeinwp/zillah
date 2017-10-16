<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article  entry-content-wrap' ); ?>>
	<div class="content-inner-wrap">

		<?php zillah_hook_entry_before(); ?>
		<div class="entry-content">
			<?php zillah_hook_entry_top(); ?>
			<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zillah' ),
						'after'  => '</div>',
					)
				);
			?>
			<?php zillah_hook_entry_bottom(); ?>
		</div><!-- .entry-content -->
		<?php zillah_hook_entry_after(); ?>

		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'zillah' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->

	</div>
</article><!-- #post-## -->
