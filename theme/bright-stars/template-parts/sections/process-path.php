<?php
/**
 * "From zero to viral" — the five-step sticky process path (home).
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$steps = array(
	array( 'icon' => 'search', 'n' => 1 ),
	array( 'icon' => 'aperture', 'n' => 2 ),
	array( 'icon' => 'send', 'n' => 3 ),
	array( 'icon' => 'radio', 'n' => 4 ),
	array( 'icon' => 'megaphone', 'n' => 5 ),
);
$total = count( $steps );
?>
<section class="bs-section" style="border-top:1px solid var(--bs-line)">
	<div class="bs-zv-head">
		<div data-reveal>
			<?php bright_stars_eyebrow( bs_field( 'zv_eyebrow', 'zv.eyebrow' ) ); ?>
			<h2 class="bs-h2" style="font-size:46px"><?php echo esc_html( bs_field( 'zv_h', 'zv.h' ) ); ?></h2>
			<p class="bs-sub" style="max-width:640px;margin:14px auto 0"><?php echo esc_html( bs_field( 'zv_sub', 'zv.sub' ) ); ?></p>
		</div>
	</div>

	<div class="bs-pathwrap" data-pathwrap>
		<div class="bs-spine"><div class="bs-spine__fill" data-path-fill></div></div>

		<?php foreach ( $steps as $s ) : $n = $s['n']; ?>
			<div class="bs-step" data-step>
				<div class="bs-step__head">
					<div class="bs-step__no">&lt; <?php echo esc_html( sprintf( 'STEP %02d / %02d', $n, $total ) ); ?> &gt;</div>
					<h3 class="bs-step__title" data-step-title><?php echo esc_html( bs_field( 'zv' . $n . 't', 'zv' . $n . 't' ) ); ?></h3>
				</div>
				<div class="bs-step__body">
					<span class="bs-step__icon" data-reveal><?php echo bs_icon( $s['icon'], array( 'size' => 28 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<p class="bs-step__lead" data-reveal><?php echo esc_html( bs_field( 'zv' . $n . 'd', 'zv' . $n . 'd' ) ); ?></p>
					<p class="bs-step__cap" data-reveal><?php echo esc_html( bs_t( 'zv' . $n . 'x' ) ); ?></p>
					<div class="bs-step__list">
						<?php foreach ( array( 'a', 'b', 'c' ) as $idx => $letter ) : ?>
							<div class="row" data-reveal data-rev-delay="<?php echo esc_attr( number_format( $idx * 0.04, 2 ) ); ?>">
								<?php echo bs_icon( 'check', array( 'size' => 18, 'stroke' => 2.4 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<span><?php echo esc_html( bs_t( 'zv' . $n . $letter ) ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="bs-step__tail" aria-hidden="true"></div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
