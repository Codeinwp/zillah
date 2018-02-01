<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

$zillah_sidebar_show = get_theme_mod( 'zillah_sidebar_show', false );

$post_format = get_post_format();
?>

<article
		id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-alt entry-content-wrap' . ( $zillah_sidebar_show ? 'col-xs-12 col-md-6 blog-post-alt-sidebar' : 'col-xs-12 col-md-6 col-lg-4' ) ); ?>>
	<div class="blog-post-alt-inner">

		<?php if ( $post_format !== 'quote' ) : ?>
			<header class="entry-header">
				<div class="content-inner-wrap content-inner-wrap-blog-alt">
					<?php
					zillah_posted_date();

					if ( $post_format === 'video' ) {
						zillah_post_video();
					} elseif ( $post_format === 'gallery' ) {
						zillah_post_gallery();
					} elseif ( $post_format === 'image' ) {
						zillah_post_image();
					} else {
						zillah_post_thumbnail();
					}

					the_title( '<h2 class="entry-title entry-title-blog"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					?>
				</div>
			</header><!-- .entry-header -->
		<?php endif; ?>

		<?php zillah_hook_entry_before(); ?>
		<div class="entry-content">
			<div class="content-inner-wrap">
				<?php
				zillah_hook_entry_top();
				echo zillah_read_more_link_alt();
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zillah' ),
						'after'  => '</div>',
					)
				);
				zillah_hook_entry_bottom();
				?>
			</div>
		</div><!-- .entry-content -->
		<?php zillah_hook_entry_after(); ?>

	</div>
</article><!-- #post-## -->
