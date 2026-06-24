<?php
/**
 * Generic page.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article class="bs-page" <?php post_class(); ?>>
		<div class="bs-page__head" data-reveal>
			<h1 class="bs-page__title" style="font-family:var(--font-display);text-transform:none;font-size:46px;font-weight:700;letter-spacing:-.02em"><?php the_title(); ?></h1>
		</div>
		<div class="bs-prose" data-reveal>
			<?php
			the_content();
			wp_link_pages( array( 'before' => '<div class="bs-pagination">', 'after' => '</div>' ) );
			?>
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

get_footer();
