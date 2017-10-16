<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */


	$post_format = get_post_format();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post entry-content-wrap' ); ?>>

	<?php if ( $post_format !== 'quote' ) : ?>
		<header class="entry-header">
			<div class="content-inner-wrap">
				<?php
				zillah_posted_date();
				the_title( '<h2 class="entry-title entry-title-blog"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				zillah_category();
				?>
			</div>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<?php
	if ( $post_format === 'video' ) {
		zillah_post_video();
	} elseif ( $post_format === 'gallery' ) {
		zillah_post_gallery();
	} elseif ( $post_format === 'image' ) {
		zillah_post_image();
	} else {
		zillah_post_thumbnail();
	}
	?>

	<?php zillah_hook_entry_before(); ?>
	<div class="entry-content">
		<div class="content-inner-wrap">
			<?php zillah_hook_entry_top(); ?>
			<?php

			if ( $post_format === 'quote' || $post_format === 'aside' || $post_format === 'audio' || $post_format === 'chat' || $post_format === 'link' || $post_format === 'status' ) {
				the_content();
			} else {
				$pos = strpos( $post->post_content, '<!--more-->' );
				if ( $pos <= 0 ) {
					the_excerpt();
				} else {
					the_content( false );
					echo zillah_read_more_link();
				}

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zillah' ),
						'after'  => '</div>',
					)
				);
			}
			?>
			<?php zillah_hook_entry_bottom(); ?>
		</div>
	</div><!-- .entry-content -->
	<?php zillah_hook_entry_after(); ?>

</article><!-- #post-## -->
