<?php
/**
 * Services grid — from the bs_service CPT, falling back to the design defaults.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lang  = bs_lang();
$items = bright_stars_get_items( 'bs_service' );
$cards = array();

if ( $items ) {
	foreach ( $items as $p ) {
		$cards[] = array(
			'icon'  => get_post_meta( $p->ID, '_bs_icon', true ) ?: 'target',
			'title' => bs_meta( $p->ID, 'title', get_the_title( $p ) ),
			'desc'  => bs_meta( $p->ID, 'desc' ),
			'url'   => get_permalink( $p ),
		);
	}
} else {
	foreach ( bright_stars_default_data()['services'] as $s ) {
		$cards[] = array(
			'icon'  => $s['icon'],
			'title' => isset( $s['title'][ $lang ] ) ? $s['title'][ $lang ] : $s['title']['en'],
			'desc'  => isset( $s['desc'][ $lang ] ) ? $s['desc'][ $lang ] : $s['desc']['en'],
			'url'   => '',
		);
	}
}
$svc_more  = bs_t( 'ui.readmore' );
$svc_arrow = bs_is_rtl_lang() ? 'arrow-left' : 'arrow-right';
?>
<section class="bs-section bs-pad" id="services" style="max-width:var(--maxw);margin:0 auto;padding-top:84px;padding-bottom:70px">
	<div class="bs-svc-head" data-reveal>
		<div>
			<?php bright_stars_eyebrow( bs_field( 'sv_eyebrow', 'sv.eyebrow' ) ); ?>
			<h2 class="bs-h2"><?php echo esc_html( bs_field( 'sv_h', 'sv.h' ) ); ?></h2>
		</div>
		<p class="bs-sub" style="max-width:380px;font-size:16px;margin:0"><?php echo esc_html( bs_field( 'sv_sub', 'sv.sub' ) ); ?></p>
	</div>

	<div class="bs-grid-3">
		<?php
		foreach ( $cards as $i => $c ) :
			$tag   = $c['url'] ? 'a' : 'div';
			$href  = $c['url'] ? ' href="' . esc_url( $c['url'] ) . '"' : '';
			$klass = 'bs-svc' . ( $c['url'] ? ' bs-svc--link' : '' );
			?>
			<<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="<?php echo esc_attr( $klass ); ?>"<?php echo $href; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> data-reveal data-rev-delay="<?php echo esc_attr( number_format( ( $i % 3 ) * 0.05, 2 ) ); ?>">
				<?php if ( 0 === $i % 3 ) : ?><span class="bs-svc__corner"></span><?php endif; ?>
				<span class="bs-svc__icon"><?php echo bs_icon( $c['icon'], array( 'size' => 22 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="bs-svc__title"><?php echo esc_html( $c['title'] ); ?></h3>
				<p class="bs-svc__desc"><?php echo esc_html( $c['desc'] ); ?></p>
				<?php if ( $c['url'] ) : ?>
					<span class="bs-svc__more"><?php echo esc_html( $svc_more ); ?> <?php echo bs_icon( $svc_arrow, array( 'size' => 16 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<?php endif; ?>
			</<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php endforeach; ?>
	</div>
</section>
