<?php
/**
 * Full-screen mobile menu.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="bs-mobile" id="bs-mobile" data-mobile hidden>
	<div class="bs-mobile__top">
		<span class="bs-brand__name"><?php echo esc_html( bs_brand_name() ); ?></span>
		<button class="bs-icon-btn" data-mobile-close aria-label="<?php echo esc_attr( bs_t( 'ui.close' ) ); ?>">
			<?php echo bs_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</button>
	</div>

	<nav class="bs-mobile__nav" aria-label="<?php esc_attr_e( 'Mobile', 'bright-stars' ); ?>">
		<?php foreach ( bright_stars_nav_items() as $item ) : ?>
			<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
		<?php endforeach; ?>
	</nav>

	<a class="bs-btn bs-btn--primary bs-btn--lg" style="margin-top:auto" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>" data-keep>
		<?php echo esc_html( bs_t( 'nav.start' ) ); ?>
	</a>
</div>
