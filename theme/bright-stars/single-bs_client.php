<?php
/**
 * Single client — full case study with the Instagram feed showcase.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	$id       = get_the_ID();
	$logo     = has_post_thumbnail() ? get_the_post_thumbnail_url( $id, 'medium' ) : bs_image_src( get_post_meta( $id, '_bs_logo', true ), 'medium' );
	$cat      = bs_meta( $id, 'category' );
	$tagline  = bs_meta( $id, 'tagline' );
	$brief    = bs_meta( $id, 'brief' );
	$ig       = get_post_meta( $id, '_bs_instagram', true );
	$handle   = get_post_meta( $id, '_bs_handle', true );
	$feed     = bs_image_src( get_post_meta( $id, '_bs_feed', true ), 'large' );
	$color    = get_post_meta( $id, '_bs_color', true );
	$color    = $color ? $color : 'linear-gradient(135deg,#2E568A,#0A1F38)';

	$services = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) bs_meta( $id, 'services' ) ) ) );
	$results  = array();
	foreach ( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) bs_meta( $id, 'results' ) ) ) ) as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		$label = isset( $parts[1] ) ? $parts[1] : '';
		$ba    = preg_split( '/\s*(?:→|->)\s*/u', $parts[0], 2 );
		if ( count( $ba ) === 2 ) {
			$results[] = array( 'type' => 'ba', 'before' => $ba[0], 'after' => $ba[1], 'l' => $label );
		} else {
			$results[] = array( 'type' => 'delta', 'n' => $parts[0], 'l' => $label );
		}
	}
	?>
	<article <?php post_class( 'bs-cs' ); ?>>

		<!-- HERO -->
		<section class="bs-pad bs-cs-hero" style="max-width:var(--maxw);margin:0 auto;padding:72px 40px 64px">
			<div class="bs-cs-hero__grid" data-reveal>
				<div>
					<?php bright_stars_eyebrow( $cat ); ?>
					<h1 class="bs-cs-hero__name"><?php the_title(); ?></h1>
					<?php if ( $tagline ) : ?><p class="bs-cs-hero__tag"><?php echo esc_html( $tagline ); ?></p><?php endif; ?>
					<?php if ( $brief ) : ?><p class="bs-cs-hero__brief"><?php echo esc_html( $brief ); ?></p><?php endif; ?>
					<div class="bs-hero__cta" style="margin-top:32px">
						<?php if ( $ig ) : ?>
							<a class="bs-btn bs-btn--primary" href="<?php echo esc_url( $ig ); ?>" target="_blank" rel="noopener">
								<?php echo bs_icon( 'instagram', array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<span><?php echo esc_html( bs_t( 'cs.ig' ) ); ?></span>
							</a>
						<?php endif; ?>
						<a class="bs-btn bs-btn--ghost" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>"><?php echo esc_html( bs_t( 'nav.start' ) ); ?></a>
					</div>
				</div>
				<div class="bs-cs-hero__card-wrap" data-reveal data-rev-delay="0.12">
					<span class="bs-cs-corner tl" aria-hidden="true"></span>
					<span class="bs-cs-corner br" aria-hidden="true"></span>
					<div class="bs-cs-hero__card" style="background:<?php echo esc_attr( $color ); ?>">
						<?php if ( $logo ) : ?>
							<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" width="150" height="150">
						<?php endif; ?>
						<span class="bs-cs-hero__cardname"><?php the_title(); ?></span>
					</div>
				</div>
			</div>
		</section>

		<?php if ( $services ) : ?>
		<!-- WHAT WE DID -->
		<section class="bs-section--panel">
			<div class="bs-container bs-pad" style="padding:64px 40px">
				<div data-reveal style="margin-bottom:30px">
					<?php bright_stars_eyebrow( bs_t( 'cs.did_e' ) ); ?>
					<h2 class="bs-h2" style="font-size:38px"><?php echo esc_html( bs_t( 'cs.did_h' ) ); ?></h2>
				</div>
				<div class="bs-cs-pills" data-reveal data-rev-delay="0.06">
					<?php foreach ( $services as $s ) : ?>
						<span class="bs-cs-pill"><i></i><?php echo esc_html( $s ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php if ( $results ) : ?>
		<!-- RESULTS -->
		<section class="bs-pad" style="max-width:var(--maxw);margin:0 auto;padding:72px 40px">
			<div class="bs-center" data-reveal style="margin-bottom:40px">
				<?php bright_stars_eyebrow( bs_t( 'cs.res_e' ) ); ?>
				<h2 class="bs-h2" style="font-size:38px"><?php echo esc_html( bs_t( 'cs.res_h' ) ); ?></h2>
			</div>
			<div class="bs-metrics bs-results" data-reveal data-rev-delay="0.06" style="grid-template-columns:repeat(<?php echo (int) min( 3, count( $results ) ); ?>,1fr)">
				<?php foreach ( $results as $r ) : ?>
					<div class="bs-metric bs-result">
						<?php if ( 'ba' === $r['type'] ) : ?>
							<div class="bs-result__ba">
								<span class="bs-result__before"><?php echo esc_html( $r['before'] ); ?></span>
								<?php echo bs_icon( bs_is_rtl_lang() ? 'arrow-left' : 'arrow-right', array( 'size' => 22, 'stroke' => 2.4 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<span class="bs-result__after" data-count><?php echo esc_html( $r['after'] ); ?></span>
							</div>
						<?php else : ?>
							<div class="bs-metric__num accent" style="font-size:56px" data-count><?php echo esc_html( $r['n'] ); ?></div>
						<?php endif; ?>
						<div class="bs-metric__lbl"><?php echo esc_html( $r['l'] ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
		<?php endif; ?>

		<?php if ( $feed ) : ?>
		<!-- THE FEED WE BUILT -->
		<section class="bs-section--panel">
			<div class="bs-pad" style="max-width:1100px;margin:0 auto;padding:64px 40px">
				<div data-reveal style="margin-bottom:26px">
					<?php bright_stars_eyebrow( bs_t( 'cl.work_e' ) ); ?>
					<h2 class="bs-h2" style="font-size:34px"><?php echo esc_html( bs_t( 'cl.work_h' ) ); ?></h2>
				</div>
				<div class="bs-feedwin" data-reveal data-rev-delay="0.06">
					<div class="bs-feedwin__bar">
						<span class="dot" style="background:#ff5f57"></span>
						<span class="dot" style="background:#febc2e"></span>
						<span class="dot" style="background:#28c840"></span>
						<span class="bs-feedwin__url">instagram.com/<?php echo esc_html( $handle ); ?></span>
					</div>
					<div class="bs-feedwin__scroll">
						<img src="<?php echo esc_url( $feed ); ?>" alt="<?php echo esc_attr( get_the_title() . ' Instagram feed' ); ?>" loading="lazy">
					</div>
				</div>
				<p class="bs-feedwin__hint" data-reveal><?php echo esc_html( bs_t( 'cs.scroll' ) ); ?></p>
			</div>
		</section>
		<?php endif; ?>

		<!-- NEXT / CTA -->
		<?php
		$all  = bright_stars_get_items( 'bs_client' );
		$next = null;
		if ( $all ) {
			$ids = array();
			foreach ( $all as $cli ) {
				if ( '1' !== get_post_meta( $cli->ID, '_bs_soon', true ) ) {
					$ids[] = $cli->ID;
				}
			}
			$pos = array_search( $id, $ids, true );
			if ( false !== $pos ) {
				$next = get_post( $ids[ ( $pos + 1 ) % count( $ids ) ] );
			}
		}
		?>
		<section class="bs-pad" style="max-width:var(--maxw);margin:0 auto;padding:64px 40px 88px">
			<div class="bs-cs-next" data-reveal>
				<?php if ( $next && $next->ID !== $id ) : ?>
					<div>
						<div class="bs-cs-next__e"><?php echo esc_html( bs_t( 'cs.next' ) ); ?></div>
						<a class="bs-cs-next__name" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
							<?php echo esc_html( get_the_title( $next ) ); ?>
							<?php echo bs_icon( bs_is_rtl_lang() ? 'arrow-left' : 'arrow-right', array( 'size' => 26, 'stroke' => 2 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</a>
					</div>
				<?php else : ?>
					<div><a class="bs-cs-next__name" href="<?php echo esc_url( bs_route_url( 'clients' ) ); ?>"><?php echo esc_html( bs_t( 'nav.clients' ) ); ?></a></div>
				<?php endif; ?>
				<a class="bs-btn bs-btn--primary bs-btn--lg" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>"><?php echo esc_html( bs_t( 'cs.start_big' ) ); ?></a>
			</div>
		</section>

	</article>
	<?php
endwhile;

get_footer();
