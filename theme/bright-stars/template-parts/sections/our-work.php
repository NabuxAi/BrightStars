<?php
/**
 * Homepage "work we've done" — a foxcod-style sticky, scroll-pinned stack of
 * client case studies. Each panel pins to the viewport and the next scrolls up
 * over it, with a phone mockup of the Instagram feed we built. Pulls from the
 * bs_client CPT (feeds, taglines, services) and degrades to a normal stack on
 * mobile, with no horizontal scroll.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items   = bright_stars_get_items( 'bs_client' );
$clients = array();

if ( $items ) {
	foreach ( $items as $p ) {
		if ( '1' === get_post_meta( $p->ID, '_bs_soon', true ) ) {
			continue;
		}
		$feed = bs_image_src( get_post_meta( $p->ID, '_bs_feed', true ), 'large' );
		$logo = has_post_thumbnail( $p ) ? get_the_post_thumbnail_url( $p, 'medium' ) : bs_image_src( get_post_meta( $p->ID, '_bs_logo', true ), 'medium' );
		$clients[] = array(
			'name'     => get_the_title( $p ),
			'cat'      => bs_meta( $p->ID, 'category' ),
			'tag'      => bs_meta( $p->ID, 'tagline' ),
			'services' => array_slice( bs_lines( bs_meta( $p->ID, 'services' ) ), 0, 4 ),
			'feed'     => $feed,
			'logo'     => $logo,
			'handle'   => get_post_meta( $p->ID, '_bs_handle', true ),
			'color'    => get_post_meta( $p->ID, '_bs_color', true ) ?: 'linear-gradient(135deg,#2E568A,#0A1F38)',
			'url'      => get_permalink( $p ),
		);
	}
}

// Prioritise clients that have a feed screenshot (best for the phone mockup).
$with_feed = array();
$no_feed   = array();
foreach ( $clients as $c ) {
	if ( $c['feed'] ) {
		$with_feed[] = $c;
	} else {
		$no_feed[] = $c;
	}
}
$clients = array_slice( array_merge( $with_feed, $no_feed ), 0, 5 );

if ( ! $clients ) {
	return;
}

$arrow = bs_is_rtl_lang() ? 'arrow-left' : 'arrow-right';
?>
<section class="bs-cwx" id="our-work">
	<div class="bs-pad bs-cwx__intro" data-reveal>
		<?php bright_stars_eyebrow( bs_t( 'ow.eyebrow' ) ); ?>
		<h2 class="bs-cwx__title"><?php echo esc_html( bs_t( 'ow.h' ) ); ?></h2>
		<p class="bs-cwx__lead"><?php echo esc_html( bs_t( 'ow.sub' ) ); ?></p>
	</div>

	<div class="bs-cwx__stack">
		<?php
		$total = count( $clients );
		foreach ( $clients as $i => $c ) :
			$num = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
			?>
			<article class="bs-cwx__panel" style="--accent:<?php echo esc_attr( $c['color'] ); ?>;z-index:<?php echo (int) ( $i + 1 ); ?>">
				<div class="bs-pad bs-cwx__panel-inner">
					<div class="bs-cwx__copy">
						<span class="bs-cwx__count"><?php echo esc_html( $num ); ?> <span class="bs-cwx__count-tot">/ <?php echo esc_html( str_pad( (string) $total, 2, '0', STR_PAD_LEFT ) ); ?></span></span>
						<?php if ( $c['cat'] ) : ?><span class="bs-cwx__cat"><?php echo esc_html( $c['cat'] ); ?></span><?php endif; ?>
						<h3 class="bs-cwx__name"><?php echo esc_html( $c['name'] ); ?></h3>
						<?php if ( $c['tag'] ) : ?><p class="bs-cwx__tag"><?php echo esc_html( $c['tag'] ); ?></p><?php endif; ?>
						<?php if ( $c['services'] ) : ?>
							<div class="bs-cwx__tags">
								<?php foreach ( $c['services'] as $s ) : ?>
									<span class="bs-cwx__chip"><?php echo esc_html( $s ); ?></span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<a class="bs-cwx__view" href="<?php echo esc_url( $c['url'] ); ?>">
							<span><?php echo esc_html( bs_t( 'ow.view' ) ); ?></span>
							<?php echo bs_icon( $arrow, array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</a>
					</div>

					<div class="bs-cwx__visual">
						<?php if ( $c['feed'] ) : ?>
							<a class="bs-phone" href="<?php echo esc_url( $c['url'] ); ?>" aria-label="<?php echo esc_attr( $c['name'] ); ?>">
								<span class="bs-phone__notch" aria-hidden="true"></span>
								<span class="bs-phone__screen">
									<img class="bs-phone__feed" src="<?php echo esc_url( $c['feed'] ); ?>" alt="<?php echo esc_attr( $c['name'] . ' Instagram feed' ); ?>" loading="lazy">
								</span>
								<?php if ( $c['handle'] ) : ?><span class="bs-phone__handle">@<?php echo esc_html( $c['handle'] ); ?></span><?php endif; ?>
							</a>
						<?php else : ?>
							<a class="bs-cwx__logocard" href="<?php echo esc_url( $c['url'] ); ?>" aria-label="<?php echo esc_attr( $c['name'] ); ?>">
								<?php if ( $c['logo'] ) : ?>
									<img src="<?php echo esc_url( $c['logo'] ); ?>" alt="<?php echo esc_attr( $c['name'] ); ?>" loading="lazy" width="120" height="120">
								<?php else : ?>
									<span class="bs-cwx__logomark"><?php echo bs_icon( 'instagram', array( 'size' => 44, 'stroke' => 1.4 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								<?php endif; ?>
								<span class="bs-cwx__logoname"><?php echo esc_html( $c['name'] ); ?></span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</article>
		<?php endforeach; ?>
	</div>

	<div class="bs-pad bs-cwx__foot" data-reveal>
		<a class="bs-btn bs-btn--ghost bs-btn--lg" href="<?php echo esc_url( bs_route_url( 'clients' ) ); ?>">
			<span><?php echo esc_html( bs_t( 'ow.all' ) ); ?></span>
			<?php echo bs_icon( $arrow, array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</div>
</section>
