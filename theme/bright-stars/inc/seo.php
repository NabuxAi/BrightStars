<?php
/**
 * SEO: titles, meta description, canonical, hreflang, Open Graph, Twitter
 * cards and JSON-LD structured data. Each page also gets an optional SEO
 * title / description / noindex override.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ------------------------------------------------------------------ *
 * Per-object SEO meta box (pages, posts, clients).
 * ------------------------------------------------------------------ */

function bright_stars_seo_meta_box() {
	$types = array( 'page', 'post', 'bs_client', 'bs_service' );
	foreach ( $types as $t ) {
		add_meta_box( 'bs_seo', __( 'SEO — Bright Stars', 'bright-stars' ), 'bright_stars_seo_meta_box_render', $t, 'normal', 'default' );
	}
}
add_action( 'add_meta_boxes', 'bright_stars_seo_meta_box' );

function bright_stars_seo_meta_box_render( $post ) {
	wp_nonce_field( 'bright_stars_seo', 'bright_stars_seo_nonce' );
	$title    = get_post_meta( $post->ID, '_bs_seo_title', true );
	$desc     = get_post_meta( $post->ID, '_bs_seo_desc', true );
	$noindex  = get_post_meta( $post->ID, '_bs_seo_noindex', true );
	echo '<p><label style="font-weight:600;display:block;margin-bottom:4px">' . esc_html__( 'Meta title', 'bright-stars' ) . '</label>';
	printf( '<input type="text" name="_bs_seo_title" value="%s" style="width:100%%" maxlength="70" placeholder="%s" /></p>', esc_attr( $title ), esc_attr__( 'Defaults to the page title', 'bright-stars' ) );
	echo '<p><label style="font-weight:600;display:block;margin-bottom:4px">' . esc_html__( 'Meta description', 'bright-stars' ) . '</label>';
	printf( '<textarea name="_bs_seo_desc" rows="2" style="width:100%%" maxlength="180" placeholder="%s">%s</textarea></p>', esc_attr__( 'Shown in search results & social previews', 'bright-stars' ), esc_textarea( $desc ) );
	printf( '<p><label style="font-weight:400"><input type="checkbox" name="_bs_seo_noindex" value="1" %s /> %s</label></p>', checked( $noindex, '1', false ), esc_html__( 'Discourage search engines from indexing this page', 'bright-stars' ) );
}

function bright_stars_save_seo_meta( $post_id ) {
	if ( ! isset( $_POST['bright_stars_seo_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bright_stars_seo_nonce'] ) ), 'bright_stars_seo' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	update_post_meta( $post_id, '_bs_seo_title', isset( $_POST['_bs_seo_title'] ) ? sanitize_text_field( wp_unslash( $_POST['_bs_seo_title'] ) ) : '' );
	update_post_meta( $post_id, '_bs_seo_desc', isset( $_POST['_bs_seo_desc'] ) ? sanitize_text_field( wp_unslash( $_POST['_bs_seo_desc'] ) ) : '' );
	update_post_meta( $post_id, '_bs_seo_noindex', isset( $_POST['_bs_seo_noindex'] ) ? '1' : '' );
}
add_action( 'save_post', 'bright_stars_save_seo_meta' );

/* ------------------------------------------------------------------ *
 * Resolvers.
 * ------------------------------------------------------------------ */

/**
 * Canonical URL for the current view, without the language query arg.
 */
function bright_stars_canonical_url() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		$p = get_permalink();
		return $p ? $p : home_url( '/' );
	}
	if ( is_home() ) {
		$pid = (int) get_option( 'page_for_posts' );
		return $pid ? get_permalink( $pid ) : home_url( '/' );
	}
	if ( is_post_type_archive() ) {
		$link = get_post_type_archive_link( get_query_var( 'post_type' ) );
		return $link ? $link : home_url( '/' );
	}
	$req = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/';
	$req = remove_query_arg( 'lang', $req );
	return home_url( $req );
}

/**
 * The best SEO title for the current view.
 */
function bright_stars_seo_title() {
	if ( is_singular() ) {
		$t = get_post_meta( get_the_ID(), '_bs_seo_title', true );
		if ( $t ) {
			return $t;
		}
	}
	return wp_get_document_title();
}

/**
 * The best meta description for the current view.
 */
