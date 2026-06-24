<?php
/**
 * Template Name: Bright Stars — Contact
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<h1 class="screen-reader-text"><?php echo esc_html( bs_t( 'nav.contact' ) ); ?></h1>
<?php
while ( have_posts() ) :
	the_post();
	if ( trim( get_the_content() ) ) :
		?>
		<div class="bs-page bs-page--wide" style="padding-bottom:0"><div class="bs-prose"><?php the_content(); ?></div></div>
		<?php
	endif;
endwhile;

bright_stars_section( 'cta' );
bright_stars_section( 'map' );

get_footer();
