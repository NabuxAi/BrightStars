<?php
/**
 * Path-based language routing for SEO-friendly multilingual URLs.
 *
 * The site serves three languages (en / ar / fa). English lives at the clean
 * permalink; Arabic and Persian are served under an /ar/ and /fa/ path prefix
 * (e.g. /service/web-app-design/  ->  /fa/service/web-app-design/). Each
 * language version is therefore a distinct, self-canonical, independently
 * indexable URL — which is what search engines need.
 *
 * Rather than registering a rewrite rule for every route, we strip a leading
 * /ar or /fa segment from the request on `init` (before WordPress parses it)
 * and remember the language, then localise every internal link so navigation
 * and crawling stay within the active language.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Languages that get a URL prefix — everything except the default (English).
 *
 * @return string[]
 */
function bs_prefixed_langs() {
	return array_values( array_diff( bs_langs(), array( bs_default_lang() ) ) );
}

/**
 * Detect and strip a leading /ar or /fa segment before WordPress routes the
 * request, so the rest of WP sees the clean (default-language) path.
 */
function bs_url_lang_boot() {
	if ( is_admin() ) {
		return;
	}
	$uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
	if ( '' === $uri ) {
		return;
	}
	$prefixed = bs_prefixed_langs();
	if ( ! $prefixed ) {
		return;
	}

	$parts = explode( '?', $uri, 2 );
	$path  = $parts[0];
	$qs    = isset( $parts[1] ) ? $parts[1] : '';

	// Support installs in a sub-directory (root install: $home_path is '').
	$home_path = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );
	$p         = ltrim( $path, '/' );
	if ( '' !== $home_path ) {
		if ( 0 === strpos( $p, $home_path . '/' ) ) {
			$p = substr( $p, strlen( $home_path ) + 1 );
		} elseif ( $p === $home_path ) {
			$p = '';
		}
	}

	$pattern = '#^(' . implode( '|', array_map( 'preg_quote', $prefixed ) ) . ')(?:/(.*))?$#';
	if ( preg_match( $pattern, $p, $m ) ) {
		$GLOBALS['bs_url_lang'] = $m[1];
		$rest                   = isset( $m[2] ) ? $m[2] : '';
		$newpath                = '/' . ( '' !== $home_path ? $home_path . '/' : '' ) . $rest;
		$_SERVER['REQUEST_URI'] = $newpath . ( '' !== $qs ? '?' . $qs : '' );
	}
}
add_action( 'init', 'bs_url_lang_boot', 0 );

/**
 * The language forced by the URL prefix for this request, if any.
 */
function bs_url_lang() {
	return ! empty( $GLOBALS['bs_url_lang'] ) ? $GLOBALS['bs_url_lang'] : '';
}

/**
 * Insert a language prefix into an internal URL. Default language, external
 * URLs and non-content paths are returned unchanged. Idempotent.
 *
 * @param string $url  Absolute URL.
 * @param string $lang Target language code.
 * @return string
 */
function bs_add_lang_prefix( $url, $lang ) {
	if ( ! $lang || $lang === bs_default_lang() || ! in_array( $lang, bs_langs(), true ) ) {
		return $url;
	}
	$home = home_url( '/' );
	if ( 0 !== strpos( (string) $url, $home ) ) {
		return $url; // External or non-home URL.
	}
	$rest = substr( $url, strlen( $home ) ); // Path (+ query) after the home root.

	// Already prefixed with any language, or a non-routable WP path: leave it.
	$prefixed = bs_prefixed_langs();
	if ( $prefixed ) {
		$skip = '#^(' . implode( '|', array_map( 'preg_quote', $prefixed ) ) . ')(/|$|\?)#';
		if ( preg_match( $skip, $rest ) ) {
			return $url;
		}
	}
	if ( preg_match( '#^(wp-admin|wp-login|wp-json|wp-content|wp-includes|xmlrpc|feed)#', $rest ) ) {
		return $url;
	}

	return $home . $lang . '/' . $rest;
}

/**
 * Remove a leading language prefix from an internal URL (giving the clean,
 * default-language URL). Used to derive the canonical base before building the
 * per-language alternates. Idempotent.
 */
function bs_strip_lang_prefix( $url ) {
	$home = home_url( '/' );
	if ( 0 !== strpos( (string) $url, $home ) ) {
		return $url;
	}
	$rest     = substr( $url, strlen( $home ) );
	$prefixed = bs_prefixed_langs();
	if ( $prefixed ) {
		$rest = preg_replace( '#^(' . implode( '|', array_map( 'preg_quote', $prefixed ) ) . ')(/|$)#', '', $rest, 1 );
	}
	return $home . ltrim( (string) $rest, '/' );
}

/**
 * Localise a URL to the currently active language (front-end only).
 */
function bs_localize_url( $url ) {
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return $url;
	}
	return bs_add_lang_prefix( $url, bs_lang() );
}

// Localise permalinks so every internal link stays inside the active language.
add_filter( 'page_link', 'bs_localize_url' );
add_filter( 'post_link', 'bs_localize_url' );
add_filter( 'post_type_link', 'bs_localize_url' );
add_filter( 'term_link', 'bs_localize_url' );
add_filter( 'post_type_archive_link', 'bs_localize_url' );
add_filter( 'get_pagenum_link', 'bs_localize_url' );

/**
 * We rewrite the request path on `init`, so WordPress's own canonical guess
 * would fight the language prefix. Disable it on prefixed (ar/fa) requests.
 */
function bs_disable_canonical_on_prefixed( $redirect_url ) {
	return bs_url_lang() ? false : $redirect_url;
}
add_filter( 'redirect_canonical', 'bs_disable_canonical_on_prefixed' );

/**
 * Permanently redirect legacy ?lang=ar|fa URLs to their pretty /ar|/fa form so
 * old links consolidate onto the new structure.
 */
function bs_redirect_legacy_lang() {
	if ( is_admin() || bs_url_lang() || empty( $_GET['lang'] ) ) {
		return;
	}
	$l     = sanitize_key( wp_unslash( $_GET['lang'] ) );
	$req   = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
	$clean = remove_query_arg( 'lang', $req );
	$target = home_url( $clean );
	if ( in_array( $l, bs_prefixed_langs(), true ) ) {
		$target = bs_add_lang_prefix( $target, $l );
	}
	wp_safe_redirect( $target, 301 );
	exit;
}
add_action( 'template_redirect', 'bs_redirect_legacy_lang', 1 );
