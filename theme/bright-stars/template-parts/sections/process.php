<?php
/**
 * "How we work" — four-step process.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="bs-section bs-pad" id="process" style="max-width:var(--maxw);margin:0 auto;padding-top:84px;padding-bottom:84px">
	<div class="bs-center" data-reveal style="margin-bottom:16px">
		<?php bright_stars_eyebrow( bs_t( 'pr.eyebrow' ) ); ?>
	</div>
	<h2 class="bs-h2 bs-center" data-reveal style="margin:0 0 50px"><?php echo esc_html( bs_field( 'pr_h', 'pr.h' ) ); ?></h2>

	<div class="bs-process">
		<?php for ( $n = 1; $n <= 4; $n++ ) : ?>
			<div class="bs-process__col" data-reveal data-rev-delay="<?php echo esc_attr( number_format( ( $n - 1 ) * 0.07, 2 ) ); ?>">
				<div class="bs-process__no">
					<i></i><span><?php echo esc_html( sprintf( '%02d', $n ) ); ?></span>
				</div>
				<h3 class="bs-process__title"><?php echo esc_html( bs_field( 'pr' . $n . 't', 'pr' . $n . 't' ) ); ?></h3>
				<p class="bs-process__desc"><?php echo esc_html( bs_field( 'pr' . $n . 'd', 'pr' . $n . 'd' ) ); ?></p>
			</div>
		<?php endfor; ?>
	</div>
</section>
