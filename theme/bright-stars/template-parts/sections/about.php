<?php
/**
 * About + team — bs_team CPT, falling back to the defaults.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lang  = bs_lang();
$items = bright_stars_get_items( 'bs_team' );
$team  = array();

if ( $items ) {
	foreach ( $items as $p ) {
		$photo = has_post_thumbnail( $p ) ? get_the_post_thumbnail_url( $p, 'thumbnail' ) : get_post_meta( $p->ID, '_bs_photo', true );
		$team[] = array(
			'name'  => get_the_title( $p ),
			'photo' => $photo,
			'role'  => bs_meta( $p->ID, 'role' ),
			'quote' => bs_meta( $p->ID, 'quote' ),
			'bio'   => bs_meta( $p->ID, 'bio' ),
		);
	}
} else {
	foreach ( bright_stars_default_data()['team'] as $m ) {
		$team[] = array(
			'name'  => $m['name'],
			'photo' => bs_asset( 'img/team/' . $m['photo'] ),
			'role'  => isset( $m['role'][ $lang ] ) ? $m['role'][ $lang ] : $m['role']['en'],
			'quote' => isset( $m['quote'][ $lang ] ) ? $m['quote'][ $lang ] : $m['quote']['en'],
			'bio'   => isset( $m['bio'][ $lang ] ) ? $m['bio'][ $lang ] : $m['bio']['en'],
		);
	}
}
?>
<section class="bs-section bs-pad" id="about" style="max-width:var(--maxw);margin:0 auto;padding-top:84px;padding-bottom:40px">
	<div class="bs-center" data-reveal style="margin-bottom:14px">
		<?php bright_stars_eyebrow( bs_t( 'ab.eyebrow' ) ); ?>
	</div>
	<h2 class="bs-h2 bs-center" data-reveal style="margin:0 auto 18px"><?php echo esc_html( bs_field( 'about_h', 'ab.h' ) ); ?></h2>
	<p class="bs-sub bs-center" data-reveal data-rev-delay="0.06" style="max-width:720px;margin:0 auto 48px"><?php echo esc_html( bs_field( 'about_intro', 'ab.intro' ) ); ?></p>

	<div class="bs-team">
		<?php foreach ( $team as $i => $m ) : ?>
			<div class="bs-member" data-reveal data-rev-delay="<?php echo esc_attr( number_format( $i * 0.08, 2 ) ); ?>">
				<div class="bs-member__top">
					<?php if ( $m['photo'] ) : ?>
						<img class="bs-member__photo" src="<?php echo esc_url( $m['photo'] ); ?>" alt="<?php echo esc_attr( $m['name'] ); ?>" loading="lazy" width="74" height="74">
					<?php endif; ?>
					<div>
						<div class="bs-member__name"><?php echo esc_html( $m['name'] ); ?></div>
						<div class="bs-member__role"><?php echo esc_html( $m['role'] ); ?></div>
					</div>
				</div>
				<?php if ( $m['quote'] ) : ?>
					<p class="bs-member__quote"><?php echo esc_html( $m['quote'] ); ?></p>
				<?php endif; ?>
				<p class="bs-member__bio"><?php echo esc_html( $m['bio'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
