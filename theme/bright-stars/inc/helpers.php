<?php
/**
 * Core helpers: language resolution, options access, translation, icons.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Languages enabled for the site (subset of en/ar/fa, in display order).
 *
 * @return string[]
 */
function bs_langs() {
	$all = array( 'en', 'ar', 'fa' );
	$opt = bs_opt( 'langs', $all );
	if ( is_array( $opt ) && $opt ) {
		$out = array_values( array_intersect( $all, $opt ) );
		if ( $out ) {
			return $out;
		}
	}
	return $all;
}

/**
 * Default language for first-time visitors.
 */
function bs_default_lang() {
	$d = bs_opt( 'default_lang', 'en' );
	return in_array( $d, array( 'en', 'ar', 'fa' ), true ) ? $d : 'en';
}

/**
 * Resolve the active language: ?lang= (whitelisted) > cookie > default.
 */
function bs_lang() {
	static $lang = null;
	if ( null !== $lang ) {
		return $lang;
	}
	$allowed = bs_langs();
	$candidate = '';
	if ( isset( $_GET['lang'] ) ) {
		$candidate = sanitize_key( wp_unslash( $_GET['lang'] ) );
	} elseif ( isset( $_COOKIE['bs_lang'] ) ) {
		$candidate = sanitize_key( wp_unslash( $_COOKIE['bs_lang'] ) );
	}
	if ( ! in_array( $candidate, $allowed, true ) ) {
		$candidate = bs_default_lang();
	}
	if ( ! in_array( $candidate, $allowed, true ) ) {
		$candidate = 'en';
	}
	$lang = $candidate;
	return $lang;
}

/**
 * Is the active (or given) language right-to-left?
 */
function bs_is_rtl_lang( $lang = null ) {
	$lang = $lang ? $lang : bs_lang();
	return in_array( $lang, array( 'ar', 'fa' ), true );
}

/**
 * Human label for a language code.
 */
function bs_lang_label( $lang ) {
	$labels = array( 'en' => 'EN', 'ar' => 'ع', 'fa' => 'فا' );
	return isset( $labels[ $lang ] ) ? $labels[ $lang ] : strtoupper( $lang );
}

/**
 * Full native name for a language code (used in the mobile menu).
 */
function bs_lang_name( $lang ) {
	$names = array( 'en' => 'English', 'ar' => 'العربية', 'fa' => 'فارسی' );
	return isset( $names[ $lang ] ) ? $names[ $lang ] : strtoupper( $lang );
}

/**
 * The whole option blob, read once.
 *
 * @return array
 */
function bs_options() {
	static $o = null;
	if ( null === $o ) {
		$o = get_option( 'bright_stars_options', array() );
		if ( ! is_array( $o ) ) {
			$o = array();
		}
	}
	return $o;
}

/**
 * Read a single theme option (non-translatable).
 */
function bs_opt( $key, $default = '' ) {
	$o = bs_options();
	if ( isset( $o[ $key ] ) && '' !== $o[ $key ] && null !== $o[ $key ] ) {
		return $o[ $key ];
	}
	return $default;
}

/**
 * Translate a dictionary key for the active (or given) language.
 * Admin panels can override any string through the {@see 'bs_t'} filter.
 */
function bs_t( $key, $lang = null ) {
	$lang = $lang ? $lang : bs_lang();
	$dict = bs_i18n_dict();
	if ( isset( $dict[ $lang ][ $key ] ) ) {
		$val = $dict[ $lang ][ $key ];
	} elseif ( isset( $dict['en'][ $key ] ) ) {
		$val = $dict['en'][ $key ];
	} else {
		$val = $key;
	}
	return apply_filters( 'bs_t', $val, $key, $lang );
}

/**
 * A translatable content field: admin option per-language, with the design
 * dictionary as the fallback so the front end is never empty.
 *
 * @param string $base     Option base, e.g. "hero_h1a" (stored as hero_h1a_en…).
 * @param string $i18n_key Dictionary key used when no admin value exists.
 */
function bs_field( $base, $i18n_key = '', $lang = null ) {
	$lang = $lang ? $lang : bs_lang();
	$o = bs_options();
	foreach ( array_unique( array( $lang, 'en' ) ) as $lg ) {
		$k = $base . '_' . $lg;
		if ( isset( $o[ $k ] ) && '' !== trim( (string) $o[ $k ] ) ) {
			return $o[ $k ];
		}
	}
	return $i18n_key ? bs_t( $i18n_key, $lang ) : '';
}

/**
 * A per-post translatable meta value (_bs_{base}_{lang}, falling back to _en).
 */
function bs_meta( $post_id, $base, $default = '', $lang = null ) {
	$lang = $lang ? $lang : bs_lang();
	foreach ( array_unique( array( $lang, 'en' ) ) as $lg ) {
		$v = get_post_meta( $post_id, '_bs_' . $base . '_' . $lg, true );
		if ( '' !== trim( (string) $v ) ) {
			return $v;
		}
	}
	return $default;
}

