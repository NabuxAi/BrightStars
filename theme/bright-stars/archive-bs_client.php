<?php
/**
 * Clients / case-studies archive. Reuses the dynamic clients + testimonials
 * sections (which list every published client).
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<h1 class="screen-reader-text"><?php echo esc_html( bs_t( 'nav.clients' ) ); ?></h1>
<?php
bright_stars_section( 'clients' );
bright_stars_section( 'client-work' );
bright_stars_section( 'testimonials' );
bright_stars_cta_band();
get_footer();
