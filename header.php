<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zillah
 */

?><!DOCTYPE html>
<?php zillah_hook_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
	<?php zillah_hook_head_top(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php zillah_hook_head_bottom(); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php zillah_hook_body_top(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'zillah' ); ?></a>
	<?php zillah_hook_header_before(); ?>
	<header id="masthead" class="site-header" role="banner">

		<div class="header-inner-top">
			<div class="container container-header">
				<div class="header-inner">

					<div class="main-navigation-wrap">

						<div class="main-navigation-wrap-inner
						<?php
						echo wp_nav_menu(
							array(
								'theme_location' => 'social',
								'fallback_cb'    => false,
								'echo'           => false,
							)
						) !== false ? '' : ' no-social-menu';
						?>
						">

							<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'social',
										'menu_id'         => 'social-icons-menu',
										'menu_class'      => 'social-navigation',
										'link_before'     => '<span class="screen-reader-text">',
										'link_after'      => '</span>',
										'container_class' => 'header-social-icons',
										'fallback_cb'     => false,
									)
								);
							?>

							<nav id="site-navigation" class="main-navigation" role="navigation">
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'primary',
											'menu_id' => 'primary-menu',
										)
									);
								?>
							</nav><!-- #site-navigation -->

							<div class="menu-toggle-button-wrap">
								<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i></button>
							</div>

							<div class="header-search">
								<?php get_search_form(); ?>
							</div>

						</div>
					</div>
				</div><!-- .container-header -->
			</div>
		</div>

		<div class="header-inner-site-branding<?php echo ! is_home() || ! is_front_page() ? ' header-logo-wrap-single' : ''; ?>">
			<div class="container container-header-logo">
				<?php zillah_hook_header_top(); ?>
				<div class="site-branding-wrap">
					<div class="site-branding">
						<?php zillah_brand(); ?>
					</div><!-- .site-branding -->
				</div>
				<?php zillah_hook_header_bottom(); ?>
			</div><!-- .container-header-logo -->
		</div>

	</header><!-- #masthead -->
	<?php zillah_hook_header_after(); ?>

	<?php zillah_slider(); ?>

	<?php zillah_hook_content_before(); ?>
	<div id="content" class="site-content">
		<div class="container">
			<?php zillah_hook_content_top(); ?>
