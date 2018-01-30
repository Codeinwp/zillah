<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

$zillah_sidebar_show       = get_theme_mod( 'zillah_sidebar_show', false );
$zillah_alternative_layout = get_theme_mod( 'zillah_alt_layout', false );

get_header(); ?>
	<?php zillah_hook_index_before(); ?>

	<div class="content-wrap">

		<div id="primary" class="content-area content-area-arch<?php echo $zillah_sidebar_show !== false ? ' content-area-with-sidebar' : ''; ?>">
			<main id="main" class="site-main" role="main">
				<?php zillah_hook_index_top(); ?>

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
				?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>

				<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */

					$alternative = $zillah_alternative_layout == false ? $zillah_alternative_layout : '-alternative';
					get_template_part( 'template-parts/content' . $alternative, get_post_format() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

				<?php zillah_hook_index_bottom(); ?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		if ( $zillah_sidebar_show !== false || ( $zillah_sidebar_show === false && is_customize_preview() ) ) {
			get_sidebar();
		}
		?>

	</div><!-- .content-wrap -->
	<?php zillah_hook_index_after(); ?>

<?php
get_footer();
