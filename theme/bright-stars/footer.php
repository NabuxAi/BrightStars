<?php
/**
 * Site footer.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bs_email     = bs_opt( 'contact_email', 'info@brightstarsoman.com' );
$bs_phone     = bs_opt( 'contact_phone', '+968 79229343' );
$bs_address   = bs_field( 'contact_address', 'mp.addr' );
$bs_instagram = bs_opt( 'instagram_handle', '@brightstarsoman' );
$bs_instagram_url = bs_opt( 'instagram_url', 'https://www.instagram.com/brightstarsoman/' );
?>
	</main><!-- #bs-main -->

	<footer class="bs-footer">
		<div class="bs-footer__top">
			<div class="bs-footer__brand">
				<span class="name">
					<img src="<?php echo esc_url( bs_logo_url( 'color' ) ); ?>" alt="<?php echo esc_attr( bs_brand_name() ); ?>" width="30" height="30">
					<span><?php echo esc_html( bs_brand_name() ); ?></span>
				</span>
				<p class="bs-footer__tag"><?php echo esc_html( bs_field( 'footer_tag', 'ft.tag' ) ); ?></p>
			</div>

			<div class="bs-footer__cols">
				<div class="bs-footer__col">
					<h4><?php echo esc_html( bs_t( 'ft.services' ) ); ?></h4>
					<ul>
						<?php
						$bs_services = bright_stars_get_items( 'bs_service', 4 );
						if ( $bs_services ) :
							foreach ( $bs_services as $bs_s ) :
								?>
								<li><a href="<?php echo esc_url( bs_route_url( 'services' ) ); ?>"><?php echo esc_html( bs_meta( $bs_s->ID, 'title', get_the_title( $bs_s ) ) ); ?></a></li>
								<?php
							endforeach;
						else :
							foreach ( array( 'sv1t', 'sv2t', 'sv3t', 'sv5t' ) as $bs_k ) :
								?>
								<li><a href="<?php echo esc_url( bs_route_url( 'services' ) ); ?>"><?php echo esc_html( bs_t( $bs_k ) ); ?></a></li>
								<?php
							endforeach;
						endif;
						?>
					</ul>
				</div>
				<div class="bs-footer__col">
					<h4><?php echo esc_html( bs_t( 'ft.agency' ) ); ?></h4>
					<ul>
						<li><a href="<?php echo esc_url( bs_route_url( 'clients' ) ); ?>"><?php echo esc_html( bs_t( 'nav.clients' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( bs_route_url( 'about' ) ); ?>"><?php echo esc_html( bs_t( 'nav.about' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( bs_route_url( 'pricing' ) ); ?>"><?php echo esc_html( bs_t( 'nav.pricing' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( bs_route_url( 'blog' ) ); ?>"><?php echo esc_html( bs_t( 'nav.blog' ) ); ?></a></li>
					</ul>
				</div>
				<div class="bs-footer__col">
					<h4><?php echo esc_html( bs_t( 'ft.contact' ) ); ?></h4>
					<ul>
						<li><a href="mailto:<?php echo esc_attr( $bs_email ); ?>"><?php echo esc_html( $bs_email ); ?></a></li>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $bs_phone ) ); ?>"><?php echo esc_html( $bs_phone ); ?></a></li>
						<?php if ( $bs_instagram ) : ?>
							<li><a href="<?php echo esc_url( $bs_instagram_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $bs_instagram ); ?></a></li>
						<?php endif; ?>
						<li><span><?php echo esc_html( $bs_address ); ?></span></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="bs-footer__bottom">
			<span><?php echo esc_html( bs_field( 'footer_copy', 'ft.copy' ) ); ?></span>
			<span><?php echo esc_html( bs_field( 'footer_legal', 'ft.legal' ) ); ?></span>
		</div>
	</footer>

</div><!-- .bs-site -->

<?php wp_footer(); ?>
</body>
</html>
