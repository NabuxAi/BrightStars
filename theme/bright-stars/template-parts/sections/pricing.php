<?php
/**
 * Pricing plans — bs_pricing CPT, falling back to the defaults.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lang  = bs_lang();
$items = bright_stars_get_items( 'bs_pricing' );
$plans = array();

if ( $items ) {
	foreach ( $items as $p ) {
		$feat_raw = bs_meta( $p->ID, 'features' );
		$plans[]  = array(
			'name'     => bs_meta( $p->ID, 'name', get_the_title( $p ) ),
			'price'    => bs_meta( $p->ID, 'price' ),
			'period'   => bs_meta( $p->ID, 'period' ),
			'desc'     => bs_meta( $p->ID, 'desc' ),
			'cta'      => bs_meta( $p->ID, 'cta', bs_t( 'pc3b' ) ),
			'badge'    => bs_meta( $p->ID, 'badge' ),
			'featured' => '1' === get_post_meta( $p->ID, '_bs_featured', true ),
			'features' => array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $feat_raw ) ) ),
		);
	}
} else {
	foreach ( bright_stars_default_data()['pricing'] as $p ) {
		$pick = function ( $f ) use ( $p, $lang ) {
			return isset( $p[ $f ][ $lang ] ) ? $p[ $f ][ $lang ] : $p[ $f ]['en'];
		};
		$plans[] = array(
			'name'     => $pick( 'name' ),
			'price'    => $pick( 'price' ),
			'period'   => $pick( 'period' ),
			'desc'     => $pick( 'desc' ),
			'cta'      => $pick( 'cta' ),
			'badge'    => $pick( 'badge' ),
			'featured' => $p['featured'],
			'features' => array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $pick( 'features' ) ) ) ),
		);
	}
}
?>
<section class="bs-section bs-pad" id="pricing" style="max-width:var(--maxw);margin:0 auto;padding-top:84px;padding-bottom:70px">
	<div class="bs-center" data-reveal style="margin-bottom:46px">
		<?php bright_stars_eyebrow( bs_t( 'pc.eyebrow' ) ); ?>
		<h2 class="bs-h2" style="margin:14px 0 8px"><?php echo esc_html( bs_field( 'pc_h', 'pc.h' ) ); ?></h2>
		<p class="bs-sub" style="max-width:480px;margin:0 auto;font-size:16px"><?php echo esc_html( bs_field( 'pc_sub', 'pc.sub' ) ); ?></p>
	</div>

	<div class="bs-pricing">
		<?php foreach ( $plans as $i => $pl ) : ?>
			<div class="bs-plan <?php echo $pl['featured'] ? 'bs-plan--featured' : ''; ?>" data-reveal data-rev-delay="<?php echo esc_attr( number_format( $i * 0.07, 2 ) ); ?>">
				<?php if ( $pl['featured'] && $pl['badge'] ) : ?>
					<span class="bs-plan__badge"><?php echo esc_html( $pl['badge'] ); ?></span>
				<?php endif; ?>
				<div class="bs-plan__name"><?php echo esc_html( $pl['name'] ); ?></div>
				<div class="bs-plan__price">
					<span class="amt"><?php echo esc_html( $pl['price'] ); ?></span>
					<?php if ( $pl['period'] ) : ?><span class="per"><?php echo esc_html( $pl['period'] ); ?></span><?php endif; ?>
				</div>
				<p class="bs-plan__desc"><?php echo esc_html( $pl['desc'] ); ?></p>
				<div class="bs-plan__feats">
					<?php foreach ( $pl['features'] as $feat ) : ?>
						<span>
							<?php echo bs_icon( 'check', array( 'size' => 16, 'stroke' => 2.4 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<span><?php echo esc_html( $feat ); ?></span>
						</span>
					<?php endforeach; ?>
				</div>
				<a class="bs-plan__cta <?php echo $pl['featured'] ? 'bs-btn bs-btn--primary' : 'bs-btn bs-btn--ghost'; ?>" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>"><?php echo esc_html( $pl['cta'] ); ?></a>
			</div>
		<?php endforeach; ?>
	</div>
</section>
