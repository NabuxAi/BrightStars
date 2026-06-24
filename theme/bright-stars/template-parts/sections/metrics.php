<?php
/**
 * Metrics band.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$metrics = array(
	array( 'num' => bs_opt( 'metric1_num', '+312%' ), 'label' => bs_t( 'mt1' ), 'accent' => true ),
	array( 'num' => bs_opt( 'metric2_num', '120+' ), 'label' => bs_t( 'mt2' ), 'accent' => false ),
	array( 'num' => bs_opt( 'metric3_num', '4.2x' ), 'label' => bs_t( 'mt3' ), 'accent' => false ),
	array( 'num' => bs_opt( 'metric4_num', '98%' ), 'label' => bs_t( 'mt4' ), 'accent' => false ),
);
?>
<section class="bs-section bs-section--panel">
	<div class="bs-container bs-pad" style="padding-top:64px;padding-bottom:64px">
		<div class="bs-center" data-reveal style="margin-bottom:44px">
			<?php bright_stars_eyebrow( bs_t( 'mt.eyebrow' ) ); ?>
			<h2 class="bs-h2" style="font-size:40px"><?php echo esc_html( bs_field( 'mt_h', 'mt.h' ) ); ?></h2>
		</div>
		<div class="bs-metrics" data-reveal data-rev-delay="0.08">
			<?php foreach ( $metrics as $m ) : ?>
				<div class="bs-metric">
					<div class="bs-metric__num <?php echo $m['accent'] ? 'accent' : ''; ?>"><?php echo esc_html( $m['num'] ); ?></div>
					<div class="bs-metric__lbl"><?php echo esc_html( $m['label'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
