<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zillah
 */

?>

		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php if ( is_active_sidebar( 'zillah-footer-widget-area-3' ) || is_active_sidebar( 'zillah-footer-widget-area' ) || is_active_sidebar( 'zillah-footer-widget-area-2' ) ) : ?>

			<div class="container container-footer">

				<div class="footer-inner">
					<div class="row">
						<div class="col-sm-4">
							<?php
							if ( is_active_sidebar( 'zillah-footer-widget-area' ) ) {
								dynamic_sidebar( 'zillah-footer-widget-area' );
							}?>
						</div>

						<div class="col-sm-4">
							<?php
							if ( is_active_sidebar( 'zillah-footer-widget-area-2' ) ) {
								dynamic_sidebar( 'zillah-footer-widget-area-2' );
							} ?>
						</div>

						<div class="col-sm-4">
							<?php
							if ( is_active_sidebar( 'zillah-footer-widget-area-3' ) ) {
								dynamic_sidebar( 'zillah-footer-widget-area-3' );
							} ?>
						</div>
					</div>
				</div>
			</div> <!-- .container-footer -->

		<?php endif; ?>

		<div class="site-info">
			<div class="container container-footer-info"">

				<div class="footer-copyright">
					<?php printf(
						__( 'Proudly powered by %1$s', 'zillah' ),
						sprintf( '<a href="http://wordpress.org/" rel="nofollow">%s</a>', esc_html__( 'WordPress', 'zillah' ) )
					); ?>
					<span class="sep"> | </span>
					<?php printf(
						__( 'Theme Zillah by %1$s', 'zillah' ),
						sprintf( '<a href="http://themeisle.com/" rel="nofollow">%s</a>', esc_html__( 'Themeisle', 'zillah' ) )
					); ?>
				</div>
				<div class="footer-back-top"">
					<a href="#" id="to-top" class="to-top"><?php _e( 'Back to top','zillah' ); ?> <i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
				</div>
			</div>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
