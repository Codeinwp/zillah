<?php
/**
 * zillah functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zillah
 */

if ( ! function_exists( 'zillah_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function zillah_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on zillah, use a find and replace
		 * to change 'zillah' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'zillah', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 1140, 530, true );

		add_image_size ( 'slider-thumbnail', 900, 515, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary', 'zillah' ),
			'social'    => esc_html__( 'Social Links Menu', 'zillah' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
//			'aside',
//			'image',
//			'video',
//			'quote',
//			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'zillah_custom_background_args', array(
			'default-color' => 'f6f6f6',
			'default-image' => '',
		) ) );

		// Add theme support for custom logo
		add_theme_support( 'custom-logo', array(
			'height' => 145,
			'width' => 315,
			'flex-width' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'zillah_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zillah_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zillah_content_width', 810 );
}
add_action( 'after_setup_theme', 'zillah_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zillah_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'zillah' ),
		'id'            => 'zillah-sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'zillah' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebars( 3, array(
		'name'          => esc_html__('Footer Widget Area %d', 'zillah'),
		'id'            => 'zillah-footer-widget-area',
		'class'         => 'col-sm-4',
		'description'   => esc_html__( 'Add widgets here.', 'zillah' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
	) );


	/*
	 * Custom widgets
	 */
	register_widget( 'Zillah_About_Me' );
}
add_action( 'widgets_init', 'zillah_widgets_init' );

/*
 * Custom widgets
 */
