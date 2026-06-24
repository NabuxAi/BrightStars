<?php
/**
 * Reusable markup helpers used across templates.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The logical routes shown in the primary/footer navigation.
 *
 * @return array<int,array{route:string,label:string,url:string,current:bool}>
 */
function bright_stars_nav_items() {
	$routes  = array( 'home', 'services', 'clients', 'about', 'pricing', 'blog', 'contact' );
	$map     = bs_opt( 'route_pages', array() );
	$current = get_queried_object_id();
	$items   = array();

	foreach ( $routes as $route ) {
		$is_current = false;

		if ( 'home' === $route ) {
			$is_current = is_front_page();
		} elseif ( 'blog' === $route ) {
			$is_current = ( is_home() && ! is_front_page() ) || is_singular( 'post' ) || is_category() || is_tag() || is_author() || is_date();
		} elseif ( 'clients' === $route ) {
			$is_current = is_post_type_archive( 'bs_client' ) || is_singular( 'bs_client' );
			if ( ! $is_current && is_array( $map ) && ! empty( $map[ $route ] ) ) {
				$is_current = ( (int) $map[ $route ] === (int) $current );
			}
		} else {
			if ( is_array( $map ) && ! empty( $map[ $route ] ) ) {
				$is_current = ( (int) $map[ $route ] === (int) $current );
			}
		}

		$items[] = array(
			'route'   => $route,
			'label'   => bs_t( 'nav.' . $route ),
			'url'     => bs_route_url( $route ),
			'current' => $is_current,
		);
	}

	return $items;
}

/**
 * Render the EN / AR / FA language switcher.
 *
 * @param string $variant desktop|mobile
 */
function bright_stars_lang_switcher( $variant = 'desktop' ) {
	$langs = bs_langs();
	if ( count( $langs ) < 2 ) {
		return;
	}
	$active = bs_lang();

	if ( 'mobile' === $variant ) {
		echo '<div class="bs-mobile__langs">';
		foreach ( $langs as $lg ) {
			printf(
				'<a href="%s" data-lang="%s" data-keep class="%s">%s</a>',
				esc_url( bs_lang_url( $lg ) ),
				esc_attr( $lg ),
				$lg === $active ? 'is-active' : '',
				esc_html( bs_lang_name( $lg ) )
			);
		}
		echo '</div>';
		return;
	}

	echo '<div class="bs-langsw" role="group" aria-label="' . esc_attr( bs_t( 'ui.lang' ) ) . '">';
	foreach ( $langs as $lg ) {
		printf(
			'<a href="%s" data-lang="%s" class="lang-%s %s">%s</a>',
			esc_url( bs_lang_url( $lg ) ),
			esc_attr( $lg ),
			esc_attr( $lg ),
			$lg === $active ? 'is-active' : '',
			esc_html( bs_lang_label( $lg ) )
		);
	}
	echo '</div>';
}

/**
 * Echo the framed "< eyebrow >" label, optionally with an Arabic accent line.
 *
 * @param string $text       The eyebrow text (already translated).
 * @param string $accent_alt Optional secondary accent (e.g. Arabic phrase).
 */
function bright_stars_eyebrow( $text, $accent_alt = '' ) {
	echo '<div class="bs-eyebrow"><span class="bs-br">&lt;</span> <span>' . esc_html( $text ) . '</span>';
	if ( $accent_alt ) {
		echo ' <span class="bs-accent-alt">' . esc_html( $accent_alt ) . '</span>';
	}
	echo ' <span class="bs-br">&gt;</span></div>';
}

/**
 * Render a centered section header (eyebrow + h2 + optional sub).
 */
function bright_stars_section_header( $eyebrow_key, $h_key, $sub_key = '', $h_base = '', $sub_base = '' ) {
	echo '<div class="bs-center" data-reveal style="margin-bottom:34px">';
	bright_stars_eyebrow( bs_t( $eyebrow_key ) );
	echo '<h2 class="bs-h2">' . esc_html( $h_base ? bs_field( $h_base, $h_key ) : bs_t( $h_key ) ) . '</h2>';
	if ( $sub_key ) {
		echo '<p class="bs-sub" style="max-width:640px;margin:14px auto 0">' . esc_html( $sub_base ? bs_field( $sub_base, $sub_key ) : bs_t( $sub_key ) ) . '</p>';
	}
	echo '</div>';
}

/**
 * Output a section template part with a wrapper id/classes.
 *
 * @param string $name Section slug under template-parts/sections/.
 */
function bright_stars_section( $name ) {
	get_template_part( 'template-parts/sections/' . $name );
}

/**
 * Split a textarea value into trimmed, non-empty lines.
 *
 * @param string $text Raw multiline string.
 * @return string[]
 */
function bs_lines( $text ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $text );
	return array_values( array_filter( array_map( 'trim', $lines ), 'strlen' ) );
}

/**
 * Split a single "left | right" line into its two parts.
 *
 * @param string $line Raw line.
 * @param string $sep  Separator character.
 * @return array{0:string,1:string} [left, right] (right is '' when absent).
 */
