<?php
/**
 * Front page (Home).
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

bright_stars_section( 'hero' );
bright_stars_section( 'process-path' );
bright_stars_section( 'services' );
bright_stars_section( 'blog-teaser' );
bright_stars_cta_band();

get_footer();
