<?php
/**
 * Fallback template.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<section class="bs-section bs-pad" style="max-width:var(--maxw);margin:0 auto;padding-top:88px;padding-bottom:80px">
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
