<?php
/**
 * Generic archive (category, tag, author, date).
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<section class="bs-section bs-pad" style="max-width:var(--maxw);margin:0 auto;padding-top:88px;padding-bottom:80px">
	<div class="bs-page__head" data-reveal style="text-align:center;margin-bottom:40px">
		<?php bright_stars_eyebrow( bs_t( 'bl.eyebrow' ) ); ?>
		<h1 class="bs-h2" style="margin-top:12px"><?php the_archive_title(); ?></h1>
		<?php
		$desc = get_the_archive_description();
		if ( $desc ) {
			echo '<div class="bs-sub" style="max-width:560px;margin:12px auto 0">' . wp_kses_post( $desc ) . '</div>';
		}
		?>
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
			<?php echo paginate_links( array( 'prev_text' => '‹', 'next_text' => '›' ) ); ?>
		</div>
	<?php else : ?>
		<p class="bs-sub bs-center"><?php esc_html_e( 'Nothing here yet.', 'bright-stars' ); ?></p>
	<?php endif; ?>
</section>
<?php
get_footer();
