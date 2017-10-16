<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package zillah
 */

get_header(); ?>


	</div><!-- .container -->
	<?php zillah_hook_search_before(); ?>

	<header class="page-main-header page-header-search">
		<div class="container">
			<h1 class="entry-title page-title">
			<?php
			/* translators: s: search term */
			printf( esc_html__( 'Search Results for: %s', 'zillah' ), '<span>' . get_search_query() . '</span>' );
			?>
			</h1>
		</div>
	</header><!-- .page-header -->

	<div class="container">

		<div class="content-wrap">

			<div id="primary" class="content-area content-area-arch search-page">
				<main id="main" class="site-main" role="main">
					<?php zillah_hook_search_top(); ?>
				<?php
				if ( have_posts() ) :
				?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

					<?php zillah_hook_search_bottom(); ?>
				</main><!-- #main -->
			</section><!-- #primary -->

		</div><!-- .content-wrap -->
	<?php zillah_hook_search_after(); ?>

<?php
get_footer();

