<?php
/**
 * Theme setup: supports, menus, image sizes, language attributes.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme features.
 */
function bright_stars_setup() {
	load_theme_textdomain( 'bright-stars', BRIGHT_STARS_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary'         => __( 'Primary navigation', 'bright-stars' ),
			'footer_services' => __( 'Footer — Services', 'bright-stars' ),
			'footer_agency'   => __( 'Footer — Agency', 'bright-stars' ),
		)
	);

	// 16:10 card crop used for blog/client thumbnails.
	add_image_size( 'bs-card', 720, 450, true );
	add_image_size( 'bs-wide', 1280, 720, true );

	// Editor niceties.
	add_theme_support( 'align-wide' );
	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'bright_stars_setup' );

/**
 * Content width.
 */
function bright_stars_content_width() {
	$GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', 'bright_stars_content_width', 0 );

/**
 * Swap the <html> lang/dir to match the active site language.
 *
 * @param string $output Existing attributes.
 * @return string
 */
function bright_stars_language_attributes( $output ) {
	$lang   = bs_lang();
	$dir    = bs_is_rtl_lang() ? 'rtl' : 'ltr';
	$locale = array(
		'en' => 'en-US',
		'ar' => 'ar',
		'fa' => 'fa-IR',
	);
	$code = isset( $locale[ $lang ] ) ? $locale[ $lang ] : 'en-US';
	return 'lang="' . esc_attr( $code ) . '" dir="' . esc_attr( $dir ) . '"';
}
add_filter( 'language_attributes', 'bright_stars_language_attributes' );

/**
 * Useful body classes for styling hooks.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function bright_stars_body_class( $classes ) {
	$classes[] = 'bs-lang-' . bs_lang();
	$classes[] = 'bs-theme-' . bs_theme_variant();
	if ( bs_is_rtl_lang() ) {
		$classes[] = 'bs-rtl';
	}
	return $classes;
}
add_filter( 'body_class', 'bright_stars_body_class' );

/**
 * Register a sidebar for the blog (optional, keeps widgets available).
 */
function bright_stars_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog sidebar', 'bright-stars' ),
			'id'            => 'blog-sidebar',
			'description'   => __( 'Shown beside blog archives and single posts.', 'bright-stars' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'bright_stars_widgets_init' );

/**
 * Make sure custom post types are included in the core sitemap (SEO).
 */
function bright_stars_sitemap_post_types( $post_types ) {
	foreach ( array( 'bs_client' ) as $pt ) {
		if ( post_type_exists( $pt ) ) {
			$post_types[ $pt ] = get_post_type_object( $pt );
		}
	}
	return $post_types;
}
add_filter( 'wp_sitemaps_post_types', 'bright_stars_sitemap_post_types' );
