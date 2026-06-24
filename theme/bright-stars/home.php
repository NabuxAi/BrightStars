<?php
/**
 * Blog index (posts page).
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$lang = bs_lang();
?>
<section class="bs-section bs-pad" style="max-width:var(--maxw);margin:0 auto;padding-top:100px;padding-bottom:88px">
	<div class="bs-center" data-reveal style="margin-bottom:46px">
		<?php bright_stars_eyebrow( bs_t( 'bl.eyebrow' ) ); ?>
		<h1 class="bs-h2" style="font-size:48px;margin:14px 0 8px"><?php echo esc_html( bs_field( 'bl_h2', 'bl.h2' ) ); ?></h1>
		<p class="bs-sub" style="max-width:560px;margin:0 auto;font-size:16px"><?php echo esc_html( bs_field( 'bl_sub', 'bl.sub' ) ); ?></p>
	</div>

	<?php if ( have_posts() ) : ?>
		<div class="bs-grid-3" data-reveal>
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/post-card' );
			endwhile;
			?>
		</div>

		<div class="bs-pagination">
			<?php
			echo paginate_links(
				array(
					'prev_text' => '‹',
					'next_text' => '›',
				)
			);
			?>
		</div>
	<?php else : ?>
		<div class="bs-grid-3" data-reveal>
			<?php foreach ( bright_stars_demo_posts( 6 ) as $p ) : ?>
				<a class="bs-card" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>">
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
		</div>
	<?php endif; ?>
</section>
<?php
get_footer();
