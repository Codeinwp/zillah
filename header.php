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
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'zillah' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container container-header">
			<div class="header-inner">
				<div class="header-inner-site-branding">
					
					<div class="site-branding-wrap">
						<div class="site-branding">
							<?php zillah_brand(); ?>
						</div><!-- .site-branding -->
					</div>



				</div>
				<div class="main-navigation-wrap">
					<div class="main-navigation-wrap-inner">
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						</nav><!-- #site-navigation -->


						<div class="menu-toggle-button-wrap">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i></button>
						</div>

						
						<div class="header-social-icons">
							<ul class="social-media-icons">
								<?php
								zillah_social_icons();
								zillah_search_icon(); ?>
							</ul>
						</div>

					</div>
				</div>
			</div>
		</div><!-- .container-header -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container">