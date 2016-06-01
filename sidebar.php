<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zillah
 */

global $wp_customize;
$zillah_sidebar_show = get_theme_mod( 'zillah_sidebar_show', false );

if ( ! is_active_sidebar( 'zillah-sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area<?php echo $zillah_sidebar_show === false && is_customize_preview() ? " zillah-only-customizer" : ""; ?>" role="complementary">
	<?php dynamic_sidebar( 'zillah-sidebar-1' ); ?>
</aside><!-- #secondary -->