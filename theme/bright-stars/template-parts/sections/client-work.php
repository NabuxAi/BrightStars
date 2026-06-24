<?php
/**
 * "The feed we built" — gallery of client Instagram grids (Clients page).
 * Pulls feeds from the bs_client CPT, falling back to the bundled defaults.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lang  = bs_lang();
$items = bright_stars_get_items( 'bs_client' );
$cards = array();

if ( $items ) {
	foreach ( $items as $p ) {
		$feed_raw = get_post_meta( $p->ID, '_bs_feed', true );
		if ( ! $feed_raw ) {
			continue;
		}
		$cards[] = array(
			'name'   => get_the_title( $p ),
			'handle' => get_post_meta( $p->ID, '_bs_handle', true ),
			'feed'   => bs_image_src( $feed_raw, 'large' ),
			'url'    => get_permalink( $p ),
		);
	}
} else {
	foreach ( bright_stars_default_data()['clients'] as $c ) {
		if ( empty( $c['feed'] ) ) {
			continue;
		}
		$cards[] = array(
			'name'   => $c['name'],
			'handle' => $c['handle'],
			'feed'   => bs_asset( 'img/feeds/' . $c['feed'] ),
			'url'    => bs_route_url( 'clients' ),
		);
	}
}

if ( ! $cards ) {
	return;
}
?>
<section class="bs-section--panel">
	<div class="bs-container bs-pad" style="padding-top:72px;padding-bottom:80px">
		<div data-reveal style="margin-bottom:32px">
			<?php bright_stars_eyebrow( bs_t( 'cl.work_e' ) ); ?>
			<h2 class="bs-h2" style="font-size:42px"><?php echo esc_html( bs_field( 'clwork_h', 'cl.work_h' ) ); ?></h2>
			<p class="bs-sub" style="max-width:600px;margin:12px 0 0;font-size:16px"><?php echo esc_html( bs_field( 'clwork_sub', 'cl.work_sub' ) ); ?></p>
		</div>

		<div class="bs-feedgrid" data-reveal data-rev-delay="0.06">
			<?php foreach ( $cards as $i => $c ) : ?>
				<a class="bs-feedcard" href="<?php echo esc_url( $c['url'] ); ?>" data-rev-delay="<?php echo esc_attr( number_format( ( $i % 3 ) * 0.05, 2 ) ); ?>">
					<div class="bs-feedcard__img">
						<img src="<?php echo esc_url( $c['feed'] ); ?>" alt="<?php echo esc_attr( $c['name'] . ' — Instagram feed' ); ?>" loading="lazy">
						<span class="bs-feedcard__ig"><?php echo bs_icon( 'instagram', array( 'size' => 16 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					</div>
					<div class="bs-feedcard__foot">
						<span class="bs-feedcard__name"><?php echo esc_html( $c['name'] ); ?></span>
						<?php if ( $c['handle'] ) : ?><span class="bs-feedcard__handle">@<?php echo esc_html( $c['handle'] ); ?></span><?php endif; ?>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
