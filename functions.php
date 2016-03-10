<?php
/**
 * DevriX Starter functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Micro
 */


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


if ( ! function_exists( 'micro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function micro_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on DevriX Starter, use a find and replace
	 * to change 'micro' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'micro', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'micro' ),
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
	add_theme_support( 'custom-background', apply_filters( 'micro_custom_background_args', array(
		'default-color' => '000000',
		'default-image' => '',
	) ) );

	add_theme_support( 'custom-header', array(
		'width' => 1920,
		'flex-width'    => true
	) );
}
endif;
add_action( 'after_setup_theme', 'micro_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function micro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'micro_content_width', 640 );
}
add_action( 'after_setup_theme', 'micro_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function micro_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'micro' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'micro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function micro_scripts() {
	wp_enqueue_style( 'micro-style', get_template_directory_uri() . '/assets/css/master.css' );
	wp_enqueue_style( 'primary-font', 'https://fonts.googleapis.com/css?family=Roboto+Mono:400,500&subset=latin,cyrillic,greek,vietnamese' );
	

	wp_enqueue_script( 'micro-navigation', get_template_directory_uri() . '/assets/scripts/scripts.min.js', array( "jquery" ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'micro_scripts' );

/**
 * Remove the margin-top styling added to the HTML tag by default from WordPress
 */
function micro_remove_html_margin() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'get_header', 'micro_remove_html_margin' );

function micro_add_editor_style() {
	add_editor_style( 'assets/css/editor-style.css' );
}
add_action( "admin_init", "micro_add_editor_style" );