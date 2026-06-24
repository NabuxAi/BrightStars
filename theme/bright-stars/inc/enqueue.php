<?php
/**
 * Front-end & editor assets.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Preconnect to Google Fonts for faster first paint.
 */
function bright_stars_resource_hints( $hints, $relation ) {
	if ( 'preconnect' === $relation ) {
		$hints[] = array(
			'href'        => 'https://fonts.googleapis.com',
		);
		$hints[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'bright_stars_resource_hints', 10, 2 );

/**
 * Google Fonts URL covering Latin, Arabic and Persian families.
 */
function bright_stars_fonts_url() {
	$families = array(
		'Saira+Condensed:wght@600;700;800;900',
		'Space+Grotesk:wght@400;500;600;700',
		'Inter:wght@400;500;600;700',
		'JetBrains+Mono:wght@400;500',
		'Tajawal:wght@400;500;700;800',
		'Vazirmatn:wght@400;500;700;800',
	);
	return 'https://fonts.googleapis.com/css2?family=' . implode( '&family=', $families ) . '&display=swap';
}

/**
 * Enqueue styles and scripts.
 */
function bright_stars_assets() {
	$ver = BRIGHT_STARS_VERSION;

	wp_enqueue_style( 'bright-stars-fonts', bright_stars_fonts_url(), array(), null );
	wp_enqueue_style( 'bright-stars-tokens', bs_asset( 'css/tokens.css' ), array(), $ver );
	wp_enqueue_style( 'bright-stars', bs_asset( 'css/theme.css' ), array( 'bright-stars-tokens' ), $ver );

	// Keep the theme header stylesheet in the queue (no-JS fallback rules).
	wp_enqueue_style( 'bright-stars-base', get_stylesheet_uri(), array( 'bright-stars' ), $ver );

	wp_enqueue_script( 'sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js', array(), '11.14.5', true );

	wp_enqueue_script( 'bright-stars', bs_asset( 'js/theme.js' ), array( 'sweetalert2' ), $ver, true );
	wp_script_add_data( 'bright-stars', 'strategy', 'defer' );

	wp_localize_script(
		'bright-stars',
		'BrightStars',
		array(
			'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
			'nonce'       => wp_create_nonce( 'bright_stars_lead' ),
			'lang'        => bs_lang(),
			'rtl'         => bs_is_rtl_lang() ? 1 : 0,
			'isFrontPage' => is_front_page() ? 1 : 0,
			'i18n'        => array(
				'sending'       => bs_t( 'cta.send' ),
				'error'         => bs_t( 'f.error' ),
				'errorTitle'    => bs_t( 'f.oops' ),
				'required'      => bs_t( 'f.required' ),
				'requiredTitle' => bs_t( 'f.missing' ),
				'thanksH'       => bs_t( 'f.thanksH' ),
				'thanksSub'     => bs_t( 'f.thanksSub' ),
				'ok'            => bs_t( 'ui.ok' ),
			),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bright_stars_assets' );

/**
 * Swap the default "no-js" body for "js" as early as possible.
 */
function bright_stars_js_detect() {
	echo "<script>document.documentElement.className=document.documentElement.className.replace(/\\bbs-no-js\\b/,'bs-js');</script>\n";
}
add_action( 'wp_head', 'bright_stars_js_detect', 0 );
