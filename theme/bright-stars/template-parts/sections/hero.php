<?php
/**
 * Hero section.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$stats = array(
	array( 'num' => bs_opt( 'stat1_num', '120+' ), 'label' => bs_field( 'stat1_label', 'st.brands' ), 'accent' => false ),
	array( 'num' => bs_opt( 'stat2_num', '8 yrs' ), 'label' => bs_field( 'stat2_label', 'st.gulf' ), 'accent' => false ),
	array( 'num' => bs_opt( 'stat3_num', '4.2x' ), 'label' => bs_field( 'stat3_label', 'st.roas' ), 'accent' => true ),
);
?>
<section class="bs-hero" id="top">
	<div class="bs-hero__inner">
		<div data-reveal>
			<?php bright_stars_eyebrow( bs_field( 'hero_tag', 'hero.tag' ) ); ?>
		</div>
		<h1 class="bs-hero__h1" data-reveal data-rev-delay="0.06">
			<?php echo esc_html( bs_field( 'hero_h1a', 'hero.h1a' ) ); ?><br>
			<?php echo esc_html( bs_field( 'hero_h1b', 'hero.h1b' ) ); ?>
			<span class="bs-accent-word"><?php echo esc_html( bs_field( 'hero_brand', 'hero.brand' ) ); ?></span>
		</h1>
		<p class="bs-hero__sub" data-reveal data-rev-delay="0.12"><?php echo esc_html( bs_field( 'hero_sub', 'hero.sub' ) ); ?></p>

		<div class="bs-hero__cta" data-reveal data-rev-delay="0.18">
			<a class="bs-btn bs-btn--primary bs-btn--lg" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>">
				<span><?php echo esc_html( bs_t( 'nav.start' ) ); ?></span>
				<?php echo bs_icon( 'arrow-right', array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
			<a class="bs-btn bs-btn--ghost bs-btn--lg" href="<?php echo esc_url( bs_route_url( 'services' ) ); ?>">
				<span><?php echo esc_html( bs_t( 'hero.what' ) ); ?></span>
			</a>
		</div>

		<div class="bs-hero__stats" data-reveal data-rev-delay="0.24">
			<?php foreach ( $stats as $i => $s ) : ?>
				<?php if ( $i > 0 ) : ?><div class="bs-stat__sep"></div><?php endif; ?>
				<div>
					<div class="bs-stat__num <?php echo $s['accent'] ? 'accent' : ''; ?>"><?php echo esc_html( $s['num'] ); ?></div>
					<div class="bs-stat__label"><?php echo esc_html( $s['label'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="bs-hero__decor" aria-hidden="true">
		<div class="bs-decor-ring"></div>
		<div class="bs-decor-diamond"></div>
		<div class="bs-decor-card">
			<span class="corner"></span>
			<span class="rec"><i></i>REC</span>
			<span class="play"><?php echo bs_icon( 'play', array( 'size' => 22, 'fill' => true ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<div class="meta">
				<div class="tag">&lt; REELS &gt;</div>
				<div class="bar" style="width:78%;background:#2A384D"></div>
				<div class="bar" style="width:52%;background:var(--bs-line)"></div>
			</div>
		</div>
		<div class="bs-decor-stat">
			<div class="lbl">&lt; ENGAGEMENT &gt;</div>
			<div class="val">+312%</div>
			<div class="bars">
				<span style="height:38%"></span>
				<span style="height:58%"></span>
				<span style="height:46%"></span>
				<span class="on" style="height:78%"></span>
				<span class="on" style="height:100%"></span>
			</div>
		</div>
	</div>
</section>
