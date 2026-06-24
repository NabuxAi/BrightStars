<?php
/**
 * Testimonials — bs_testimonial CPT, falling back to the defaults.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lang  = bs_lang();
$items = bright_stars_get_items( 'bs_testimonial' );
$quotes = array();

if ( $items ) {
	foreach ( $items as $p ) {
		$quotes[] = array(
			'quote'    => bs_meta( $p->ID, 'quote' ),
			'author'   => get_post_meta( $p->ID, '_bs_author', true ) ?: get_the_title( $p ),
			'role'     => bs_meta( $p->ID, 'role' ),
			'initials' => get_post_meta( $p->ID, '_bs_initials', true ),
		);
	}
} else {
	foreach ( bright_stars_default_data()['testimonials'] as $t ) {
		$quotes[] = array(
			'quote'    => isset( $t['quote'][ $lang ] ) ? $t['quote'][ $lang ] : $t['quote']['en'],
			'author'   => $t['author'],
			'role'     => isset( $t['role'][ $lang ] ) ? $t['role'][ $lang ] : $t['role']['en'],
			'initials' => $t['initials'],
		);
	}
}

if ( ! $quotes ) {
	return;
}
?>
<section class="bs-section bs-section--panel" id="voices">
	<div class="bs-container bs-pad" style="padding-top:76px;padding-bottom:76px">
		<div class="bs-center" data-reveal style="margin-bottom:42px">
			<?php bright_stars_eyebrow( bs_t( 'ts.eyebrow' ) ); ?>
		</div>
		<div class="bs-grid-2">
			<?php foreach ( $quotes as $i => $q ) : ?>
				<div class="bs-quote" data-reveal data-rev-delay="<?php echo esc_attr( number_format( $i * 0.08, 2 ) ); ?>">
					<div class="bs-quote__mark">&ldquo;</div>
					<p class="bs-quote__text"><?php echo esc_html( $q['quote'] ); ?></p>
					<div class="bs-quote__who">
						<?php if ( $q['initials'] ) : ?>
							<span class="bs-quote__ini"><?php echo esc_html( $q['initials'] ); ?></span>
						<?php endif; ?>
						<div>
							<div class="bs-quote__name"><?php echo esc_html( $q['author'] ); ?></div>
							<div class="bs-quote__role"><?php echo esc_html( $q['role'] ); ?></div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
