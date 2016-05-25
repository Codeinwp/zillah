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

	$zillah_home_slider_show  = get_theme_mod( 'zillah_home_slider_show', false );

	if ( ! is_paged() && is_front_page() && ( $zillah_home_slider_show === true || $zillah_home_slider_show === false && is_customize_preview() ) ):

		$zillah_home_slider_category = get_theme_mod( 'zillah_home_slider_category', 0 );

		$args = array(
			'posts_per_page'   => 6,
			'post_type'        => 'post',
			'category'         =>  $zillah_home_slider_category !== 0 ? $zillah_home_slider_category : '',
			'meta_query' => array(
				array('key' => '_thumbnail_id')
			)
		);

		$slider_posts = get_posts( $args );

		$size = round( sizeof( $slider_posts ) / 2, 0, PHP_ROUND_HALF_UP);

		echo "<div id=\"home-carousel\" class=\"carousel slide home-carousel" . ( $zillah_home_slider_show === false && is_customize_preview() ? " zillah-only-customizer" : "" ) . "\" data-ride=\"carousel\">";

		if( $size ) :

			echo "<ol class=\"carousel-indicators\">";
				for( $i=0; $i<$size; $i++ ){
					echo "<li data-target=\"#home-carousel\" data-slide-to=\"". $i . "\"" . ( $i===0 ? " class=\"active\"" : "" ) . "></li>";
				}
			echo "</ol>";

			echo "<div class=\"carousel-inner\" role=\"listbox\">";

				$index = 0;
				foreach ( $slider_posts as $post ) : setup_postdata( $slider_posts );

					$index++;
					?>

					<?php if( $index%2 === 1 ): ?>
						<div class="item<?php echo $index===1 ? " active" : "" ?>">
					<?php endif; ?>

						<div class="item-inner-half">
							<a href="<?php the_permalink(); ?>"" class="item-inner-link"></a>
							<?php the_post_thumbnail( 'slider-thumbnail' ); ?>
							<div class="carousel-caption">
								<div class="carousel-caption-inner">
									<p class="carousel-caption-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
									<p class="carousel-caption-category"><?php echo get_the_category_list( ',' ); ?></p>
								</div>
							</div>
						</div>

					<?php if( $index%2 === 0 ): ?>
						</div>
					<?php endif; ?>

					<?php
				endforeach;

				if( $index%2 !== 0 ):
					echo "</div>";
				endif;

			echo "</div>";

		endif;

		wp_reset_postdata();

		echo "</div>";

		?>

	<?php endif; ?>

	<div id="content" class="site-content">
		<div class="container">