/**
 * Build a URL that switches the site to a given language (no-JS fallback).
 */
function bs_lang_url( $lang ) {
	return esc_url( add_query_arg( 'lang', $lang ) );
}

/**
 * The data-dir colour theme variant (orange | gold | pearl | emerald).
 */
function bs_theme_variant() {
	$v = bs_opt( 'theme_variant', 'orange' );
	return in_array( $v, array( 'orange', 'gold', 'pearl', 'emerald' ), true ) ? $v : 'orange';
}

/**
 * Inline SVG icon set (stroked, 24×24 viewBox, currentColor).
 *
 * @param string $name Icon key.
 * @param array  $args size, stroke, fill (bool), class.
 */
function bs_icon( $name, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'size'   => 22,
			'stroke' => 1.75,
			'fill'   => false,
			'class'  => '',
		)
	);

	$paths = array(
		'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
		'arrow-left'  => '<path d="M19 12H5"/><path d="m12 19-7-7 7-7"/>',
		'check'       => '<path d="M20 6 9 17l-5-5"/>',
		'search'      => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
		'target'      => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
		'share'       => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>',
		'pen'         => '<path d="m12 19 7-7 3 3-7 7-3-3z"/><path d="m18 13-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="m2 2 7.586 7.586"/><circle cx="11" cy="11" r="2"/>',
		'layout'      => '<rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/>',
		'compass'     => '<circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>',
		'aperture'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
		'send'        => '<path d="M20.2 6 3 11l-.9-2.4c-.3-1 .3-2 1.3-2.3l13.5-4c1-.3 2 .3 2.3 1.3z"/><path d="M3 11h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="m9 11 2 4M14 9.5l2 4"/>',
		'radio'       => '<path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9"/><path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5"/><circle cx="12" cy="12" r="2"/><path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5"/><path d="M19.1 4.9C23 8.8 23 15.2 19.1 19.1"/>',
		'megaphone'   => '<path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>',
		'pin'         => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
		'clock'       => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'menu'        => '<line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/>',
		'close'       => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
		'mail'        => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
		'phone'       => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'instagram'   => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
		'whatsapp'    => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8z"/>',
		'play'        => '<path d="M8 5v14l11-7z"/>',
		'quote'       => '<path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/>',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	$size    = (int) $args['size'];
	$classes = trim( 'bs-icon ' . $args['class'] );

	if ( $args['fill'] ) {
		return sprintf(
			'<svg class="%s" viewBox="0 0 24 24" width="%d" height="%d" fill="currentColor" aria-hidden="true" focusable="false">%s</svg>',
			esc_attr( $classes ),
			$size,
			$size,
			$paths[ $name ]
		);
	}

	return sprintf(
		'<svg class="%s" viewBox="0 0 24 24" width="%d" height="%d" fill="none" stroke="currentColor" stroke-width="%s" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%s</svg>',
		esc_attr( $classes ),
		$size,
		$size,
		esc_attr( $args['stroke'] ),
		$paths[ $name ]
	);
}

/**
 * Convenience: an asset URL inside the theme.
 */
function bs_asset( $rel ) {
	return BRIGHT_STARS_URI . '/assets/' . ltrim( $rel, '/' );
}

/**
 * Resolve a stored logo: a media attachment URL set in options, else the
 * bundled brand mark.
 *
 * @param string $variant color|white
 */
function bs_logo_url( $variant = 'color' ) {
	$key = 'white' === $variant ? 'logo_white' : 'logo_color';
	$id  = bs_opt( $key );
	if ( $id ) {
		$url = wp_get_attachment_image_url( (int) $id, 'full' );
		if ( $url ) {
			return $url;
		}
	}
	$file = 'white' === $variant ? 'logo-mark-white.png' : 'logo-mark-color.png';
	return bs_asset( 'img/' . $file );
}

/**
 * The brand name shown in the header/footer.
 */
function bs_brand_name() {
	$name = bs_opt( 'brand_name' );
	return $name ? $name : 'Bright Starts';
}

/**
 * Get the WordPress page URL for a logical route, falling back to a hash.
 *
 * @param string $route home|services|clients|about|pricing|blog|contact
 */
function bs_route_url( $route ) {
	$map = bs_opt( 'route_pages', array() );
	if ( is_array( $map ) && ! empty( $map[ $route ] ) ) {
		$url = get_permalink( (int) $map[ $route ] );
		if ( $url ) {
			return $url;
		}
	}
	if ( 'home' === $route ) {
		return home_url( '/' );
	}
	if ( 'blog' === $route ) {
		$posts_page = (int) get_option( 'page_for_posts' );
		if ( $posts_page ) {
			return get_permalink( $posts_page );
		}
	}
	// Last resort: a guessed pretty permalink.
	return home_url( '/' . $route . '/' );
}
