<?php
/**
 * Folia functions and definitions
 *
 * @package Folia
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'folia_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function folia_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Folia, use a find and replace
	 * to change 'folia' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'folia', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Image sizes
	add_image_size( 'thumbnail-small', 75, 75, true );
	add_image_size( 'feature-single', 748, 350, true );
	add_image_size( 'feature-box', 350, 263, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'folia' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'folia_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // folia_setup
add_action( 'after_setup_theme', 'folia_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function folia_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'folia' ),
		'id'            => 'sidebar-main',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'folia_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function folia_scripts() {

	// Normalize.css
    wp_register_style( 'folia-normalize', get_template_directory_uri() . '/css/normalize.css', array(), '2.1.3' );
    wp_enqueue_style( 'folia-normalize' );

    // Main style
	wp_enqueue_style( 'folia-style', get_stylesheet_uri() );

	// FitVids
	wp_enqueue_script('folia-fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', array( 'jquery' ), '1.0.3', true );

	wp_enqueue_script( 'folia-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'folia-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Loads JavaScript file with functionality specific to the theme
    wp_enqueue_script( 'folia-scripts', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'folia_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Post Type Bloco
 */
require get_stylesheet_directory() . '/inc/post-type-bloco.php';

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
