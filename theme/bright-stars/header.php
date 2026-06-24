<?php
/**
 * Site header: <head>, primary navigation, language switch, mobile menu.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="bs-no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="bs-skip-link" href="#bs-main"><?php esc_html_e( 'Skip to content', 'bright-stars' ); ?></a>

<div class="bs-site" data-dir="<?php echo esc_attr( bs_theme_variant() ); ?>">

	<div class="bs-lightpath" aria-hidden="true">
		<div class="bs-lightpath__fill" data-progress>
			<span class="bs-lightpath__tip" data-progress-tip></span>
		</div>
	</div>

	<header class="bs-header bs-pad">
		<a class="bs-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( bs_logo_url( 'color' ) ); ?>" alt="<?php echo esc_attr( bs_brand_name() ); ?>" width="34" height="34">
			<span class="bs-brand__txt">
				<span class="bs-brand__name"><?php echo esc_html( bs_brand_name() ); ?></span>
				<span class="bs-brand__loc"><?php echo esc_html( bs_opt( 'brand_location', 'Muscat · Oman' ) ); ?></span>
			</span>
		</a>

		<nav class="bs-nav" aria-label="<?php esc_attr_e( 'Primary', 'bright-stars' ); ?>">
			<?php foreach ( bright_stars_nav_items() as $item ) : ?>
				<a href="<?php echo esc_url( $item['url'] ); ?>"<?php echo $item['current'] ? ' class="current" aria-current="page"' : ''; ?>><?php echo esc_html( $item['label'] ); ?></a>
			<?php endforeach; ?>
		</nav>

		<div class="bs-nav-actions">
			<?php bright_stars_lang_switcher(); ?>
			<a class="bs-btn bs-btn--primary bs-btn--sm" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>"><?php echo esc_html( bs_t( 'nav.start' ) ); ?></a>
		</div>

		<button class="bs-burger" data-mobile-open aria-label="<?php echo esc_attr( bs_t( 'ui.menu' ) ); ?>" aria-expanded="false" aria-controls="bs-mobile">
			<?php echo bs_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</button>
	</header>

	<?php get_template_part( 'template-parts/mobile-menu' ); ?>

	<main id="bs-main">
