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

		<div class="header-inner-top">
			<div class="container container-header">
				<div class="header-inner">

					<div class="main-navigation-wrap">
						<div class="main-navigation-wrap-inner">

							<div class="header-social-icons">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'social',
										'menu_id' => 'social-icons-menu',
										'menu_class' => 'social-navigation',
										'link_before' => '<span class="screen-reader-text">',
										'link_after' => '</span>',
										'fallback_cb' => false
									)
								);
								?>
							</div>

							<nav id="site-navigation" class="main-navigation" role="navigation">
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'primary',
											'menu_id' => 'primary-menu'
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

		<div class="header-inner-site-branding">
			<div class="container container-header-logo">
						<div class="site-branding-wrap">
					<div class="site-branding">
						<?php zillah_brand(); ?>
					</div><!-- .site-branding -->
				</div>
			</div><!-- .container-header-logo -->
		</div>

	</header><!-- #masthead -->


	<?php

	if ( ! is_paged() && is_front_page() ): ?>

		<div id="home-carousel" class="carousel slide home-carousel" data-ride="carousel">

			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#home-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#home-carousel" data-slide-to="1"></li>
				<li data-target="#home-carousel" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">

				<div class="item active">
					<div class="item-inner-half">
						<img src="<?php echo get_bloginfo( "template_directory" ); ?>/images/uuu1.jpg" alt="">
						<div class="carousel-caption">
							<div class="carousel-caption-inner">
								<p class="carousel-caption-title">Building tour branding is simple</p>
								<p class="carousel-caption-category">business, lifestyle</p>
							</div>
						</div>
					</div>
					<div class="item-inner-half">
						<img src="<?php echo get_bloginfo( "template_directory" ); ?>/images/uuu2.jpg" alt="">
						<div class="carousel-caption">
							<div class="carousel-caption-inner">
								<p class="carousel-caption-title">Building tour branding is simple</p>
								<p class="carousel-caption-category">business, lifestyle</p>
							</div>
						</div>
					</div>
				</div>

				<div class="item">
					<div class="item-inner-half">
						<img src="<?php echo get_bloginfo( "template_directory" ); ?>/images/uuu2.jpg" alt="">
						<div class="carousel-caption">
							<div class="carousel-caption-inner">
								<p class="carousel-caption-title">Building tour branding is simple</p>
								<p class="carousel-caption-category">business, lifestyle</p>
							</div>
						</div>
					</div>
					<div class="item-inner-half">
						<img src="<?php echo get_bloginfo( "template_directory" ); ?>/images/uuu1.jpg" alt="">
						<div class="carousel-caption">
							<div class="carousel-caption-inner">
								<p class="carousel-caption-title">Building tour branding is simple</p>
								<p class="carousel-caption-category">business, lifestyle</p>
							</div>
						</div>
					</div>
				</div>

				<div class="item">
					<div class="item-inner-half">
						<img src="<?php echo get_bloginfo( "template_directory" ); ?>/images/uuu2.jpg" alt="">
						<div class="carousel-caption">
							<div class="carousel-caption">
								<div class="carousel-caption-inner">
									<p class="carousel-caption-title">Building tour branding is simple</p>
									<p class="carousel-caption-category">business, lifestyle</p>
								</div>
							</div>
						</div>
					</div>
					<div class="item-inner-half">
						<img src="<?php echo get_bloginfo( "template_directory" ); ?>/images/uuu1.jpg" alt="">
						<div class="carousel-caption">
							<div class="carousel-caption">
								<div class="carousel-caption-inner">
									<p class="carousel-caption-title">Building tour branding is simple</p>
									<p class="carousel-caption-category">business, lifestyle</p>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	<?php endif; ?>

	<div id="content" class="site-content">
		<div class="container">