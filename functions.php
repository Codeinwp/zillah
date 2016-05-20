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

	add_image_size ( 'post-thumbnail', 770, 500, true );

	add_image_size ( 'post-thumbnail-blog', 770, 350, true );

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
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'zillah_custom_background_args', array(
		'default-color' => 'f6f6f6',
		'default-image' => '',
	) ) );

	// Add theme support for custom logo
	add_theme_support( 'custom-logo', array(
	   'height'      => 175,
	   'width'       => 378,
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
	$GLOBALS['content_width'] = apply_filters( 'zillah_content_width', 640 );
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

}
add_action( 'widgets_init', 'zillah_widgets_init' );


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
			$font_families[] = 'Merriweather:400';

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
	wp_register_script( 'zillah-ddslick', get_template_directory_uri() .'/js/jquery.ddslick.js', array("jquery"), '1.0.0');
	wp_enqueue_script( 'zillah-customizer-script', get_template_directory_uri() .'/js/zillah_customizer.js', array( 'jquery', 'jquery-ui-draggable','zillah-ddslick' ), '1.0.1', true );
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
	return '<span class="clearfix"></span><a href="'. esc_url( get_permalink($post->ID) ) . '" class="more-link">' . __('Read more ', 'zillah' ) . the_title( '<span class="screen-reader-text">"', '"</span>', false ) . ' <span class="meta-nav">&rarr;</span></a>';
}
add_filter('excerpt_more', 'zillah_excerpt_more');


/**
 * Adds inline style from customizer
 *
 * @since Zillah 1.0
 */
function zillah_inline_style() {
	$zillah_page_header = get_theme_mod('zillah_page_header', get_stylesheet_directory_uri().'/images/header-top.jpg');
    $custom_css = " .page-main-header{
                		background-image: url(".$zillah_page_header.");
                	}";
    
    wp_add_inline_style( 'zillah-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'zillah_inline_style' );



/**
 * Return the site brand 
 *
 * @since Zillah 1.0
 */
function zillah_brand(){
	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo(); ?>
		<div class="header-logo-wrap zillah-only-customizer">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div>
	<?php
	} else {
		if( is_customize_preview() ){ ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link zillah-only-customizer" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>">
				<img src="">
			</a>
		<?php
		} ?>

		<div class="header-logo-wrap">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div>
	<?php		
	}
}


/**
 * Display the search icon
 *
 * @since Zillah 1.0
 */
/**
function zillah_search_icon(){ 
	$zillah_show_search = get_theme_mod('zillah_show_search'); ?>
	<li <?php echo ( ( !isset( $zillah_show_search ) || $zillah_show_search == 1 ) && is_customize_preview() ? 'class="zillah-only-customizer"' : '' ) ?>>
		<?php 
		if( ( isset($zillah_show_search) && $zillah_show_search != 1 ) || is_customize_preview() ){ ?>
			<button type="button" class="search-opt search-toggle">
				<i class="fa fa-search"></i>
			</button>
			<div class="header-search">
				<div class="container container-header-search">
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php
		} ?>
	</li>
<?php
}
**/

/**
 * Display social icons
 *
 * @since Zillah 1.0
 */
/**
function zillah_social_icons(){
	$zillah_social_icons = get_theme_mod( 'zillah_social_icons', json_encode( array(
		array('icon_value'	=>	'fa-facebook-official' , 'link' => '#', 'id' => 'zillah_5702771a213bb'),
		array('icon_value'	=>	'fa-google' , 'link' => '#', 'id' => 'zillah_57027720213bc'),
		array('icon_value'	=>	'fa-instagram' , 'link' => '#', 'id' => 'zillah_57027722213bd')
	) ) );
	if( !empty($zillah_social_icons) ){
		$zillah_social_icons_decoded = json_decode($zillah_social_icons, true);
		foreach ( $zillah_social_icons_decoded as $social_icon ) { 
			if( !empty( $social_icon['link'] ) ){?>
				<li>
					<a target="_blank" href="<?php echo esc_url( $social_icon['link'] ); ?>">
						<i class="fa <?php echo esc_html( $social_icon['icon_value'] ); ?>"></i>
					</a>
				</li>
		<?php
			} 
		}
	} 
}
 **/