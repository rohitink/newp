<?php
/**
 * newp functions and definitions
 *
 * @package newp
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'newp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function newp_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on newp, use a find and replace
	 * to change 'newp' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'newp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 *
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'newp' ),
		'bottom' => __( 'Bottom Menu', 'newp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		 'image', 'video'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'newp_custom_background_args', array(
		'default-color' => '2f2f2f',
		'default-image' => '',
	) ) );
	
	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width'  => true,
	) );
	
	add_image_size('newp-pop-thumb',542, 343, true );
	
	//RT Slider Support
	add_theme_support( 'rt-slider' );
	
	//WooCommerce Support
	add_theme_support('woocommerce');
	

	
}
endif; // newp_setup
add_action( 'after_setup_theme', 'newp_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function newp_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'newp' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'newp' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'newp' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'newp' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'newp' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'newp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function newp_scripts() {
	wp_enqueue_style( 'newp-style', get_stylesheet_uri() );
	
	wp_enqueue_style('newp-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('newp_title_font', ' Montserrat')) ).':100,300,400,700' );
	
	wp_enqueue_style('newp-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('newp_body_font', 'Source Sans Pro')) ).':100,300,400,700' );
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri() . '/assets/css/nivo-slider.css' );
	
	wp_enqueue_style( 'nivo-slider-skin', get_template_directory_uri() . '/assets/css/nivo-dark/dark.css' );
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	
	wp_enqueue_style( 'flex-image', get_template_directory_uri() . '/assets/css/jquery.flex-images.css' );

	wp_enqueue_style( 'hover', get_template_directory_uri() . '/assets/css/hover.min.css' );
		
	wp_enqueue_style( 'newp-main-theme-style', get_template_directory_uri() . '/assets/css/'.get_theme_mod('newp_skin', 'default').'.css' );

	wp_enqueue_script( 'newp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'newp-externaljs', get_template_directory_uri() . '/js/external.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'newp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'newp-custom-js', get_template_directory_uri() . '/js/custom.js' );
	
	// Localize the script with new data
	$translation_array = array(
		'menu_text' => __( 'Menu', 'newp' ),
	);
	wp_localize_script( 'newp-externaljs', 'menu_obj', $translation_array );

}
add_action( 'wp_enqueue_scripts', 'newp_scripts' );

/**
* Enqueue Scripts for Admin
*/
if ( is_customize_preview() ) { 
	function newp_custom_wp_admin_style() {
	        wp_enqueue_style( 'newp-admin_css', get_template_directory_uri() . '/assets/css/admin.css' );
	}
	add_action( 'admin_enqueue_scripts', 'newp_custom_wp_admin_style' );
}

/*
** Function for Backwards Compatibility of Custom Logo. Remove on WP 4.7
*/
//Backwards Compatibility FUnction
function newp_logo() {	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

function newp_has_logo() {
	if (function_exists( 'has_custom_logo')) {
		if ( has_custom_logo() ) {
			return true;
		}
	} else {
		return false;
	}
}




//Function to Trim Excerpt Length & more..
function newp_excerpt_length( $length ) {
	return 23;
}
add_filter( 'excerpt_length', 'newp_excerpt_length', 999 );

function newp_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'newp_excerpt_more' );

/**
 * Include the Custom Functions of the Theme.
 */
require get_template_directory() . '/framework/theme-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom CSS Mods.
 */
require get_template_directory() . '/inc/css-mods.php';


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

/**
 * Recommened Slider plugins
 */
require get_template_directory() . '/framework/tgmpa.php';
