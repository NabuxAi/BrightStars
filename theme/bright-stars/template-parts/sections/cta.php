<?php
/**
 * Contact / final CTA with an AJAX enquiry form.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = array( 'f.svc1', 'f.svc2', 'f.svc3', 'f.svc4', 'f.svc5', 'f.svc6' );
$budgets  = array( 'f.b1', 'f.b2', 'f.b3', 'f.b4' );
?>
<section class="bs-section bs-pad" id="contact" style="max-width:var(--maxw);margin:0 auto;padding-top:100px;padding-bottom:96px">
	<div class="bs-cta" data-reveal>
		<span class="bs-cta__c1" aria-hidden="true"></span>
		<span class="bs-cta__c2" aria-hidden="true"></span>
		<div class="bs-cta__inner">
			<?php bright_stars_eyebrow( bs_t( 'cta.eyebrow' ) ); ?>
			<h2 class="bs-cta__h"><?php echo esc_html( bs_field( 'cta_h', 'cta.h' ) ); ?></h2>
			<p class="bs-cta__sub"><?php echo esc_html( bs_field( 'cta_sub', 'cta.sub' ) ); ?></p>

			<form class="bs-form" data-lead-form novalidate>
				<div class="bs-form__row">
					<input type="text" name="bs_name" placeholder="<?php echo esc_attr( bs_t( 'f.name' ) ); ?>" autocomplete="name">
					<input type="text" name="bs_brand" placeholder="<?php echo esc_attr( bs_t( 'f.brand' ) ); ?>" autocomplete="organization">
				</div>
				<div class="bs-form__row">
					<input type="email" name="bs_email" placeholder="<?php echo esc_attr( bs_t( 'f.email' ) ); ?>" autocomplete="email">
					<input type="text" name="bs_phone" placeholder="<?php echo esc_attr( bs_t( 'f.phone' ) ); ?>" autocomplete="tel">
				</div>
				<div class="bs-form__row">
					<select name="bs_service">
						<option value=""><?php echo esc_html( bs_t( 'f.service' ) ); ?></option>
						<?php foreach ( $services as $s ) : ?>
							<option value="<?php echo esc_attr( bs_t( $s ) ); ?>"><?php echo esc_html( bs_t( $s ) ); ?></option>
						<?php endforeach; ?>
					</select>
					<select name="bs_budget">
						<option value=""><?php echo esc_html( bs_t( 'f.budget' ) ); ?></option>
						<?php foreach ( $budgets as $b ) : ?>
							<option value="<?php echo esc_attr( bs_t( $b ) ); ?>"><?php echo esc_html( bs_t( $b ) ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<textarea name="bs_message" rows="3" placeholder="<?php echo esc_attr( bs_t( 'f.msg' ) ); ?>"></textarea>

				<!-- honeypot -->
				<input type="text" name="bs_website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px" aria-hidden="true">

				<div class="bs-form__err" data-lead-err role="alert"></div>

				<button type="submit" class="bs-btn bs-btn--primary">
					<span><?php echo esc_html( bs_t( 'f.send' ) ); ?></span>
					<?php echo bs_icon( 'arrow-right', array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</button>
			</form>

			<div class="bs-form__ok" data-lead-ok hidden>
				<span class="ic"><?php echo bs_icon( 'check', array( 'size' => 26, 'stroke' => 2.2 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div>
					<div class="h"><?php echo esc_html( bs_t( 'f.thanksH' ) ); ?></div>
					<div class="s"><?php echo esc_html( bs_t( 'f.thanksSub' ) ); ?></div>
				</div>
			</div>
		</div>
	</div>
</section>
