<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-post entry-content-wrap' ); ?>>
	<div class="content-inner-wrap">

		<header class="entry-header">
			<div class="content-inner-wrap">
				<?php
				zillah_posted_date();
				the_title( '<h2 class="entry-title entry-title-blog"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				zillah_category();
				?>
			</div>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	</div>
</article><!-- #post-## -->
