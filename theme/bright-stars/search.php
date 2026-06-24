<?php
/**
 * Search results.
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
		<h1 class="bs-h2">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Results for “%s”', 'bright-stars' ), '<span style="color:var(--bs-accent)">' . esc_html( get_search_query() ) . '</span>' );
			?>
		</h1>
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
		<p class="bs-sub bs-center"><?php esc_html_e( 'No results found. Try another search.', 'bright-stars' ); ?></p>
		<div class="bs-center" style="margin-top:24px"><?php get_search_form(); ?></div>
	<?php endif; ?>
</section>
<?php
get_footer();
