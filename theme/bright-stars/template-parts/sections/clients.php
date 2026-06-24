<?php
/**
 * Clients grid — bs_client CPT (each links to its case-study page),
 * with four "coming soon" placeholders, falling back to the defaults.
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
		if ( '1' === get_post_meta( $p->ID, '_bs_soon', true ) ) {
			$cards[] = array( 'soon' => true );
			continue;
		}
		$logo = has_post_thumbnail( $p ) ? get_the_post_thumbnail_url( $p, 'thumbnail' ) : bs_image_src( get_post_meta( $p->ID, '_bs_logo', true ), 'thumbnail' );
		$cards[] = array(
			'soon'  => false,
			'name'  => get_the_title( $p ),
			'cat'   => bs_meta( $p->ID, 'category' ),
			'logo'  => $logo,
			'url'   => get_permalink( $p ),
		);
	}
} else {
	foreach ( bright_stars_default_data()['clients'] as $c ) {
		$cards[] = array(
			'soon' => false,
			'name' => $c['name'],
			'cat'  => isset( $c['category'][ $lang ] ) ? $c['category'][ $lang ] : $c['category']['en'],
			'logo' => $c['logo'] ? bs_asset( 'img/clients/' . $c['logo'] ) : '',
			'url'  => bs_route_url( 'clients' ),
		);
	}
}

// Append four "coming soon" placeholders (faithful to the design).
$soon_count = 0;
foreach ( $cards as $c ) {
	if ( ! empty( $c['soon'] ) ) {
		$soon_count++;
	}
}
for ( $i = $soon_count; $i < 4; $i++ ) {
	$cards[] = array( 'soon' => true );
}

$initials = function ( $name ) {
	$parts = preg_split( '/\s+/', trim( $name ) );
	$out   = '';
	foreach ( array_slice( $parts, 0, 2 ) as $w ) {
		$out .= mb_substr( $w, 0, 1 );
	}
	return mb_strtoupper( $out );
};
?>
<section class="bs-section bs-section--panel" id="clients">
	<div class="bs-container" style="padding:56px 40px">
		<div class="bs-center" data-reveal style="margin-bottom:34px">
			<?php bright_stars_eyebrow( bs_t( 'cl.eyebrow' ) ); ?>
			<p class="bs-sub" style="max-width:520px;margin:14px auto 0;font-size:16px"><?php echo esc_html( bs_field( 'cl_sub', 'cl.sub' ) ); ?></p>
		</div>

		<div class="bs-clients-grid" data-reveal data-rev-delay="0.06">
			<?php foreach ( $cards as $c ) : ?>
				<?php if ( ! empty( $c['soon'] ) ) : ?>
					<div class="bs-client bs-client--soon">
						<span class="ic" aria-hidden="true"><?php echo bs_icon( 'clock', array( 'size' => 22, 'stroke' => 1.7 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span style="display:flex;flex-direction:column;gap:6px">
							<span class="bs-client__name"><?php echo esc_html( bs_t( 'cl.soon' ) ); ?></span>
							<span class="bs-client__cat"><?php echo esc_html( bs_t( 'cl.soonsub' ) ); ?></span>
						</span>
					</div>
				<?php else : ?>
					<a class="bs-client" href="<?php echo esc_url( $c['url'] ); ?>">
						<?php if ( $c['logo'] ) : ?>
							<img src="<?php echo esc_url( $c['logo'] ); ?>" alt="<?php echo esc_attr( $c['name'] ); ?>" loading="lazy" width="56" height="56">
						<?php else : ?>
							<span class="bs-client__ph" aria-hidden="true"><?php echo esc_html( $initials( $c['name'] ) ); ?></span>
						<?php endif; ?>
						<span style="display:flex;flex-direction:column;gap:6px">
							<span class="bs-client__name"><?php echo esc_html( $c['name'] ); ?></span>
							<span class="bs-client__cat"><?php echo esc_html( $c['cat'] ); ?></span>
						</span>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