function bright_stars_meta_description() {
	$desc = '';
	if ( is_singular() ) {
		$desc = get_post_meta( get_the_ID(), '_bs_seo_desc', true );
		if ( ! $desc ) {
			$post = get_post();
			if ( $post && has_excerpt( $post ) ) {
				$desc = get_the_excerpt( $post );
			} elseif ( $post ) {
				$desc = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
			}
		}
		// CPTs often have no body content — fall back to their own meta.
		if ( is_singular( 'bs_service' ) && '' === trim( (string) $desc ) ) {
			$desc = bs_meta( get_the_ID(), 'desc' );
			if ( '' === trim( (string) $desc ) ) {
				$desc = bs_meta( get_the_ID(), 'intro' );
			}
		}
		if ( is_singular( 'bs_client' ) && '' === trim( (string) $desc ) ) {
			$desc = bs_meta( get_the_ID(), 'tagline' );
			if ( '' === trim( (string) $desc ) ) {
				$desc = bs_meta( get_the_ID(), 'brief' );
			}
		}
	}
	if ( ! $desc && ( is_front_page() || is_home() ) ) {
		$desc = bs_field( 'seo_description', 'hero.sub' );
	}
	if ( ! $desc ) {
		$desc = get_bloginfo( 'description' );
	}
	$desc = trim( preg_replace( '/\s+/', ' ', (string) $desc ) );
	if ( mb_strlen( $desc ) > 160 ) {
		$desc = mb_substr( $desc, 0, 157 ) . '…';
	}
	return $desc;
}

/**
 * A representative image URL for sharing.
 */
function bright_stars_share_image() {
	if ( is_singular() && has_post_thumbnail() ) {
		$img = wp_get_attachment_image_url( get_post_thumbnail_id(), 'bs-wide' );
		if ( $img ) {
			return $img;
		}
	}
	$id = bs_opt( 'seo_og_image' );
	if ( $id ) {
		$img = wp_get_attachment_image_url( (int) $id, 'bs-wide' );
		if ( $img ) {
			return $img;
		}
	}
	return bs_logo_url( 'color' );
}

/* ------------------------------------------------------------------ *
 * Title tweaks.
 * ------------------------------------------------------------------ */

function bright_stars_document_title_parts( $parts ) {
	if ( is_singular() ) {
		$t = get_post_meta( get_the_ID(), '_bs_seo_title', true );
		if ( $t ) {
			$parts['title'] = $t;
		}
	}
	return $parts;
}
add_filter( 'document_title_parts', 'bright_stars_document_title_parts' );

/* ------------------------------------------------------------------ *
 * Head output.
 * ------------------------------------------------------------------ */

function bright_stars_seo_head() {
	$canonical = bright_stars_canonical_url();
	if ( function_exists( 'bs_strip_lang_prefix' ) ) {
		$canonical = bs_strip_lang_prefix( $canonical ); // Always the clean / default-language base.
	}
	$desc      = bright_stars_meta_description();
	$image     = bright_stars_share_image();
	$title     = bright_stars_seo_title();
	$locale    = array( 'en' => 'en_US', 'ar' => 'ar_AR', 'fa' => 'fa_IR' );
	$cur       = bs_lang();

	echo "\n<!-- Bright Stars SEO -->\n";

	// Robots.
	if ( is_singular() && '1' === get_post_meta( get_the_ID(), '_bs_seo_noindex', true ) ) {
		echo '<meta name="robots" content="noindex,follow">' . "\n";
	}

	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	$self = function_exists( 'bs_add_lang_prefix' ) ? bs_add_lang_prefix( $canonical, $cur ) : $canonical;
	echo '<link rel="canonical" href="' . esc_url( $self ) . '">' . "\n";

	// hreflang alternates (path-based: en clean, ar -> /ar/, fa -> /fa/).
	foreach ( bs_langs() as $lg ) {
		$alt = function_exists( 'bs_add_lang_prefix' ) ? bs_add_lang_prefix( $canonical, $lg ) : $canonical;
		echo '<link rel="alternate" hreflang="' . esc_attr( $lg ) . '" href="' . esc_url( $alt ) . '">' . "\n";
	}
	echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $canonical ) . '">' . "\n";

	// Open Graph.
	echo '<meta property="og:site_name" content="' . esc_attr( bs_brand_name() ) . '">' . "\n";
	echo '<meta property="og:type" content="' . ( is_singular( 'post' ) ? 'article' : 'website' ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $desc ) {
		echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	echo '<meta property="og:url" content="' . esc_url( $self ) . '">' . "\n";
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	}
	echo '<meta property="og:locale" content="' . esc_attr( isset( $locale[ $cur ] ) ? $locale[ $cur ] : 'en_US' ) . '">' . "\n";
	foreach ( bs_langs() as $lg ) {
		if ( $lg !== $cur && isset( $locale[ $lg ] ) ) {
			echo '<meta property="og:locale:alternate" content="' . esc_attr( $locale[ $lg ] ) . '">' . "\n";
		}
	}

	// Twitter.
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $desc ) {
		echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	if ( $image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
	}

	bright_stars_json_ld( $self, $desc, $image );
	echo "<!-- /Bright Stars SEO -->\n";
}
add_action( 'wp_head', 'bright_stars_seo_head', 1 );

