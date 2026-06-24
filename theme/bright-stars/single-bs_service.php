<?php
/**
 * Single service — a full, SEO-indexable detail page for one service.
 *
 * Every block (overview, impact stats, what's-included, process, FAQ) is driven
 * by the trilingual meta on the bs_service post and is fully editable from the
 * Bright Stars admin panel.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	$id    = get_the_ID();
	$icon  = get_post_meta( $id, '_bs_icon', true ) ?: 'target';
	$desc  = bs_meta( $id, 'desc' );
	$intro = bs_meta( $id, 'intro' );
	$hero  = bs_image_src( get_post_meta( $id, '_bs_hero_image', true ), 'large' );
	if ( ! $hero && has_post_thumbnail() ) {
		$hero = get_the_post_thumbnail_url( $id, 'large' );
	}

	// Parse the repeatable, pipe-delimited fields.
	$stats = array();
	foreach ( bs_lines( bs_meta( $id, 'stats' ) ) as $line ) {
		list( $v, $l ) = bs_pair( $line );
		$stats[] = array( 'v' => $v, 'l' => $l );
	}
	$features = array();
	foreach ( bs_lines( bs_meta( $id, 'features' ) ) as $line ) {
		list( $t, $d ) = bs_pair( $line );
		$features[] = array( 't' => $t, 'd' => $d );
	}
	$process = array();
	foreach ( bs_lines( bs_meta( $id, 'process' ) ) as $line ) {
		list( $t, $d ) = bs_pair( $line );
		$process[] = array( 't' => $t, 'd' => $d );
	}
	$faq = array();
	foreach ( bs_lines( bs_meta( $id, 'faq' ) ) as $line ) {
		list( $q, $a ) = bs_pair( $line );
		if ( '' !== $a ) {
			$faq[] = array( 'q' => $q, 'a' => $a );
		}
	}

	$arrow = bs_is_rtl_lang() ? 'arrow-left' : 'arrow-right';
	?>
	<article <?php post_class( 'bs-svp' ); ?>>

		<!-- HERO -->
		<section class="bs-svp-hero">
			<span class="bs-svp-hero__glow" aria-hidden="true"></span>
			<div class="bs-pad bs-svp-hero__wrap">
				<div class="bs-svp-hero__grid">
					<div class="bs-svp-hero__copy" data-reveal>
						<?php bright_stars_eyebrow( bs_t( 'svc.badge' ) ); ?>
						<div class="bs-svp-hero__mark"><?php echo bs_icon( $icon, array( 'size' => 30, 'stroke' => 1.7 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						<h1 class="bs-svp-hero__title"><?php the_title(); ?></h1>
						<?php if ( $desc ) : ?><p class="bs-svp-hero__lead"><?php echo esc_html( $desc ); ?></p><?php endif; ?>
						<div class="bs-hero__cta" style="margin-top:30px">
							<a class="bs-btn bs-btn--primary bs-btn--lg" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>">
								<span><?php echo esc_html( bs_t( 'svc.talk' ) ); ?></span>
								<?php echo bs_icon( $arrow, array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
							<a class="bs-btn bs-btn--ghost bs-btn--lg" href="<?php echo esc_url( bs_route_url( 'services' ) ); ?>"><?php echo esc_html( bs_t( 'svc.all' ) ); ?></a>
						</div>
					</div>

					<div class="bs-svp-hero__aside" data-reveal data-rev-delay="0.12">
						<?php if ( $hero ) : ?>
							<div class="bs-svp-hero__media">
								<img src="<?php echo esc_url( $hero ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="eager">
							</div>
						<?php elseif ( $stats ) : ?>
							<div class="bs-svp-hero__card">
								<span class="bs-svp-hero__cardicon"><?php echo bs_icon( $icon, array( 'size' => 26 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								<div class="bs-svp-hero__cardstats">
									<?php foreach ( array_slice( $stats, 0, 3 ) as $s ) : ?>
										<div class="bs-svp-hero__cardstat">
											<span class="bs-svp-hero__cardnum" data-count><?php echo esc_html( $s['v'] ); ?></span>
											<span class="bs-svp-hero__cardlbl"><?php echo esc_html( $s['l'] ); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php else : ?>
							<div class="bs-svp-hero__card bs-svp-hero__card--mark">
								<span class="bs-svp-hero__bigmark"><?php echo bs_icon( $icon, array( 'size' => 64, 'stroke' => 1.3 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<?php if ( $intro || trim( get_the_content() ) ) : ?>
		<!-- OVERVIEW -->
		<section class="bs-pad bs-svp-sec" style="max-width:900px;margin:0 auto">
			<div data-reveal>
				<?php bright_stars_eyebrow( bs_t( 'svc.intro_e' ) ); ?>
				<h2 class="bs-h2 bs-svp-h2"><?php echo esc_html( bs_t( 'svc.intro_h' ) ); ?></h2>
			</div>
			<?php if ( $intro ) : ?>
				<p class="bs-svp-lead" data-reveal data-rev-delay="0.05"><?php echo esc_html( $intro ); ?></p>
			<?php endif; ?>
			<?php if ( trim( get_the_content() ) ) : ?>
				<div class="bs-prose" data-reveal data-rev-delay="0.08"><?php the_content(); ?></div>
			<?php endif; ?>
		</section>
		<?php endif; ?>

		<?php if ( $stats ) : ?>
		<!-- IMPACT STATS -->
		<section class="bs-section--panel">
			<div class="bs-pad bs-svp-sec" style="max-width:var(--maxw);margin:0 auto">
				<div class="bs-center" data-reveal style="margin-bottom:36px">
					<?php bright_stars_eyebrow( bs_t( 'svc.stats_e' ) ); ?>
					<h2 class="bs-h2 bs-svp-h2"><?php echo esc_html( bs_t( 'svc.stats_h' ) ); ?></h2>
				</div>
				<div class="bs-svp-stats" data-reveal data-rev-delay="0.06" style="grid-template-columns:repeat(<?php echo (int) min( 3, count( $stats ) ); ?>,1fr)">
					<?php foreach ( $stats as $s ) : ?>
						<div class="bs-svp-stat">
							<span class="bs-svp-stat__num" data-count><?php echo esc_html( $s['v'] ); ?></span>
							<span class="bs-svp-stat__lbl"><?php echo esc_html( $s['l'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php if ( $features ) : ?>
		<!-- WHAT'S INCLUDED -->
		<section class="bs-pad bs-svp-sec" style="max-width:var(--maxw);margin:0 auto">
			<div data-reveal style="margin-bottom:36px">
				<?php bright_stars_eyebrow( bs_t( 'svc.inc_e' ) ); ?>
				<h2 class="bs-h2 bs-svp-h2"><?php echo esc_html( bs_t( 'svc.inc_h' ) ); ?></h2>
			</div>
			<div class="bs-svp-feats">
				<?php foreach ( $features as $i => $f ) : ?>
					<div class="bs-svp-feat" data-reveal data-rev-delay="<?php echo esc_attr( number_format( ( $i % 2 ) * 0.06, 2 ) ); ?>">
						<span class="bs-svp-feat__ic"><?php echo bs_icon( 'check', array( 'size' => 20, 'stroke' => 2.4 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<div>
							<h3 class="bs-svp-feat__t"><?php echo esc_html( $f['t'] ); ?></h3>
							<?php if ( $f['d'] ) : ?><p class="bs-svp-feat__d"><?php echo esc_html( $f['d'] ); ?></p><?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
		<?php endif; ?>

		<?php if ( $process ) : ?>
		<!-- PROCESS -->
		<section class="bs-section--panel">
			<div class="bs-pad bs-svp-sec" style="max-width:var(--maxw);margin:0 auto">
				<div data-reveal style="margin-bottom:38px">
					<?php bright_stars_eyebrow( bs_t( 'svc.proc_e' ) ); ?>
					<h2 class="bs-h2 bs-svp-h2"><?php echo esc_html( bs_t( 'svc.proc_h' ) ); ?></h2>
				</div>
				<div class="bs-svp-steps">
					<?php foreach ( $process as $i => $p ) : ?>
						<div class="bs-svp-step" data-reveal data-rev-delay="<?php echo esc_attr( number_format( ( $i % 4 ) * 0.05, 2 ) ); ?>">
							<span class="bs-svp-step__n"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<h3 class="bs-svp-step__t"><?php echo esc_html( $p['t'] ); ?></h3>
							<?php if ( $p['d'] ) : ?><p class="bs-svp-step__d"><?php echo esc_html( $p['d'] ); ?></p><?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php if ( $faq ) : ?>
		<!-- FAQ -->
		<section class="bs-pad bs-svp-sec" style="max-width:860px;margin:0 auto">
			<div class="bs-center" data-reveal style="margin-bottom:32px">
				<?php bright_stars_eyebrow( bs_t( 'svc.faq_e' ) ); ?>
				<h2 class="bs-h2 bs-svp-h2"><?php echo esc_html( bs_t( 'svc.faq_h' ) ); ?></h2>
			</div>
			<div class="bs-svp-faq" data-reveal data-rev-delay="0.05">
				<?php foreach ( $faq as $f ) : ?>
					<details class="bs-svp-q">
						<summary>
							<span><?php echo esc_html( $f['q'] ); ?></span>
							<span class="bs-svp-q__sign" aria-hidden="true"></span>
						</summary>
						<div class="bs-svp-q__a"><?php echo esc_html( $f['a'] ); ?></div>
					</details>
				<?php endforeach; ?>
			</div>
		</section>
		<?php endif; ?>

		<?php
		// Other services.
		$others = array();
		foreach ( bright_stars_get_items( 'bs_service' ) as $s ) {
			if ( (int) $s->ID !== (int) $id ) {
				$others[] = $s;
			}
		}
		$others = array_slice( $others, 0, 5 );
		if ( $others ) :
			?>
		<!-- OTHER SERVICES -->
		<section class="bs-pad bs-svp-sec" style="max-width:var(--maxw);margin:0 auto">
			<div data-reveal style="margin-bottom:26px">
				<?php bright_stars_eyebrow( bs_t( 'svc.other_e' ) ); ?>
				<h2 class="bs-h2 bs-svp-h2"><?php echo esc_html( bs_t( 'svc.other_h' ) ); ?></h2>
			</div>
			<div class="bs-svp-other" data-reveal data-rev-delay="0.05">
				<?php foreach ( $others as $s ) : ?>
					<a class="bs-svp-othercard" href="<?php echo esc_url( get_permalink( $s ) ); ?>">
						<span class="bs-svp-othercard__ic"><?php echo bs_icon( get_post_meta( $s->ID, '_bs_icon', true ) ?: 'target', array( 'size' => 20 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span class="bs-svp-othercard__t"><?php echo esc_html( bs_meta( $s->ID, 'title', get_the_title( $s ) ) ); ?></span>
						<?php echo bs_icon( $arrow, array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				<?php endforeach; ?>
			</div>
		</section>
		<?php endif; ?>

		<!-- CTA -->
		<section class="bs-pad" style="max-width:var(--maxw);margin:0 auto;padding-top:30px;padding-bottom:90px">
			<div class="bs-cta" data-reveal style="text-align:center">
				<span class="bs-cta__c1" aria-hidden="true"></span>
				<span class="bs-cta__c2" aria-hidden="true"></span>
				<div style="position:relative">
					<h2 class="bs-cta__h" style="font-size:40px"><?php echo esc_html( bs_t( 'svc.cta_h' ) ); ?></h2>
					<p class="bs-cta__sub" style="margin:14px auto 24px;max-width:560px"><?php echo esc_html( bs_t( 'svc.cta_sub' ) ); ?></p>
					<a class="bs-btn bs-btn--primary bs-btn--lg" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>" style="margin:0 auto">
						<span><?php echo esc_html( bs_t( 'nav.start' ) ); ?></span>
						<?php echo bs_icon( $arrow, array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</div>
			</div>
		</section>

	</article>
	<?php
endwhile;

get_footer();
