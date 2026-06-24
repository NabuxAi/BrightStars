<?php
/**
 * Studio location + embedded map.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$embed = bs_opt( 'map_embed', 'https://www.google.com/maps?q=Muscat%2C%20Oman&z=12&output=embed' );
$link  = bs_opt( 'map_link', 'https://maps.app.goo.gl/m8YDcuF6oo77eLp47' );
?>
<section class="bs-section bs-pad" id="map" style="max-width:var(--maxw);margin:0 auto;padding-top:24px;padding-bottom:88px">
	<div class="bs-map" data-reveal>
		<div class="bs-map__info">
			<?php bright_stars_eyebrow( bs_t( 'mp.eyebrow' ) ); ?>
			<h2 class="bs-map__h"><?php echo esc_html( bs_field( 'mp_h', 'mp.h' ) ); ?></h2>
			<p class="bs-map__addr"><?php echo esc_html( bs_field( 'contact_address', 'mp.addr' ) ); ?></p>
			<a class="bs-btn bs-btn--primary" style="align-self:flex-start;height:50px" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener">
				<?php echo bs_icon( 'pin', array( 'size' => 17 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( bs_t( 'mp.cta' ) ); ?></span>
			</a>
		</div>
		<div class="bs-map__frame">
			<?php if ( $embed ) : ?>
				<iframe title="<?php echo esc_attr( bs_field( 'mp_h', 'mp.h' ) ); ?>" src="<?php echo esc_url( $embed ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			<?php endif; ?>
		</div>
	</div>
</section>
