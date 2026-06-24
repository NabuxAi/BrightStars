<?php
/**
 * Single client — case study.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	$logo    = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium' ) : get_post_meta( get_the_ID(), '_bs_logo', true );
	$cat     = bs_meta( get_the_ID(), 'category' );
	$metric  = bs_meta( get_the_ID(), 'metric' );
	$website = get_post_meta( get_the_ID(), '_bs_website', true );
	?>
	<article class="bs-page bs-page--wide" <?php post_class(); ?>>
		<div class="bs-page__head" data-reveal style="display:flex;align-items:center;gap:20px;flex-wrap:wrap">
			<?php if ( $logo ) : ?>
				<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" width="76" height="76" style="width:76px;height:76px;border-radius:16px;object-fit:cover;border:1px solid var(--bs-line)">
			<?php endif; ?>
			<div>
				<?php if ( $cat ) : ?><div class="bs-article__meta"><?php echo esc_html( $cat ); ?></div><?php endif; ?>
				<h1 class="bs-page__title" style="font-size:48px;margin-top:8px"><?php the_title(); ?></h1>
			</div>
		</div>

		<?php if ( $metric ) : ?>
			<div data-reveal style="margin:8px 0 24px">
				<span style="font-family:var(--font-hero);font-weight:800;font-size:44px;color:var(--bs-accent)"><?php echo esc_html( $metric ); ?></span>
			</div>
		<?php endif; ?>

		<?php if ( trim( get_the_content() ) ) : ?>
			<div class="bs-prose" data-reveal><?php the_content(); ?></div>
		<?php endif; ?>

		<div style="margin-top:32px;display:flex;gap:12px;flex-wrap:wrap">
			<?php if ( $website ) : ?>
				<a class="bs-btn bs-btn--primary bs-btn--sm" href="<?php echo esc_url( $website ); ?>" target="_blank" rel="noopener">
					<span><?php echo esc_html( get_the_title() ); ?></span>
					<?php echo bs_icon( 'arrow-right', array( 'size' => 16 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			<?php endif; ?>
			<a class="bs-btn bs-btn--ghost bs-btn--sm" href="<?php echo esc_url( bs_route_url( 'clients' ) ); ?>">
				<?php echo bs_icon( bs_is_rtl_lang() ? 'arrow-right' : 'arrow-left', array( 'size' => 16 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( bs_t( 'nav.clients' ) ); ?></span>
			</a>
		</div>
	</article>
	<?php
endwhile;

bright_stars_cta_band();
get_footer();
