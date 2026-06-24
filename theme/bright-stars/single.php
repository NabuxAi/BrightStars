<?php
/**
 * Single blog post.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	$cats = get_the_category();
	$cat  = $cats ? $cats[0]->name : '';
	$mins = max( 1, (int) round( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
	?>
	<article class="bs-page" <?php post_class(); ?>>
		<div class="bs-page__head" data-reveal>
			<div class="bs-article__meta">
				<?php
				echo esc_html( get_the_date() );
				if ( $cat ) {
					echo ' · ' . esc_html( $cat );
				}
				echo ' · ' . esc_html( sprintf( '%d min', $mins ) );
				?>
			</div>
			<h1 class="bs-page__title" style="font-family:var(--font-display);text-transform:none;font-size:44px;font-weight:700;letter-spacing:-.02em"><?php the_title(); ?></h1>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="bs-article__cover" data-reveal>
				<?php the_post_thumbnail( 'bs-wide', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
			</div>
		<?php endif; ?>

		<div class="bs-prose" data-reveal>
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="bs-pagination">',
					'after'  => '</div>',
				)
			);
			?>
		</div>

		<div style="margin-top:40px">
			<a class="bs-btn bs-btn--ghost bs-btn--sm" href="<?php echo esc_url( bs_route_url( 'blog' ) ); ?>">
				<?php echo bs_icon( bs_is_rtl_lang() ? 'arrow-right' : 'arrow-left', array( 'size' => 16 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( bs_t( 'ui.allposts' ) ); ?></span>
			</a>
		</div>

		<?php
		if ( comments_open() || get_comments_number() ) {
			echo '<div class="bs-prose" style="margin-top:48px">';
			comments_template();
			echo '</div>';
		}
		?>
	</article>
	<?php
endwhile;

bright_stars_cta_band();
get_footer();
