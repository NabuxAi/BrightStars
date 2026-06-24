<?php
/**
 * "From the studio" — latest posts teaser (home). Falls back to placeholder
 * cards so the homepage looks complete before any posts are published.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lang  = bs_lang();
$posts = get_posts( array( 'numberposts' => 3, 'post_status' => 'publish' ) );
?>
<section class="bs-section bs-section--panel">
	<div class="bs-container bs-pad" style="padding-top:72px;padding-bottom:72px">
		<div class="bs-blog-head" data-reveal>
			<div>
				<?php bright_stars_eyebrow( bs_t( 'bl.eyebrow' ) ); ?>
				<h2 class="bs-h2" style="font-size:42px"><?php echo esc_html( bs_field( 'bl_h', 'bl.h' ) ); ?></h2>
			</div>
			<a class="bs-btn bs-btn--ghost bs-btn--sm" href="<?php echo esc_url( bs_route_url( 'blog' ) ); ?>">
				<span><?php echo esc_html( bs_t( 'bl.all' ) ); ?></span>
				<?php echo bs_icon( 'arrow-right', array( 'size' => 16 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		</div>

		<div class="bs-grid-3" data-reveal data-rev-delay="0.06">
			<?php if ( $posts ) : ?>
				<?php
				foreach ( $posts as $p ) :
					$cats = get_the_category( $p->ID );
					$cat  = $cats ? $cats[0]->name : bs_t( 'bl.eyebrow' );
					$mins = max( 1, (int) round( str_word_count( wp_strip_all_tags( $p->post_content ) ) / 200 ) );
					?>
					<a class="bs-card" href="<?php echo esc_url( get_permalink( $p ) ); ?>">
						<div class="bs-card__media">
							<span class="bs-card__corner" aria-hidden="true"></span>
							<span class="bs-card__cat"><?php echo esc_html( $cat ); ?></span>
							<?php if ( has_post_thumbnail( $p ) ) : ?>
								<?php echo get_the_post_thumbnail( $p, 'bs-card', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title( $p ) ) ) ); ?>
							<?php endif; ?>
						</div>
						<div class="bs-card__body">
							<div class="bs-card__meta"><?php echo esc_html( get_the_date( '', $p ) ); ?> · <?php echo esc_html( sprintf( '%d min', $mins ) ); ?></div>
							<h3 class="bs-card__title"><?php echo esc_html( get_the_title( $p ) ); ?></h3>
							<span class="bs-card__more"><?php echo esc_html( bs_t( 'bl.read' ) ); ?> &gt;</span>
						</div>
					</a>
				<?php endforeach; ?>
			<?php else : ?>
				<?php foreach ( bright_stars_demo_posts( 3 ) as $p ) : ?>
					<a class="bs-card" href="<?php echo esc_url( bs_route_url( 'blog' ) ); ?>">
						<div class="bs-card__media">
							<span class="bs-card__corner" aria-hidden="true"></span>
							<span class="bs-card__cat"><?php echo esc_html( $p['cat'][ $lang ] ?? $p['cat']['en'] ); ?></span>
							<?php echo bs_icon( 'play', array( 'size' => 40 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<div class="bs-card__body">
							<div class="bs-card__meta"><?php echo esc_html( $p['date'] ); ?> · <?php echo esc_html( $p['read'][ $lang ] ?? $p['read']['en'] ); ?></div>
							<h3 class="bs-card__title"><?php echo esc_html( $p['title'][ $lang ] ?? $p['title']['en'] ); ?></h3>
							<span class="bs-card__more"><?php echo esc_html( bs_t( 'bl.read' ) ); ?> &gt;</span>
						</div>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
