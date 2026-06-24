<?php
/**
 * Template Name: Bright Stars — Services
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<h1 class="screen-reader-text"><?php echo esc_html( bs_t( 'sv.h' ) ); ?></h1>
<?php
while ( have_posts() ) :
	the_post();
	if ( trim( get_the_content() ) ) :
		?>
		<div class="bs-page bs-page--wide"><div class="bs-prose"><?php the_content(); ?></div></div>
		<?php
	endif;
endwhile;

bright_stars_section( 'services' );
bright_stars_section( 'metrics' );
bright_stars_section( 'process' );
bright_stars_cta_band();

get_footer();