/**
 * JSON-LD structured data graph.
 */
function bright_stars_json_ld( $canonical, $desc, $image ) {
	$home   = home_url( '/' );
	$name   = bs_brand_name();
	$phone  = bs_opt( 'contact_phone', '+968 79229343' );
	$email  = bs_opt( 'contact_email', 'info@brightstarsoman.com' );
	$logo   = bs_logo_url( 'color' );
	$same   = array_filter(
		array(
			bs_opt( 'instagram_url', 'https://www.instagram.com/brightstarsoman/' ),
			bs_opt( 'instagram_url_2' ),
			bs_opt( 'facebook_url' ),
			bs_opt( 'linkedin_url' ),
		)
	);

	$graph = array();

	$org = array(
		'@type'  => 'Organization',
		'@id'    => $home . '#organization',
		'name'   => $name,
		'url'    => $home,
		'logo'   => array( '@type' => 'ImageObject', 'url' => $logo ),
		'email'  => $email,
		'telephone' => $phone,
		'address' => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Muscat',
			'addressCountry'  => 'OM',
		),
	);
	if ( $same ) {
		$org['sameAs'] = array_values( $same );
	}
	$graph[] = $org;

	$graph[] = array(
		'@type'           => 'WebSite',
		'@id'             => $home . '#website',
		'url'             => $home,
		'name'            => $name,
		'inLanguage'      => bs_lang(),
		'publisher'       => array( '@id' => $home . '#organization' ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => $home . '?s={search_term_string}',
			),
			'query-input' => 'required name=search_term_string',
		),
	);

	if ( is_front_page() ) {
		$graph[] = array(
			'@type'       => 'LocalBusiness',
			'@id'         => $home . '#localbusiness',
			'name'        => $name,
			'image'       => $image,
			'url'         => $home,
			'telephone'   => $phone,
			'email'       => $email,
			'priceRange'  => 'OMR',
			'address'     => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => 'Muscat',
				'addressRegion'   => 'Muscat',
				'addressCountry'  => 'OM',
			),
			'areaServed'  => array( 'Oman', 'GCC', 'Gulf' ),
			'description' => $desc,
		);
	}

	if ( is_singular( 'bs_service' ) ) {
		$sid     = get_the_ID();
		$svcname = bs_meta( $sid, 'title', get_the_title() );
		$graph[] = array(
			'@type'       => 'Service',
			'@id'         => $canonical . '#service',
			'name'        => $svcname,
			'serviceType' => $svcname,
			'url'         => $canonical,
			'description' => $desc,
			'provider'    => array( '@id' => $home . '#organization' ),
			'areaServed'  => array( 'Oman', 'GCC', 'Gulf' ),
			'inLanguage'  => bs_lang(),
		);
	}

	if ( is_singular( 'post' ) ) {
		$graph[] = array(
			'@type'         => 'Article',
			'@id'           => $canonical . '#article',
			'headline'      => get_the_title(),
			'description'   => $desc,
			'datePublished' => get_the_date( 'c' ),
			'dateModified'  => get_the_modified_date( 'c' ),
			'author'        => array( '@type' => 'Person', 'name' => get_the_author() ),
			'publisher'     => array( '@id' => $home . '#organization' ),
			'mainEntityOfPage' => $canonical,
			'image'         => $image,
			'inLanguage'    => bs_lang(),
		);
	}

	// Breadcrumbs on inner pages.
	if ( ! is_front_page() && ( is_singular() || is_home() || is_post_type_archive() ) ) {
		$crumbs = array(
			array( '@type' => 'ListItem', 'position' => 1, 'name' => bs_t( 'nav.home' ), 'item' => $home ),
		);
		$title = is_singular() ? get_the_title() : wp_get_document_title();
		$crumbs[] = array( '@type' => 'ListItem', 'position' => 2, 'name' => $title, 'item' => $canonical );
		$graph[]  = array(
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $crumbs,
		);
	}

	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
