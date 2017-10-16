<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

get_header(); ?>

	</div><!-- .container -->

	<?php zillah_hook_page_before(); ?>
	<header class="page-main-header">
		<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</header><!-- .entry-header -->

	<div class="container">

		<div class="content-wrap">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php zillah_hook_page_top(); ?>

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							echo '<div class="comments-area-wrap">';
							comments_template();
							echo '</div>';
						endif;

					endwhile; // End of the loop.
					?>
					<?php zillah_hook_page_bottom(); ?>
				</main><!-- #main -->
			</div><!-- #primary -->

		</div><!-- .content-wrap -->
	<?php zillah_hook_page_after(); ?>

<?php
get_footer();
