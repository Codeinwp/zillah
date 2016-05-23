<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zillah
 */

get_header(); ?>

	<div class="content-wrap">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single' );

				?>

				<div class="author-details-wrap">
					<div class="content-inner-wrap">
						<div class="author-details-img-wrap">
							<img alt="" src="http://0.gravatar.com/avatar/f72c502e0d657f363b5f2dc79dd8ceea?s=105&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/f72c502e0d657f363b5f2dc79dd8ceea?s=210&amp;d=mm&amp;r=g 2x" class="avatar avatar-105 photo" height="105" width="105">
						</div>
						<div class="author-details-title">Ash Schweitzer</div>
						<div class="author-details-content">When I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence of all of the breathing.</div>
					</div>
				</div>

				<?php

				the_post_navigation();

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