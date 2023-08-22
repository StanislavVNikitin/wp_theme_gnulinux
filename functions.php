<?php
/**
 * Gnulinux functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gnulinux
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gnulinux_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Gnulinux, use a find and replace
		* to change 'gnulinux' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'gnulinux', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header_menu' => esc_html__( 'Header Menu', 'gnulinux' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'gnulinux_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'gnulinux_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gnulinux_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gnulinux_content_width', 640 );
}
add_action( 'after_setup_theme', 'gnulinux_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gnulinux_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'gnulinux' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'gnulinux' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title font-weight-bold spanborder"><span>',
			'after_title'   => '</span></h5>',
		)
	);
}
add_action( 'widgets_init', 'gnulinux_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gnulinux_scripts() {

	wp_enqueue_style('gnulinux-google-fonts','https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Source+Sans+Pro:400,600,700');
	//wp_enqueue_style('gnulinux-fontawesoms','https://use.fontawesome.com/releases/v5.3.1/css/all.css');
	wp_enqueue_style('gnulinux-main', get_template_directory_uri() . '/assets/css/main.css');

	wp_deregister_script('jquery');
	wp_register_script('jquery','https://code.jquery.com/jquery-3.4.1.min.js', array(),false,['in_footer' => true]);
	wp_enqueue_script('jquery');
	//wp_enqueue_script('gnulinux-jquery', get_template_directory_uri(). '/assets/js/vendor/jquery.min.js',array(),false,['in_footer' => true]);
	wp_enqueue_script('gnulinux-popper', get_template_directory_uri(). '/assets/js/vendor/popper.min.js',array(),false,['in_footer' => true]);
	wp_enqueue_script('gnulinux-bootstrap-js', get_template_directory_uri(). '/assets/js/vendor/bootstrap.min.js',array(),false,['in_footer' => true]);
	wp_enqueue_script('gnulinux-fontawesome','https://kit.fontawesome.com/48bb9ed920.js',array(),false,['in_footer' => true]);
	wp_enqueue_script('gnulinux-function-js', get_template_directory_uri(). '/assets/js/functions.js',array(),false,['in_footer' => true]);

}
add_action( 'wp_enqueue_scripts', 'gnulinux_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function gnulinux_debug( $data ) {
	echo '<pre>' . print_r($data, 1) . '</pre>';
}

/**
 * Menu Walker
 */
require get_template_directory() . '/inc/Gnulinux_Menu.php';

/**
 * Admin fanction
 */

require get_template_directory() . '/inc/admin-function.php';

/**
 * Metaboxes
 */

require get_template_directory() . '/inc/gnulinux-metabox.php';

function gnulinux_post_meta($post_id){
	$date = get_the_date('M j');
	$read_minutes = get_post_meta($post_id, 'read_minutes',true);
	$out = '<small class="text-muted">';
	$out .= $date;
	if ($read_minutes){
		$out .= ' &middot; ' . $read_minutes . __(' min read','gnulinux');
	}
	$out .= '</small>';
	return $out;
}

function gnulinux_post_time_diff() {
	return human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) . __( ' ago', 'gnulinux' );
}

function gnulinux_read_post($post_id){
	$read_minutes = get_post_meta($post_id, 'read_minutes',true);
	if ($read_minutes){
		return ' &middot; ' . $read_minutes . __(' min read','gnulinux');
	}
	return '';
}

function gnulinux_get_avatar() {
	$image_id = get_option('author_avatar');
	if ($image = wp_get_attachment_image_src( $image_id )){
		return '<img class="rounded-circle" src="' . $image[0] . '" width="70">';
	} else{
		return get_avatar(get_the_author_meta('user_email'), 70, '', '', array('class' => 'rounded-circle'));
	}


}