<?php
/**
 * 404 — not found.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<section class="bs-section bs-pad bs-center" style="max-width:760px;margin:0 auto;padding-top:120px;padding-bottom:120px">
	<div data-reveal>
		<div style="font-family:var(--font-hero);font-weight:800;font-size:120px;line-height:1;color:var(--bs-accent)">404</div>
		<h1 class="bs-h2" style="margin-top:8px"><?php esc_html_e( 'Page not found', 'bright-stars' ); ?></h1>
		<p class="bs-sub" style="max-width:480px;margin:14px auto 28px"><?php esc_html_e( 'The page you are looking for may have moved. Let’s get you back on track.', 'bright-stars' ); ?></p>
		<a class="bs-btn bs-btn--primary bs-btn--lg" href="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin:0 auto">
			<span><?php echo esc_html( bs_t( 'nav.home' ) ); ?></span>
			<?php echo bs_icon( 'arrow-right', array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</div>
</section>
<?php
get_footer();
