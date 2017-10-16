<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zillah
 */

get_header();

$zillah_alternative_layout = get_theme_mod( 'zillah_alt_layout', false );

?>

	<div class="content-wrap">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();

				$alternative = $zillah_alternative_layout == false ? $zillah_alternative_layout : '-alternative';
				get_template_part( 'template-parts/content', 'single' . $alternative );

				the_post_navigation(
					array(
						'prev_text' => _x( '<span class="post-title">%title</span>', 'previous post', 'zillah' ),
						'next_text' => _x( '<span class="post-title">%title</span>', 'next post', 'zillah' ),
					)
				);

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					echo '<div class="comments-area-wrap">';
					comments_template();
					echo '</div>';
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .content-wrap -->

<?php
get_footer();
