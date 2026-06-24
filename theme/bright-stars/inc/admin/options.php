<?php
/**
 * Settings schema, registration and sanitisation for the Bright Stars panel.
 * Everything lives in the single option `bright_stars_options`.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The full settings schema, grouped into tabs.
 *
 * Field types: text, textarea, url, email, number, checkbox, select,
 *              color, media, multicheck, i18n_text, i18n_textarea.
 *
 * @return array
 */
function bright_stars_settings_schema() {
	$variants = array(
		'orange'  => 'Orange (default · black canvas)',
		'gold'    => 'Gold (warm dark)',
		'pearl'   => 'Pearl (light)',
		'emerald' => 'Emerald (deep green)',
	);
	$lang_opts = array( 'en' => 'English', 'ar' => 'العربية (Arabic)', 'fa' => 'فارسی (Persian)' );

	return array(
		'general' => array(
			'label'  => __( 'General', 'bright-stars' ),
			'fields' => array(
				array( 'key' => 'brand_name', 'label' => 'Brand name', 'type' => 'text', 'default' => 'Bright Stars' ),
				array( 'key' => 'brand_location', 'label' => 'Location strapline', 'type' => 'text', 'default' => 'Muscat · Oman' ),
				array( 'key' => 'logo_color', 'label' => 'Logo (on dark)', 'type' => 'media', 'desc' => 'Shown in the header & footer. Defaults to the bundled mark.' ),
				array( 'key' => 'logo_white', 'label' => 'Logo (white / alt)', 'type' => 'media' ),
				array( 'key' => 'theme_variant', 'label' => 'Colour theme', 'type' => 'select', 'options' => $variants, 'default' => 'orange' ),
				array( 'key' => 'default_lang', 'label' => 'Default language', 'type' => 'select', 'options' => $lang_opts, 'default' => 'en' ),
				array( 'key' => 'langs', 'label' => 'Enabled languages', 'type' => 'multicheck', 'options' => $lang_opts, 'default' => array( 'en', 'ar', 'fa' ) ),
			),
		),
		'hero' => array(
			'label'  => __( 'Hero', 'bright-stars' ),
			'fields' => array(
				array( 'key' => 'hero_tag', 'label' => 'Eyebrow', 'type' => 'i18n_text', 'i18n' => 'hero.tag' ),
				array( 'key' => 'hero_h1a', 'label' => 'Headline — line 1', 'type' => 'i18n_text', 'i18n' => 'hero.h1a' ),
				array( 'key' => 'hero_h1b', 'label' => 'Headline — line 2 start', 'type' => 'i18n_text', 'i18n' => 'hero.h1b' ),
				array( 'key' => 'hero_brand', 'label' => 'Headline — accent word', 'type' => 'i18n_text', 'i18n' => 'hero.brand' ),
				array( 'key' => 'hero_sub', 'label' => 'Sub-headline', 'type' => 'i18n_textarea', 'i18n' => 'hero.sub' ),
				array( 'key' => 'stat1_num', 'label' => 'Stat 1 — value', 'type' => 'text', 'default' => '120+' ),
				array( 'key' => 'stat1_label', 'label' => 'Stat 1 — label', 'type' => 'i18n_text', 'i18n' => 'st.brands' ),
				array( 'key' => 'stat2_num', 'label' => 'Stat 2 — value', 'type' => 'text', 'default' => '8 yrs' ),
				array( 'key' => 'stat2_label', 'label' => 'Stat 2 — label', 'type' => 'i18n_text', 'i18n' => 'st.gulf' ),
				array( 'key' => 'stat3_num', 'label' => 'Stat 3 — value', 'type' => 'text', 'default' => '4.2x' ),
				array( 'key' => 'stat3_label', 'label' => 'Stat 3 — label', 'type' => 'i18n_text', 'i18n' => 'st.roas' ),
			),
		),
		'journey' => array(
			'label'  => __( 'Journey & Process', 'bright-stars' ),
			'fields' => array(
				array( 'desc' => '— "From zero to viral" path —', 'type' => 'note' ),
				array( 'key' => 'zv_eyebrow', 'label' => 'Eyebrow', 'type' => 'i18n_text', 'i18n' => 'zv.eyebrow' ),
				array( 'key' => 'zv_h', 'label' => 'Heading', 'type' => 'i18n_text', 'i18n' => 'zv.h' ),
				array( 'key' => 'zv_sub', 'label' => 'Sub-text', 'type' => 'i18n_textarea', 'i18n' => 'zv.sub' ),
				array( 'key' => 'zv1t', 'label' => 'Step 1 — title', 'type' => 'i18n_text', 'i18n' => 'zv1t' ),
				array( 'key' => 'zv1d', 'label' => 'Step 1 — description', 'type' => 'i18n_textarea', 'i18n' => 'zv1d' ),
				array( 'key' => 'zv2t', 'label' => 'Step 2 — title', 'type' => 'i18n_text', 'i18n' => 'zv2t' ),
				array( 'key' => 'zv2d', 'label' => 'Step 2 — description', 'type' => 'i18n_textarea', 'i18n' => 'zv2d' ),
				array( 'key' => 'zv3t', 'label' => 'Step 3 — title', 'type' => 'i18n_text', 'i18n' => 'zv3t' ),
				array( 'key' => 'zv3d', 'label' => 'Step 3 — description', 'type' => 'i18n_textarea', 'i18n' => 'zv3d' ),
				array( 'key' => 'zv4t', 'label' => 'Step 4 — title', 'type' => 'i18n_text', 'i18n' => 'zv4t' ),
				array( 'key' => 'zv4d', 'label' => 'Step 4 — description', 'type' => 'i18n_textarea', 'i18n' => 'zv4d' ),
				array( 'key' => 'zv5t', 'label' => 'Step 5 — title', 'type' => 'i18n_text', 'i18n' => 'zv5t' ),
				array( 'key' => 'zv5d', 'label' => 'Step 5 — description', 'type' => 'i18n_textarea', 'i18n' => 'zv5d' ),
				array( 'desc' => '— Metrics band —', 'type' => 'note' ),
				array( 'key' => 'mt_h', 'label' => 'Metrics heading', 'type' => 'i18n_text', 'i18n' => 'mt.h' ),
				array( 'key' => 'metric1_num', 'label' => 'Metric 1 — value', 'type' => 'text', 'default' => '+312%' ),
				array( 'key' => 'metric2_num', 'label' => 'Metric 2 — value', 'type' => 'text', 'default' => '120+' ),
				array( 'key' => 'metric3_num', 'label' => 'Metric 3 — value', 'type' => 'text', 'default' => '4.2x' ),
				array( 'key' => 'metric4_num', 'label' => 'Metric 4 — value', 'type' => 'text', 'default' => '98%' ),
				array( 'desc' => '— "How we work" process —', 'type' => 'note' ),
				array( 'key' => 'pr_h', 'label' => 'Heading', 'type' => 'i18n_text', 'i18n' => 'pr.h' ),
				array( 'key' => 'pr1t', 'label' => 'Step 1 — title', 'type' => 'i18n_text', 'i18n' => 'pr1t' ),
				array( 'key' => 'pr1d', 'label' => 'Step 1 — description', 'type' => 'i18n_textarea', 'i18n' => 'pr1d' ),
				array( 'key' => 'pr2t', 'label' => 'Step 2 — title', 'type' => 'i18n_text', 'i18n' => 'pr2t' ),
				array( 'key' => 'pr2d', 'label' => 'Step 2 — description', 'type' => 'i18n_textarea', 'i18n' => 'pr2d' ),
				array( 'key' => 'pr3t', 'label' => 'Step 3 — title', 'type' => 'i18n_text', 'i18n' => 'pr3t' ),
				array( 'key' => 'pr3d', 'label' => 'Step 3 — description', 'type' => 'i18n_textarea', 'i18n' => 'pr3d' ),
				array( 'key' => 'pr4t', 'label' => 'Step 4 — title', 'type' => 'i18n_text', 'i18n' => 'pr4t' ),
				array( 'key' => 'pr4d', 'label' => 'Step 4 — description', 'type' => 'i18n_textarea', 'i18n' => 'pr4d' ),
			),
		),
		'headings' => array(
			'label'  => __( 'Section headings', 'bright-stars' ),
			'fields' => array(
				array( 'desc' => '— Services —', 'type' => 'note' ),
				array( 'key' => 'sv_eyebrow', 'label' => 'Services eyebrow', 'type' => 'i18n_text', 'i18n' => 'sv.eyebrow' ),
				array( 'key' => 'sv_h', 'label' => 'Services heading', 'type' => 'i18n_text', 'i18n' => 'sv.h' ),
				array( 'key' => 'sv_sub', 'label' => 'Services sub-text', 'type' => 'i18n_textarea', 'i18n' => 'sv.sub' ),
				array( 'desc' => '— Clients —', 'type' => 'note' ),
				array( 'key' => 'cl_sub', 'label' => 'Clients sub-text', 'type' => 'i18n_textarea', 'i18n' => 'cl.sub' ),
				array( 'desc' => '— Pricing —', 'type' => 'note' ),
				array( 'key' => 'pc_h', 'label' => 'Pricing heading', 'type' => 'i18n_text', 'i18n' => 'pc.h' ),
				array( 'key' => 'pc_sub', 'label' => 'Pricing sub-text', 'type' => 'i18n_textarea', 'i18n' => 'pc.sub' ),
				array( 'desc' => '— Blog —', 'type' => 'note' ),
				array( 'key' => 'bl_h', 'label' => 'Blog teaser heading (home)', 'type' => 'i18n_text', 'i18n' => 'bl.h' ),
				array( 'key' => 'bl_h2', 'label' => 'Blog page heading', 'type' => 'i18n_text', 'i18n' => 'bl.h2' ),
				array( 'key' => 'bl_sub', 'label' => 'Blog page sub-text', 'type' => 'i18n_textarea', 'i18n' => 'bl.sub' ),
				array( 'desc' => '— Map —', 'type' => 'note' ),
				array( 'key' => 'mp_h', 'label' => 'Map heading', 'type' => 'i18n_text', 'i18n' => 'mp.h' ),
			),
		),
		'about' => array(
			'label'  => __( 'About', 'bright-stars' ),
			'fields' => array(
				array( 'key' => 'about_h', 'label' => 'Heading', 'type' => 'i18n_text', 'i18n' => 'ab.h' ),
				array( 'key' => 'about_intro', 'label' => 'Intro paragraph', 'type' => 'i18n_textarea', 'i18n' => 'ab.intro' ),
				array( 'desc' => 'Team members are managed under Bright Stars → Team.', 'type' => 'note' ),
			),
		),
		'contact' => array(
			'label'  => __( 'Contact', 'bright-stars' ),
			'fields' => array(
				array( 'key' => 'cta_h', 'label' => 'Contact headline', 'type' => 'i18n_text', 'i18n' => 'cta.h' ),
				array( 'key' => 'cta_sub', 'label' => 'Contact sub-text', 'type' => 'i18n_textarea', 'i18n' => 'cta.sub' ),
				array( 'key' => 'contact_email', 'label' => 'Email', 'type' => 'email', 'default' => 'info@brightstarsoman.com' ),
				array( 'key' => 'contact_phone', 'label' => 'Phone', 'type' => 'text', 'default' => '+968 79229343' ),
				array( 'key' => 'contact_whatsapp', 'label' => 'WhatsApp number (digits only)', 'type' => 'text', 'default' => '96879229343' ),
				array( 'key' => 'contact_address', 'label' => 'Address', 'type' => 'i18n_text', 'i18n' => 'mp.addr' ),
				array( 'key' => 'lead_email', 'label' => 'Send enquiry notifications to', 'type' => 'email', 'desc' => 'Defaults to the admin email.' ),
				array( 'key' => 'instagram_handle', 'label' => 'Instagram handle', 'type' => 'text', 'default' => '@brightstarsoman' ),
				array( 'key' => 'instagram_url', 'label' => 'Instagram URL', 'type' => 'url', 'default' => 'https://www.instagram.com/brightstarsoman/' ),
				array( 'key' => 'instagram_url_2', 'label' => 'Instagram URL (2nd account)', 'type' => 'url' ),
				array( 'key' => 'map_embed', 'label' => 'Google Maps embed URL (src)', 'type' => 'url', 'default' => 'https://www.google.com/maps?q=Muscat%2C%20Oman&z=12&output=embed' ),
				array( 'key' => 'map_link', 'label' => 'Google Maps link', 'type' => 'url', 'default' => 'https://maps.app.goo.gl/m8YDcuF6oo77eLp47' ),
			),
		),
		'footer' => array(
			'label'  => __( 'Footer', 'bright-stars' ),
			'fields' => array(
				array( 'key' => 'footer_tag', 'label' => 'Tagline', 'type' => 'i18n_text', 'i18n' => 'ft.tag' ),
				array( 'key' => 'footer_copy', 'label' => 'Copyright line', 'type' => 'i18n_text', 'i18n' => 'ft.copy' ),
				array( 'key' => 'footer_legal', 'label' => 'Legal line', 'type' => 'i18n_text', 'i18n' => 'ft.legal' ),
			),
		),
		'seo' => array(
			'label'  => __( 'SEO & Social', 'bright-stars' ),
			'fields' => array(
				array( 'key' => 'seo_description', 'label' => 'Home meta description', 'type' => 'i18n_textarea', 'i18n' => 'hero.sub' ),
				array( 'key' => 'seo_og_image', 'label' => 'Default social share image', 'type' => 'media' ),
				array( 'key' => 'facebook_url', 'label' => 'Facebook URL', 'type' => 'url' ),
				array( 'key' => 'linkedin_url', 'label' => 'LinkedIn URL', 'type' => 'url' ),
				array( 'key' => 'google_analytics', 'label' => 'Google Analytics ID (G-XXXXXXX)', 'type' => 'text' ),
			),
		),
	);
}

