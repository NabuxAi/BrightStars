<?php
/**
 * Bright Stars theme bootstrap.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRIGHT_STARS_VERSION', '1.2.0' );
define( 'BRIGHT_STARS_DIR', get_template_directory() );
define( 'BRIGHT_STARS_URI', get_template_directory_uri() );

/**
 * Load theme modules. Order matters: the dictionary and helpers are needed
 * everywhere else, so they come first.
 */
$bright_stars_modules = array(
	'/inc/i18n.php',          // Trilingual string dictionary (en/ar/fa).
	'/inc/helpers.php',       // bs_lang(), bs_opt(), bs_t(), bs_field(), bs_icon()…
	'/inc/setup.php',         // Theme supports, menus, image sizes.
	'/inc/enqueue.php',       // Styles, scripts, Google fonts.
	'/inc/cpt.php',           // Custom post types (clients, services, pricing…).
	'/inc/seo.php',           // <title>, meta, Open Graph, JSON-LD, hreflang.
	'/inc/template-tags.php', // Reusable markup helpers for templates.
	'/inc/admin/options.php', // Settings schema + storage.
	'/inc/admin/admin-panel.php', // The "Bright Stars" admin panel.
	'/inc/admin/seed.php',    // One-click demo content + page builder.
);

foreach ( $bright_stars_modules as $bright_stars_module ) {
	$bright_stars_path = BRIGHT_STARS_DIR . $bright_stars_module;
	if ( file_exists( $bright_stars_path ) ) {
		require_once $bright_stars_path;
	}
}
