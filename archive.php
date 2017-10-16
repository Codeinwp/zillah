<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

$zillah_sidebar_show = get_theme_mod( 'zillah_sidebar_show', false );

get_header(); ?>

	</div><!-- .container -->
	<?php zillah_hook_archive_before(); ?>

	<header class="page-header">
		<div class="container">
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
		</div>
	</header><!-- .page-header -->

	<div class="container">

		<div class="content-wrap">

			<div id="primary" class="content-area content-area-arch<?php echo $zillah_sidebar_show !== false ? ' content-area-with-sidebar' : ''; ?>">
				<main id="main" class="site-main" role="main">
					<?php zillah_hook_archive_top(); ?>

				<?php
				if ( have_posts() ) :
				?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

					<?php zillah_hook_archive_bottom(); ?>
				</main><!-- #main -->
			</div><!-- #primary -->

			<?php
			if ( $zillah_sidebar_show !== false || ( $zillah_sidebar_show === false && is_customize_preview() ) ) {
				get_sidebar();
			}
			?>

		</div><!-- .content-wrap -->

	<?php zillah_hook_archive_after(); ?>
<?php
get_footer();