/**
 * Register the option and sanitiser.
 */
function bright_stars_register_settings() {
	register_setting(
		'bright_stars_settings_group',
		'bright_stars_options',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'bright_stars_sanitize_options',
			'default'           => array(),
		)
	);
}
add_action( 'admin_init', 'bright_stars_register_settings' );

/**
 * Sanitise the whole option array against the schema.
 *
 * @param mixed $input Raw form input.
 * @return array
 */
function bright_stars_sanitize_options( $input ) {
	$input  = is_array( $input ) ? $input : array();
	$out    = get_option( 'bright_stars_options', array() );
	$out    = is_array( $out ) ? $out : array();
	$schema = bright_stars_settings_schema();

	foreach ( $schema as $tab ) {
		foreach ( $tab['fields'] as $f ) {
			if ( empty( $f['key'] ) || 'note' === ( $f['type'] ?? '' ) ) {
				continue;
			}
			$key  = $f['key'];
			$type = $f['type'];

			switch ( $type ) {
				case 'i18n_text':
				case 'i18n_textarea':
					foreach ( array( 'en', 'ar', 'fa' ) as $lg ) {
						$k = $key . '_' . $lg;
						if ( isset( $input[ $k ] ) ) {
							$out[ $k ] = ( 'i18n_text' === $type )
								? sanitize_text_field( wp_unslash( $input[ $k ] ) )
								: sanitize_textarea_field( wp_unslash( $input[ $k ] ) );
						}
					}
					break;

				case 'multicheck':
					$vals = isset( $input[ $key ] ) && is_array( $input[ $key ] ) ? array_map( 'sanitize_key', $input[ $key ] ) : array();
					$vals = array_values( array_intersect( array_keys( $f['options'] ), $vals ) );
					if ( empty( $vals ) ) {
						$vals = array( 'en' );
					}
					$out[ $key ] = $vals;
					break;

				case 'checkbox':
					$out[ $key ] = isset( $input[ $key ] ) ? '1' : '';
					break;

				case 'select':
					$val = isset( $input[ $key ] ) ? sanitize_text_field( wp_unslash( $input[ $key ] ) ) : '';
					$out[ $key ] = array_key_exists( $val, $f['options'] ) ? $val : ( $f['default'] ?? '' );
					break;

				case 'media':
				case 'number':
					$out[ $key ] = isset( $input[ $key ] ) ? (int) $input[ $key ] : 0;
					break;

				case 'url':
					$out[ $key ] = isset( $input[ $key ] ) ? esc_url_raw( wp_unslash( $input[ $key ] ) ) : '';
					break;

				case 'email':
					$out[ $key ] = isset( $input[ $key ] ) ? sanitize_email( wp_unslash( $input[ $key ] ) ) : '';
					break;

				case 'color':
					$out[ $key ] = isset( $input[ $key ] ) ? sanitize_hex_color( wp_unslash( $input[ $key ] ) ) : '';
					break;

				case 'textarea':
					$out[ $key ] = isset( $input[ $key ] ) ? sanitize_textarea_field( wp_unslash( $input[ $key ] ) ) : '';
					break;

				default:
					$out[ $key ] = isset( $input[ $key ] ) ? sanitize_text_field( wp_unslash( $input[ $key ] ) ) : '';
			}
		}
	}

	// Internal keys (route_pages, seeded) are preserved automatically because we
	// start from the existing option and only overwrite schema fields above.

	return $out;
}
