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
		<div class="container container-footer">

			<div class="footer-inner">
				<div class="row">
					<div class="col-sm-4">
						<?php 
						if ( is_active_sidebar( 'footer-widget-area' ) ) {
							dynamic_sidebar( 'footer-widget-area' );
						}?>
					</div>
					
					<div class="col-sm-4">
						<?php
						if ( is_active_sidebar( 'footer-widget-area-2' ) ) {
							dynamic_sidebar( 'footer-widget-area-2' );
						} ?>
					</div>

					<div class="col-sm-4">
						<?php
						if ( is_active_sidebar( 'footer-widget-area-3' ) ) {
							dynamic_sidebar( 'footer-widget-area-3' );
						} ?>
					</div>
				</div>
			</div>

			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'zillah' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'zillah' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'zillah' ), 'zillah', '<a href="//themeisle.com/" target="_blank" rel="designer">Themeisle</a>' ); ?>
			</div><!-- .site-info -->



		</div><!-- .container-footer -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
