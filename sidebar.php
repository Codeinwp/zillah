<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zillah
 */

$zillah_sidebar_show = get_theme_mod( 'zillah_sidebar_show', false );

if ( ! is_active_sidebar( 'zillah-sidebar-1' ) ) {
	return;
}
?>

<?php zillah_hook_sidebar_before(); ?>
<aside id="secondary" class="widget-area<?php echo $zillah_sidebar_show === false && is_customize_preview() ? " zillah-only-customizer" : ""; ?>" role="complementary">
	<?php zillah_hook_sidebar_top(); ?>
	<?php dynamic_sidebar( 'zillah-sidebar-1' ); ?>
	<?php zillah_hook_sidebar_bottom(); ?>
</aside><!-- #secondary -->
<?php zillah_hook_sidebar_after(); ?>