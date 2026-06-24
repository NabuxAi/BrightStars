<?php
/**
 * A single post card (used in archives, search and the blog index).
 * Expects to run inside the loop.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cats = get_the_category();
$cat  = $cats ? $cats[0]->name : bs_t( 'bl.eyebrow' );
$mins = max( 1, (int) round( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
?>
<a class="bs-card" href="<?php the_permalink(); ?>">
	<div class="bs-card__media">
		<span class="bs-card__corner" aria-hidden="true"></span>
		<span class="bs-card__cat"><?php echo esc_html( $cat ); ?></span>
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'bs-card', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title() ) ) );
		} else {
			echo bs_icon( 'play', array( 'size' => 40 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
	</div>
	<div class="bs-card__body">
		<div class="bs-card__meta"><?php echo esc_html( get_the_date() ); ?> · <?php echo esc_html( sprintf( '%d min', $mins ) ); ?></div>
		<h3 class="bs-card__title"><?php the_title(); ?></h3>
		<span class="bs-card__more"><?php echo esc_html( bs_t( 'bl.read' ) ); ?> &gt;</span>
	</div>
</a>