function bs_pair( $line, $sep = '|' ) {
	$parts = array_map( 'trim', explode( $sep, (string) $line, 2 ) );
	return array( $parts[0], isset( $parts[1] ) ? $parts[1] : '' );
}

/**
 * Placeholder posts (trilingual) used when no real posts exist yet.
 *
 * @param int $limit Number to return.
 * @return array
 */
function bright_stars_demo_posts( $limit = 6 ) {
	$posts = array(
		array(
			'cat'   => array( 'en' => 'Case study', 'ar' => 'دراسة حالة', 'fa' => 'مطالعه موردی' ),
			'title' => array( 'en' => 'How a local brand hit 1M views in 30 days', 'ar' => 'كيف حقّقت علامة محلية مليون مشاهدة في 30 يوماً', 'fa' => 'چطور یک برند محلی در ۳۰ روز به ۱ میلیون بازدید رسید' ),
			'date'  => 'Jun 2026', 'read' => array( 'en' => '6 min read', 'ar' => '6 دقائق', 'fa' => '۶ دقیقه' ),
		),
		array(
			'cat'   => array( 'en' => 'Content', 'ar' => 'محتوى', 'fa' => 'محتوا' ),
			'title' => array( 'en' => 'The anatomy of a scroll-stopping reel', 'ar' => 'تشريح ريل يوقف التمرير', 'fa' => 'کالبدشکافی یک ریل که اسکرول را متوقف می‌کند' ),
			'date'  => 'May 2026', 'read' => array( 'en' => '5 min read', 'ar' => '5 دقائق', 'fa' => '۵ دقیقه' ),
		),
		array(
			'cat'   => array( 'en' => 'Strategy', 'ar' => 'استراتيجية', 'fa' => 'استراتژی' ),
			'title' => array( 'en' => 'From zero followers to a full waitlist', 'ar' => 'من صفر متابع إلى قائمة انتظار كاملة', 'fa' => 'از صفر فالوور تا یک لیست انتظار کامل' ),
			'date'  => 'May 2026', 'read' => array( 'en' => '7 min read', 'ar' => '7 دقائق', 'fa' => '۷ دقیقه' ),
		),
		array(
			'cat'   => array( 'en' => 'Production', 'ar' => 'إنتاج', 'fa' => 'تولید' ),
			'title' => array( 'en' => 'Lighting & framing for premium brand video', 'ar' => 'الإضاءة والتأطير لفيديو علامة فاخر', 'fa' => 'نورپردازی و قاب‌بندی برای ویدیوی لوکس برند' ),
			'date'  => 'Apr 2026', 'read' => array( 'en' => '8 min read', 'ar' => '8 دقائق', 'fa' => '۸ دقیقه' ),
		),
		array(
			'cat'   => array( 'en' => 'Content', 'ar' => 'محتوى', 'fa' => 'محتوا' ),
			'title' => array( 'en' => 'Why your first three seconds decide everything', 'ar' => 'لماذا تحسم أول ثلاث ثوانٍ كل شيء', 'fa' => 'چرا سه ثانیهٔ اول همه‌چیز را تعیین می‌کند' ),
			'date'  => 'Apr 2026', 'read' => array( 'en' => '4 min read', 'ar' => '4 دقائق', 'fa' => '۴ دقیقه' ),
		),
		array(
			'cat'   => array( 'en' => 'Paid media', 'ar' => 'إعلانات مدفوعة', 'fa' => 'تبلیغات پولی' ),
			'title' => array( 'en' => 'Turning UGC into a paid-media engine', 'ar' => 'تحويل محتوى المستخدمين إلى محرك إعلانات', 'fa' => 'تبدیل UGC به موتور تبلیغات پولی' ),
			'date'  => 'Mar 2026', 'read' => array( 'en' => '6 min read', 'ar' => '6 دقائق', 'fa' => '۶ دقیقه' ),
		),
	);
	return array_slice( $posts, 0, $limit );
}

/**
 * A small CTA band (link only) for the foot of inner pages.
 */
function bright_stars_cta_band() {
	?>
	<section class="bs-section bs-pad" style="max-width:var(--maxw);margin:0 auto;padding-top:40px;padding-bottom:90px">
		<div class="bs-cta" data-reveal style="text-align:center">
			<span class="bs-cta__c1" aria-hidden="true"></span>
			<span class="bs-cta__c2" aria-hidden="true"></span>
			<div style="position:relative">
				<h2 class="bs-cta__h" style="font-size:40px"><?php echo esc_html( bs_field( 'cta_h', 'cta.h' ) ); ?></h2>
				<p class="bs-cta__sub" style="margin:14px auto 24px;max-width:560px"><?php echo esc_html( bs_field( 'cta_sub', 'cta.sub' ) ); ?></p>
				<a class="bs-btn bs-btn--primary bs-btn--lg" href="<?php echo esc_url( bs_route_url( 'contact' ) ); ?>" style="margin:0 auto">
					<span><?php echo esc_html( bs_t( 'nav.start' ) ); ?></span>
					<?php echo bs_icon( 'arrow-right', array( 'size' => 18 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</div>
		</div>
	</section>
	<?php
}