require get_template_directory() . "/inc/widgets/about-me.php";

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since InMotion 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function zillah_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Cabin font: on or off', 'zillah' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$lato = _x( 'on', 'Lato font: on or off', 'zillah' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$merriweather = _x( 'on', 'Merriweather font: on or off', 'zillah' );

	if ( 'off' !== $bitter || 'off' !== $lato || 'off' !== $merriweather ) {
		$font_families = array();

		if ( 'off' !== $merriweather )
			$font_families[] = 'Merriweather:400,300';

		if ( 'off' !== $bitter )
			$font_families[] = 'Cabin:400,500,600,700';

		if ( 'off' !== $lato )
			$font_families[] = 'Lato:400,900,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function zillah_scripts() {
	wp_enqueue_style( 'zillah-style', get_stylesheet_uri(), array( 'zillah-boostrap-css' ) );

	wp_enqueue_style ( 'zillah-boostrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'v3.3.6', 'all' );

	wp_enqueue_style( 'zillah-fonts', zillah_fonts_url(), array(), null );

	wp_enqueue_style( 'zillah-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), 'v4.5.0', false );

	wp_enqueue_script( 'zillah-functions-js', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20151216', true );

	wp_localize_script( 'zillah-functions-js', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'zillah' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'zillah' ) . '</span>',
	) );

	wp_enqueue_script( 'zillah-boostrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20130115', true );

	wp_enqueue_script( 'zillah-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'zillah_scripts' );


/**
 * Load customize controls js
 */
function zillah_customizer_script() {
	wp_enqueue_style( 'zillah-font-awesome-admin', get_template_directory_uri() . '/css/font-awesome.min.css', array(), 'v4.5.0', false );
	wp_enqueue_script( 'zillah-customizer-script', get_template_directory_uri() .'/js/zillah-customizer.js', array( 'jquery' ), '1.0.1', true );
	wp_enqueue_style( 'zillah-admin-stylesheet', get_stylesheet_directory_uri().'/css/admin-style.css','1.0.0' );
}
add_action(  'customize_controls_enqueue_scripts', 'zillah_customizer_script'  );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


function zillah_excerpt_more($more) {
	global $post;
	return '<span class="clearfix clearfix-post"></span><a href="'. esc_url( get_permalink($post->ID) ) . '" class="more-link">' . __('Continue Reading ', 'zillah' ) . the_title( '<span class="screen-reader-text">"', '"</span>', false ) . ' <span class="meta-nav">&rarr;</span></a>';
}
add_filter('excerpt_more', 'zillah_excerpt_more');


/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';


/**
 * Adds inline style from customizer
 *
 * @since Zillah 1.0
 */
function zillah_inline_style() {
	$header_image = get_header_image();
	$custom_css = "";
	if(!empty($header_image)){
		$custom_css .= "
	            .header-inner-site-branding {
	                    background-image: url(".esc_url($header_image).");
	            }";
	}
	wp_add_inline_style( 'zillah-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'zillah_inline_style' );


/**
 * Return the site brand
 *
 * @since Zillah 1.0
 */
function zillah_brand(){

	echo '<div class="header-logo-wrap">';

	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo();
		echo '<div class="header-title-wrap zillah-only-customizer">';
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
		echo '</div>';

	} else {
		if( is_customize_preview() ){ ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link zillah-only-customizer" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>">
				<img src="">
			</a>
			<?php
		}
		echo '<div class="header-title-wrap">';
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
		echo '</div>';
	}

	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) : ?>
		<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
		<?php
	endif;

	echo '</div>';
}


/**
 * Display social icons
 *
 * @since Zillah 1.0
 */

function zillah_slider(){

	global $post;

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
					<?php the_post_thumbnail(); ?>
					<div class="carousel-caption">
						<div class="carousel-caption-inner">
							<p class="carousel-caption-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							<p class="carousel-caption-category"><?php echo get_the_category_list( ', ' ); ?></p>
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



	endif;

}


add_action('wp_head','zillah_php_style');
function zillah_php_style() {
	$zillah_palette_picker = get_theme_mod('zillah_palette_picker');
	if(!empty($zillah_palette_picker)){

		$zillah_picker = json_decode($zillah_palette_picker);
		$zillah_c1 = $zillah_picker->color1;
		$zillah_c2 = $zillah_picker->color2;
		$zillah_c3 = $zillah_picker->color3;
		$zillah_c4 = $zillah_picker->color4;
		$zillah_c5 = $zillah_picker->color5;
	}

	if( isset( $zillah_c5 ) ) {
		$rgb = zillah_get_rgb( $zillah_c5 );
	}

	echo '<style id="zillah_customizr_pallete" type="text/css">';
	if(!empty($zillah_palette_picker)){
		/*Color 1*/
		echo '
			.site-title a,
			a {
				color:'.$zillah_c1.';
			}
			.site-title a:hover,
			a:hover {
				color:'.$zillah_c1.';
				opacity: 0.6;
			}
			
			.post-navigation .nav-links a,
			.posts-navigation .nav-previous a{
				background: '.$zillah_c1.';
				opacity: 1;
			}
			
			.post-navigation .nav-links a:hover,
			.posts-navigation .nav-previous a {
				background: '.$zillah_c1.';
				opacity: 0.8;
			}
			
		';
		/*Color 2*/
		echo '
			.entry-title-blog a, 
			.entry-title,
			.widget-title,
			.carousel-caption-title, 
			.carousel-caption-title a,
			.carousel-caption-title a:visited,
			.author-details-title {
				color:'.$zillah_c2.'
			}
			
			.entry-title-blog a:hover,
			 .carousel-caption-title a:hover {
				color:'.$zillah_c2.';
				opacity: 0.8;
			}
			
		';
		/* Color 3 */
		echo '
			body,
			.site-description,
			.carousel-caption-category {
				color: '.$zillah_c3.'
			}
			.entry-header .posted-on a,
			 .carousel-caption-category a,
			 .carousel-caption-category a:visited {
				color: '.$zillah_c3.';
				opacity: 0.75;
			}
			.entry-header .posted-on a:hover,
			.carousel-caption-category a:hover {
				color: '.$zillah_c3.';
				opacity: 1;
			}
		';
		/* Color 4 */
		echo '
			body {
				background:'.$zillah_c4.'
			}
		';
		/* Color 5 */
		echo '
			.header-inner-top,
			.site-info,
			 button, input[type="button"], 
			 input[type="reset"], 
			 input[type="submit"], 
			 .btn,
			 .main-navigation ul ul li {
				background:'.$zillah_c5.';
				opacity: 1;
			 }
			 }
			
			button:hover, input[type="button"]:hover, 
			input[type="reset"]:hover, 
			input[type="submit"]:hover, .btn:hover {
				background:'.$zillah_c5.';
				opacity: 0.8;
			}
			
			.site-footer {
				background: rgba('.$rgb['red'].','.$rgb[green].','.$rgb['blue'].',0.9);
			}
		
		';


		echo '
			.main-navigation li a,
			.site-footer .fa,
			.social-navigation a,
			.dropdown-toggle,
			.site-info a,
			.main-navigation li:hover > a, 
			.main-navigation li.focus > a {
				color: rgba(255,255,255,0.75);
			}
			.main-navigation li a:hover,
			.header-search input[type="search"],
			.header-search label:before,
			.site-footer .fa:hover,
			.social-navigation a:hover,
			.site-info a:hover {
				color: rgba(255,255,255,1);
				opacity: 1;
			}
			
			.site-info {
				color: #FFF;
			}

			header-search ::-webkit-input-placeholder {
				color: #FFF !important;
			}
			
			.header-search :-moz-placeholder {
				color: #FFF !important;
			}
			
			.header-search ::-moz-placeholder {
				color: #FFF !important;
			}
			
			.header-search :-ms-input-placeholder {
				color: #FFF !important;
			}

			.site-footer,
			.site-footer .widget li,
			.site-footer a,
			.site-footer caption {
			    color: rgba(255,255,255,0.75);
			}
			
			.site-footer h3, .site-footer .widget-title {
				color: rgba(255,255,255,1);
			}

			.site-footer a:hover {
			    color: rgba(255,255,255,1);
			    opacity: 1;
			}
			
		';

	}
	echo '</style>';
}

/**
 * Converts a HEX value to RGB.
 */
function zillah_get_rgb( $color ) {

	preg_match_all('!\d+!', $color, $matches);

	return array( 'red' => $matches[0][0], 'green' => $matches[0][1], 'blue' => $matches[0][2] );
}