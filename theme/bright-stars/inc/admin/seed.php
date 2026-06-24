<?php
/**
 * Turnkey setup: build the WordPress pages, seed demo content, register the
 * primary menu, handle contact enquiries. Also exposes the default content the
 * front end falls back to before anything has been created.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ------------------------------------------------------------------ *
 * Default content (faithful to the original design). Used both for
 * seeding the CPTs and as a live fallback when no items exist yet.
 * ------------------------------------------------------------------ */

/**
 * @return array Keyed arrays of services, pricing, team, testimonials, clients.
 */
function bright_stars_default_data() {
	$d = bs_i18n_dict();
	$tri = function ( $key ) use ( $d ) {
		return array(
			'en' => isset( $d['en'][ $key ] ) ? $d['en'][ $key ] : '',
			'ar' => isset( $d['ar'][ $key ] ) ? $d['ar'][ $key ] : '',
			'fa' => isset( $d['fa'][ $key ] ) ? $d['fa'][ $key ] : '',
		);
	};

	$services = array();
	$svc_icons = array( 'search', 'target', 'share', 'pen', 'layout', 'compass' );
	for ( $i = 1; $i <= 6; $i++ ) {
		$services[] = array(
			'icon'  => $svc_icons[ $i - 1 ],
			'title' => $tri( 'sv' . $i . 't' ),
			'desc'  => $tri( 'sv' . $i . 'd' ),
		);
	}

	$pricing = array(
		array(
			'name' => $tri( 'pc1n' ), 'price' => array( 'en' => '450', 'ar' => '450', 'fa' => '۴۵۰' ), 'period' => $tri( 'pc.mo' ),
			'desc' => $tri( 'pc1d' ), 'cta' => $tri( 'pc1b' ), 'badge' => array( 'en' => '', 'ar' => '', 'fa' => '' ), 'featured' => false,
			'features' => array(
				'en' => $d['en']['pc1f1'] . "\n" . $d['en']['pc1f2'] . "\n" . $d['en']['pc1f3'],
				'ar' => $d['ar']['pc1f1'] . "\n" . $d['ar']['pc1f2'] . "\n" . $d['ar']['pc1f3'],
				'fa' => $d['fa']['pc1f1'] . "\n" . $d['fa']['pc1f2'] . "\n" . $d['fa']['pc1f3'],
			),
		),
		array(
			'name' => $tri( 'pc2n' ), 'price' => array( 'en' => '950', 'ar' => '950', 'fa' => '۹۵۰' ), 'period' => $tri( 'pc.mo' ),
			'desc' => $tri( 'pc2d' ), 'cta' => $tri( 'pc2b' ), 'badge' => $tri( 'pc2tag' ), 'featured' => true,
			'features' => array(
				'en' => $d['en']['pc2f1'] . "\n" . $d['en']['pc2f2'] . "\n" . $d['en']['pc2f3'] . "\n" . $d['en']['pc2f4'],
				'ar' => $d['ar']['pc2f1'] . "\n" . $d['ar']['pc2f2'] . "\n" . $d['ar']['pc2f3'] . "\n" . $d['ar']['pc2f4'],
				'fa' => $d['fa']['pc2f1'] . "\n" . $d['fa']['pc2f2'] . "\n" . $d['fa']['pc2f3'] . "\n" . $d['fa']['pc2f4'],
			),
		),
		array(
			'name' => $tri( 'pc3n' ), 'price' => $tri( 'pc3price' ), 'period' => array( 'en' => '', 'ar' => '', 'fa' => '' ),
			'desc' => $tri( 'pc3d' ), 'cta' => $tri( 'pc3b' ), 'badge' => array( 'en' => '', 'ar' => '', 'fa' => '' ), 'featured' => false,
			'features' => array(
				'en' => $d['en']['pc3f1'] . "\n" . $d['en']['pc3f2'] . "\n" . $d['en']['pc3f3'] . "\n" . $d['en']['pc3f4'],
				'ar' => $d['ar']['pc3f1'] . "\n" . $d['ar']['pc3f2'] . "\n" . $d['ar']['pc3f3'] . "\n" . $d['ar']['pc3f4'],
				'fa' => $d['fa']['pc3f1'] . "\n" . $d['fa']['pc3f2'] . "\n" . $d['fa']['pc3f3'] . "\n" . $d['fa']['pc3f4'],
			),
		),
	);

	$team = array(
		array( 'name' => 'Mohammad Hossein', 'photo' => 'hossein.jpg', 'role' => $tri( 'ab.r1' ), 'quote' => $tri( 'ab.s1' ), 'bio' => $tri( 'ab.b1' ) ),
		array( 'name' => 'Mohammad Ali', 'photo' => 'ali.jpg', 'role' => $tri( 'ab.r2' ), 'quote' => $tri( 'ab.s2' ), 'bio' => $tri( 'ab.b2' ) ),
		array( 'name' => 'Hanieh Salehi', 'photo' => 'hanieh.jpg', 'role' => $tri( 'ab.r3' ), 'quote' => $tri( 'ab.s3' ), 'bio' => $tri( 'ab.b3' ) ),
	);

	$testimonials = array(
		array( 'author' => 'Layla Al-Harthy', 'initials' => 'LA', 'quote' => $tri( 'ts1q' ), 'role' => $tri( 'ts1r' ) ),
		array( 'author' => 'Omar Said', 'initials' => 'OS', 'quote' => $tri( 'ts2q' ), 'role' => $tri( 'ts2r' ) ),
	);

	$cat = function ( $en, $ar, $fa ) {
		return array( 'en' => $en, 'ar' => $ar, 'fa' => $fa );
	};
	$clients = array(
		array(
			'slug' => 'm2-real-estate', 'name' => 'M2 Real Estate', 'logo' => 'm2.realestates.jpg', 'feed' => 'm2.realestates.jpg',
			'ig' => 'https://www.instagram.com/m2.realestates/', 'handle' => 'm2.realestates', 'color' => 'linear-gradient(135deg,#2E568A,#0A1F38)',
			'category' => $cat( 'Real estate', 'عقارات', 'املاک' ),
			'tagline' => "Muscat's most-wanted addresses, sold faster.",
			'brief' => 'A boutique agency with premium listings but a flat digital presence. We rebuilt the feed and the funnel so every property looked as valuable as it really is.',
			'services' => array( 'Brand & content system', 'Property reels', 'Lead-gen campaigns', 'CRM & follow-up' ),
			'results' => array( '+218% | Qualified leads', '579 | Followers', '27 | Deals influenced' ),
		),
		array(
			'slug' => 'lubna-khalili-academy', 'name' => 'Lubna Khalili Academy', 'logo' => 'academylubnakhalili.jpg', 'feed' => 'academylubnakhalili.jpg',
			'ig' => 'https://www.instagram.com/academylubnakhalili/', 'handle' => 'academylubnakhalili', 'color' => 'linear-gradient(135deg,#F9912F,#7A3A08)',
			'category' => $cat( 'Education', 'تعليم', 'آموزش' ),
			'tagline' => 'Turning expertise into a sold-out academy.',
			'brief' => 'An educator with a loyal following and no system to convert it. We packaged the courses, built the launch calendar, and ran the enrolment campaigns.',
			'services' => array( 'Course branding', 'Launch campaigns', 'Lead funnels', 'Community content' ),
			'results' => array( '+340% | Enrolments', '1,245 | Followers', '4.6x | Ad ROAS' ),
		),
		array(
			'slug' => 'zaytoon-royal', 'name' => 'Zaytoon Royal', 'logo' => 'zaytoonroyal.jpg', 'feed' => 'zaytoonroyal.jpg',
			'ig' => 'https://www.instagram.com/zaytoonroyal/', 'handle' => 'zaytoonroyal', 'color' => 'linear-gradient(135deg,#13335A,#030B16)',
			'category' => $cat( 'Hospitality', 'ضيافة', 'مهمان‌نوازی' ),
			'tagline' => 'A royal table, fully booked.',
			'brief' => 'A fine-dining destination that needed reservations, not just likes. We built a booking-first presence with seasonal campaigns.',
			'services' => array( 'Brand & art direction', 'Food content', 'Reservations funnel', 'Influencer dinners' ),
			'results' => array( '2.4x | Direct bookings', '+190% | Weekend covers', '153 | Followers' ),
		),
		array(
			'slug' => 'hudhud-fabric', 'name' => 'Hudhud Fabric', 'logo' => 'hudhud.fabric.jpg', 'feed' => 'hudhud.fabric.jpg',
			'ig' => 'https://www.instagram.com/hudhud.fabric/', 'handle' => 'hudhud.fabric', 'color' => 'linear-gradient(135deg,#F58021,#B0530B)',
			'category' => $cat( 'Textile', 'أقمشة', 'نساجی' ),
			'tagline' => 'Heritage fabric, modern demand.',
			'brief' => 'A textile house with beautiful product and quiet sales. We told the craft story and turned the catalogue into a shoppable feed.',
			'services' => array( 'Brand storytelling', 'Product photography', 'Catalogue & shop', 'Paid social' ),
			'results' => array( '+265% | Online orders', '3.0x | Catalogue views', '8,550 | Followers' ),
		),
		array(
			'slug' => 'seeb-waves', 'name' => 'Seeb Waves', 'logo' => 'seebwaves.jpg', 'feed' => 'seebwaves.jpg',
			'ig' => 'https://www.instagram.com/seebwaves/', 'handle' => 'seebwaves', 'color' => 'linear-gradient(135deg,#5A7CA8,#13335A)',
			'category' => $cat( 'Lifestyle', 'نمط حياة', 'سبک زندگی' ),
			'tagline' => 'Riding the coastal lifestyle wave.',
			'brief' => "A lifestyle brand for Oman's coast. We gave it a consistent visual world and an always-on content engine.",
			'services' => array( 'Brand world', 'Always-on content', 'Creator partnerships', 'Community growth' ),
			'results' => array( '+410% | Engagement', '14.9k | Followers', '5.1x | Reel reach' ),
		),
		array(
			'slug' => 'sima-vandad', 'name' => 'Sima Vandad', 'logo' => 'sima_vandad.jpg', 'feed' => 'sima_vandad.jpg',
			'ig' => 'https://www.instagram.com/sima_vandad/', 'handle' => 'sima_vandad', 'color' => 'linear-gradient(135deg,#FCA856,#D86A12)',
			'category' => $cat( 'Beauty', 'جمال', 'زیبایی' ),
			'tagline' => 'Beauty that books itself.',
			'brief' => 'A beauty professional ready to scale. We built the booking funnel and the before/after content that actually converts.',
			'services' => array( 'Brand identity', 'Booking funnel', 'Treatment reels', 'Retargeting' ),
			'results' => array( '+280% | Bookings', '3.4x | Lead-form rate', '32.1k | Followers' ),
		),
		array(
			'slug' => 'nota-jewelry', 'name' => 'Nota Jewelry', 'logo' => 'notajelwery.jpg', 'feed' => 'notajelwery.jpg',
			'ig' => 'https://www.instagram.com/notajelwery/', 'handle' => 'notajelwery', 'color' => 'linear-gradient(135deg,#2E568A,#061427)',
			'category' => $cat( 'Jewelry', 'مجوهرات', 'جواهرات' ),
			'tagline' => 'Every piece, a moment.',
			'brief' => 'A jewelry label competing on emotion, not price. We crafted a premium feed and gifting-season campaigns.',
			'services' => array( 'Brand & art direction', 'Product films', 'Gifting campaigns', 'Paid social' ),
			'results' => array( '+233% | Store visits', '4.2x | Campaign ROAS', '22.2k | Followers' ),
		),
		array(
			'slug' => 'oman-vision', 'name' => 'Oman Vision', 'logo' => '', 'feed' => '',
			'ig' => 'https://www.instagram.com/omanvision.ir/', 'handle' => 'omanvision.ir', 'color' => 'linear-gradient(135deg,#F9912F,#7A3A08)',
			'category' => $cat( 'Media', 'إعلام', 'رسانه' ),
			'tagline' => "Telling Oman's story to the world.",
			'brief' => 'A media platform that needed reach and retention. We sharpened the formats and grew the audience.',
			'services' => array( 'Content strategy', 'Short-form formats', 'Audience growth', 'Distribution' ),
			'results' => array( '+520% | Watch time', '48k | New followers', '3.7x | Shares' ),
		),
		array(
			'slug' => 'adam-perfumes', 'name' => 'Adam Perfumes', 'logo' => 'adam.perfumes.jpg', 'feed' => 'adam.perfumes.jpg',
			'ig' => 'https://www.instagram.com/adam.perfumes/', 'handle' => 'adam.perfumes', 'color' => 'linear-gradient(135deg,#13335A,#0A1F38)',
			'category' => $cat( 'Fragrance', 'عطور', 'عطر' ),
			'tagline' => 'Scent, made unforgettable online.',
			'brief' => 'A fragrance house with retail strength and a thin digital funnel. We built the launch playbook and the always-on engine.',
			'services' => array( 'Brand films', 'Launch campaigns', 'E-commerce funnel', 'Influencer seeding' ),
			'results' => array( '+295% | Online sales', '5.8x | Launch ROAS', '102k | Followers' ),
		),
		array(
			'slug' => 'miss-cheff', 'name' => 'Miss Cheff', 'logo' => 'miisscheff.jpg', 'feed' => 'miisscheff.jpg',
			'ig' => 'https://www.instagram.com/miisscheff/', 'handle' => 'miisscheff', 'color' => 'linear-gradient(135deg,#FCA856,#B0530B)',
			'category' => $cat( 'Food', 'طعام', 'غذا' ),
			'tagline' => 'From kitchen to fully-booked.',
			'brief' => 'A culinary brand with great food and inconsistent demand. We made the feed crave-worthy and the orders steady.',
			'services' => array( 'Food content', 'Menu campaigns', 'Delivery funnel', 'Community' ),
			'results' => array( '2.7x | Orders', '+205% | Saves', '389 | Followers' ),
		),
		array(
			'slug' => 'first-glass-oman', 'name' => 'First Glass Oman', 'logo' => '', 'feed' => '',
			'ig' => 'https://www.instagram.com/firstglassoman/', 'handle' => 'firstglassoman', 'color' => 'linear-gradient(135deg,#5A7CA8,#0A1F38)',
			'category' => $cat( 'Glass & aluminium', 'زجاج وألمنيوم', 'شیشه و آلومینیوم' ),
			'tagline' => 'Building Oman, pane by pane.',
			'brief' => 'A glass & aluminium contractor that won on craft, not clicks. We built a project-led presence and a B2B lead engine.',
			'services' => array( 'Brand & project content', 'B2B lead-gen', 'Project case films', 'Sales enablement' ),
			'results' => array( '+178% | Qualified RFQs', '3.3x | Site enquiries', '24 | Projects influenced' ),
		),
	);

	return compact( 'services', 'pricing', 'team', 'testimonials', 'clients' );
}

/* ------------------------------------------------------------------ *
 * Page + structure builder.
 * ------------------------------------------------------------------ */

/**
 * The pages the theme needs and their templates.
 */
function bright_stars_page_blueprint() {
	return array(
		'home'     => array( 'title' => 'Home', 'template' => '', 'slug' => 'home' ),
		'services' => array( 'title' => 'Services', 'template' => 'page-templates/template-services.php', 'slug' => 'services' ),
		'about'    => array( 'title' => 'About', 'template' => 'page-templates/template-about.php', 'slug' => 'about' ),
		'pricing'  => array( 'title' => 'Pricing', 'template' => 'page-templates/template-pricing.php', 'slug' => 'pricing' ),
		'contact'  => array( 'title' => 'Contact', 'template' => 'page-templates/template-contact.php', 'slug' => 'contact' ),
		'clientspage' => array( 'title' => 'Clients', 'template' => 'page-templates/template-clients.php', 'slug' => 'clients' ),
		'blog'     => array( 'title' => 'Blog', 'template' => '', 'slug' => 'blog' ),
	);
}

/**
 * Create the pages, assign templates, set front + posts pages, store the map.
 */
function bright_stars_create_pages() {
	$o     = get_option( 'bright_stars_options', array() );
	$o     = is_array( $o ) ? $o : array();
	$map   = isset( $o['route_pages'] ) && is_array( $o['route_pages'] ) ? $o['route_pages'] : array();

	foreach ( bright_stars_page_blueprint() as $route => $info ) {
		// Skip if we already have a valid page for this route.
		if ( ! empty( $map[ $route ] ) && get_post( $map[ $route ] ) ) {
			continue;
		}
		// Reuse an existing page with the same slug if present.
		$existing = get_page_by_path( $info['slug'] );
		if ( $existing ) {
			$page_id = $existing->ID;
		} else {
			$page_id = wp_insert_post(
				array(
					'post_type'    => 'page',
					'post_title'   => $info['title'],
					'post_name'    => $info['slug'],
					'post_status'  => 'publish',
					'post_content' => '',
				)
			);
		}
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			if ( $info['template'] ) {
				update_post_meta( $page_id, '_wp_page_template', $info['template'] );
			}
			$map[ $route ] = (int) $page_id;
		}
	}

	// Front page + posts page.
	if ( ! empty( $map['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $map['home'] );
	}
	if ( ! empty( $map['blog'] ) ) {
		update_option( 'page_for_posts', (int) $map['blog'] );
	}

	// The "clients" route used by nav points at the Clients page.
	if ( ! empty( $map['clientspage'] ) ) {
		$map['clients'] = (int) $map['clientspage'];
	}

	$o['route_pages'] = $map;
	update_option( 'bright_stars_options', $o );

	return $map;
}

/**
 * Seed the CPT collections from the default data (idempotent unless forced).
 *
 * @param bool $force Recreate even if items already exist.
 */
function bright_stars_seed_content( $force = false ) {
	$data = bright_stars_default_data();

	$set_tri = function ( $post_id, $base, $tri ) {
		foreach ( array( 'en', 'ar', 'fa' ) as $lg ) {
			if ( isset( $tri[ $lg ] ) ) {
				update_post_meta( $post_id, '_bs_' . $base . '_' . $lg, $tri[ $lg ] );
			}
		}
	};

	// Services.
	if ( $force || ! bright_stars_get_items( 'bs_service', 1 ) ) {
		$order = 0;
		foreach ( $data['services'] as $s ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_service', 'post_status' => 'publish', 'post_title' => $s['title']['en'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_bs_icon', $s['icon'] );
				$set_tri( $id, 'title', $s['title'] );
				$set_tri( $id, 'desc', $s['desc'] );
			}
			$order++;
		}
	}

	// Pricing.
	if ( $force || ! bright_stars_get_items( 'bs_pricing', 1 ) ) {
		$order = 0;
		foreach ( $data['pricing'] as $p ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_pricing', 'post_status' => 'publish', 'post_title' => $p['name']['en'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_bs_featured', $p['featured'] ? '1' : '' );
				foreach ( array( 'name', 'price', 'period', 'desc', 'cta', 'badge', 'features' ) as $b ) {
					$set_tri( $id, $b, $p[ $b ] );
				}
			}
			$order++;
		}
	}

	// Team.
	if ( $force || ! bright_stars_get_items( 'bs_team', 1 ) ) {
		$order = 0;
		foreach ( $data['team'] as $m ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_team', 'post_status' => 'publish', 'post_title' => $m['name'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_bs_photo', bs_asset( 'img/team/' . $m['photo'] ) );
				foreach ( array( 'role', 'quote', 'bio' ) as $b ) {
					$set_tri( $id, $b, $m[ $b ] );
				}
			}
			$order++;
		}
	}

	// Testimonials.
	if ( $force || ! bright_stars_get_items( 'bs_testimonial', 1 ) ) {
		$order = 0;
		foreach ( $data['testimonials'] as $t ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_testimonial', 'post_status' => 'publish', 'post_title' => $t['author'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_bs_author', $t['author'] );
				update_post_meta( $id, '_bs_initials', $t['initials'] );
				$set_tri( $id, 'quote', $t['quote'] );
				$set_tri( $id, 'role', $t['role'] );
			}
			$order++;
		}
	}

	// Clients.
	if ( $force || ! bright_stars_get_items( 'bs_client', 1 ) ) {
		$order = 0;
		foreach ( $data['clients'] as $c ) {
			$id = wp_insert_post( array( 'post_type' => 'bs_client', 'post_status' => 'publish', 'post_title' => $c['name'], 'post_name' => $c['slug'], 'menu_order' => $order ) );
			if ( $id && ! is_wp_error( $id ) ) {
				if ( ! empty( $c['logo'] ) ) {
					update_post_meta( $id, '_bs_logo', bs_asset( 'img/clients/' . $c['logo'] ) );
				}
				if ( ! empty( $c['feed'] ) ) {
					update_post_meta( $id, '_bs_feed', bs_asset( 'img/feeds/' . $c['feed'] ) );
				}
				update_post_meta( $id, '_bs_instagram', $c['ig'] );
				update_post_meta( $id, '_bs_handle', $c['handle'] );
				update_post_meta( $id, '_bs_color', $c['color'] );
				update_post_meta( $id, '_bs_tagline_en', $c['tagline'] );
				update_post_meta( $id, '_bs_brief_en', $c['brief'] );
				update_post_meta( $id, '_bs_services_en', implode( "\n", $c['services'] ) );
				update_post_meta( $id, '_bs_results_en', implode( "\n", $c['results'] ) );
				$set_tri( $id, 'category', $c['category'] );
			}
			$order++;
		}
	}
}

/**
 * Backfill missing meta on existing client posts from the default data
 * (matched by slug). Only fills empty fields, so it never clobbers edits.
 * This is what makes "deactivate → reactivate" populate older clients.
 */
function bright_stars_upgrade_clients() {
	$data    = bright_stars_default_data();
	$by_slug = array();
	foreach ( $data['clients'] as $c ) {
		$by_slug[ $c['slug'] ] = $c;
	}

	$clients = get_posts( array( 'post_type' => 'bs_client', 'post_status' => 'any', 'numberposts' => -1 ) );
	foreach ( $clients as $p ) {
		if ( ! isset( $by_slug[ $p->post_name ] ) ) {
			continue;
		}
		$c    = $by_slug[ $p->post_name ];
		$fill = function ( $key, $value ) use ( $p ) {
			$cur = get_post_meta( $p->ID, $key, true );
			if ( '' === trim( (string) $cur ) && '' !== trim( (string) $value ) ) {
				update_post_meta( $p->ID, $key, $value );
			}
		};

		$fill( '_bs_tagline_en', $c['tagline'] );
		$fill( '_bs_brief_en', $c['brief'] );
		$fill( '_bs_services_en', implode( "\n", $c['services'] ) );
		$fill( '_bs_results_en', implode( "\n", $c['results'] ) );
		$fill( '_bs_instagram', $c['ig'] );
		$fill( '_bs_handle', $c['handle'] );
		$fill( '_bs_color', $c['color'] );
		foreach ( array( 'en', 'ar', 'fa' ) as $lg ) {
			$fill( '_bs_category_' . $lg, $c['category'][ $lg ] );
		}
		if ( ! empty( $c['logo'] ) ) {
			$fill( '_bs_logo', bs_asset( 'img/clients/' . $c['logo'] ) );
		}
		if ( ! empty( $c['feed'] ) ) {
			$fill( '_bs_feed', bs_asset( 'img/feeds/' . $c['feed'] ) );
		}
	}
}

/**
 * Build a Primary menu from the route pages and assign it to the location.
 */
function bright_stars_create_menu() {
	$name = 'Primary';
	$menu = wp_get_nav_menu_object( $name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $name );
	} else {
		$menu_id = $menu->term_id;
	}
	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	// Only populate an empty menu.
	$items = wp_get_nav_menu_items( $menu_id );
	if ( empty( $items ) ) {
		foreach ( bright_stars_nav_items() as $it ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'  => $it['label'],
					'menu-item-url'    => $it['url'],
					'menu-item-status' => 'publish',
					'menu-item-type'   => 'custom',
				)
			);
		}
	}

	$locations           = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Run the whole setup.
 *
 * @param bool $force_seed Recreate demo content.
 */
function bright_stars_run_setup( $force_seed = false ) {
	bright_stars_create_pages();
	bright_stars_seed_content( $force_seed );
	bright_stars_create_menu();

	$o = get_option( 'bright_stars_options', array() );
	$o = is_array( $o ) ? $o : array();
	$o['seeded'] = '1';
	update_option( 'bright_stars_options', $o );

	flush_rewrite_rules();
}

/**
 * On first activation, configure everything automatically.
 */
function bright_stars_after_switch_theme() {
	$o = get_option( 'bright_stars_options', array() );
	if ( is_array( $o ) && ! empty( $o['seeded'] ) ) {
		// Re-activation: ensure pages exist and backfill any new client fields.
		bright_stars_create_pages();
		bright_stars_upgrade_clients();
		flush_rewrite_rules();
		update_option( 'bright_stars_data_version', BRIGHT_STARS_VERSION );
		return;
	}
	bright_stars_run_setup( false );
	update_option( 'bright_stars_data_version', BRIGHT_STARS_VERSION );
}
add_action( 'after_switch_theme', 'bright_stars_after_switch_theme' );

/**
 * Run data migrations once after the theme files are updated (no re-activation
 * required) — guarded by a stored version so it only runs when something
 * changed. This guarantees the changes show up in WordPress after an update.
 */
function bright_stars_maybe_upgrade() {
	if ( get_option( 'bright_stars_data_version' ) === BRIGHT_STARS_VERSION ) {
		return;
	}
	$o = get_option( 'bright_stars_options', array() );
	if ( is_array( $o ) && ! empty( $o['seeded'] ) ) {
		bright_stars_create_pages();
		bright_stars_upgrade_clients();
		flush_rewrite_rules();
	}
	update_option( 'bright_stars_data_version', BRIGHT_STARS_VERSION );
}
add_action( 'admin_init', 'bright_stars_maybe_upgrade' );

/* ------------------------------------------------------------------ *
 * Setup admin page.
 * ------------------------------------------------------------------ */

function bright_stars_render_setup_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_POST['bright_stars_setup_action'] ) && check_admin_referer( 'bright_stars_setup', 'bright_stars_setup_nonce' ) ) {
		$action = sanitize_text_field( wp_unslash( $_POST['bright_stars_setup_action'] ) );
		if ( 'run' === $action ) {
			bright_stars_run_setup( false );
			echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Pages created and content set up.', 'bright-stars' ) . '</p></div>';
		} elseif ( 'reseed' === $action ) {
			bright_stars_run_setup( true );
			echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Demo content re-imported.', 'bright-stars' ) . '</p></div>';
		}
	}

	$map = bs_opt( 'route_pages', array() );
	?>
	<div class="wrap bs-admin">
		<h1><?php esc_html_e( 'Bright Stars — Setup', 'bright-stars' ); ?></h1>
		<p class="description"><?php esc_html_e( 'This builds the WordPress pages (Home, Services, Clients, About, Pricing, Contact, Blog), sets the front page, and fills the site with the original Bright Stars content in English, Arabic and Persian.', 'bright-stars' ); ?></p>

		<h2><?php esc_html_e( 'Pages', 'bright-stars' ); ?></h2>
		<table class="widefat striped" style="max-width:640px">
			<thead><tr><th><?php esc_html_e( 'Route', 'bright-stars' ); ?></th><th><?php esc_html_e( 'Status', 'bright-stars' ); ?></th></tr></thead>
			<tbody>
			<?php foreach ( bright_stars_page_blueprint() as $route => $info ) : ?>
				<tr>
					<td><strong><?php echo esc_html( $info['title'] ); ?></strong></td>
					<td>
						<?php
						$pid = isset( $map[ $route ] ) ? (int) $map[ $route ] : 0;
						if ( $pid && get_post( $pid ) ) {
							printf( '<a href="%s">%s</a> · <a href="%s" target="_blank" rel="noopener">%s</a>', esc_url( get_edit_post_link( $pid ) ), esc_html__( 'Edit', 'bright-stars' ), esc_url( get_permalink( $pid ) ), esc_html__( 'View', 'bright-stars' ) );
						} else {
							echo '<span style="color:#b32d2e">' . esc_html__( 'Not created yet', 'bright-stars' ) . '</span>';
						}
						?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<h2 style="margin-top:24px"><?php esc_html_e( 'Content', 'bright-stars' ); ?></h2>
		<p>
			<?php
			$counts = array(
				'bs_service'     => __( 'Services', 'bright-stars' ),
				'bs_pricing'     => __( 'Pricing plans', 'bright-stars' ),
				'bs_team'        => __( 'Team members', 'bright-stars' ),
				'bs_testimonial' => __( 'Testimonials', 'bright-stars' ),
				'bs_client'      => __( 'Clients', 'bright-stars' ),
			);
			$parts = array();
			foreach ( $counts as $pt => $lbl ) {
				$parts[] = $lbl . ': <strong>' . count( bright_stars_get_items( $pt ) ) . '</strong>';
			}
			echo wp_kses_post( implode( ' &nbsp;·&nbsp; ', $parts ) );
			?>
		</p>

		<form method="post" style="margin-top:16px">
			<?php wp_nonce_field( 'bright_stars_setup', 'bright_stars_setup_nonce' ); ?>
			<button type="submit" name="bright_stars_setup_action" value="run" class="button button-primary"><?php esc_html_e( 'Create pages & set up', 'bright-stars' ); ?></button>
			<button type="submit" name="bright_stars_setup_action" value="reseed" class="button" onclick="return confirm('<?php echo esc_js( __( 'Re-import all demo content? Existing demo items are kept and a fresh set is added.', 'bright-stars' ) ); ?>');"><?php esc_html_e( 'Re-import demo content', 'bright-stars' ); ?></button>
		</form>
	</div>
	<?php
}

/* ------------------------------------------------------------------ *
 * Contact enquiries: a private CPT + AJAX handler.
 * ------------------------------------------------------------------ */

function bright_stars_register_lead_cpt() {
	register_post_type(
		'bs_lead',
		array(
			'labels'       => bright_stars_cpt_labels( 'Enquiry', 'Enquiries' ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => 'bright-stars',
			'menu_icon'    => 'dashicons-email-alt',
			'supports'     => array( 'title' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'bright_stars_register_lead_cpt' );

/**
 * Handle the contact form (AJAX).
 */
function bright_stars_handle_lead() {
	check_ajax_referer( 'bright_stars_lead', 'nonce' );

	$name    = isset( $_POST['bs_name'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_name'] ) ) : '';
	$brand   = isset( $_POST['bs_brand'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_brand'] ) ) : '';
	$email   = isset( $_POST['bs_email'] ) ? sanitize_email( wp_unslash( $_POST['bs_email'] ) ) : '';
	$phone   = isset( $_POST['bs_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_phone'] ) ) : '';
	$service = isset( $_POST['bs_service'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_service'] ) ) : '';
	$budget  = isset( $_POST['bs_budget'] ) ? sanitize_text_field( wp_unslash( $_POST['bs_budget'] ) ) : '';
	$message = isset( $_POST['bs_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['bs_message'] ) ) : '';

	if ( '' === $name || ( '' === $email && '' === $phone ) ) {
		wp_send_json_error( bs_t( 'f.required' ) );
	}
	if ( '' !== $email && ! is_email( $email ) ) {
		wp_send_json_error( bs_t( 'f.error' ) );
	}

	// Honeypot.
	if ( ! empty( $_POST['bs_website'] ) ) {
		wp_send_json_success( bs_t( 'f.thanksSub' ) );
	}

	$lead_id = wp_insert_post(
		array(
			'post_type'   => 'bs_lead',
			'post_status' => 'publish',
			/* translators: 1: name, 2: brand. */
			'post_title'  => trim( sprintf( '%1$s — %2$s', $name, $brand ? $brand : '—' ) ),
			'post_content' => $message,
		)
	);
	if ( $lead_id && ! is_wp_error( $lead_id ) ) {
		foreach ( compact( 'name', 'brand', 'email', 'phone', 'service', 'budget' ) as $k => $v ) {
			update_post_meta( $lead_id, '_bs_' . $k, $v );
		}
		update_post_meta( $lead_id, '_bs_lang', bs_lang() );
	}

	$to      = bs_opt( 'lead_email' );
	$to      = $to ? $to : get_option( 'admin_email' );
	$subject = sprintf( '[%s] New enquiry from %s', bs_brand_name(), $name );
	$body    = "Name: $name\nBrand: $brand\nEmail: $email\nPhone: $phone\nService: $service\nBudget: $budget\n\nMessage:\n$message\n";
	$headers = array();
	if ( $email ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}
	wp_mail( $to, $subject, $body, $headers );

	wp_send_json_success( bs_t( 'f.thanksSub' ) );
}
add_action( 'wp_ajax_bright_stars_lead', 'bright_stars_handle_lead' );
add_action( 'wp_ajax_nopriv_bright_stars_lead', 'bright_stars_handle_lead' );

/**
 * Show enquiry detail columns.
 */
function bright_stars_lead_columns( $cols ) {
	$cols['bs_email'] = __( 'Email', 'bright-stars' );
	$cols['bs_phone'] = __( 'Phone', 'bright-stars' );
	$cols['bs_service'] = __( 'Service', 'bright-stars' );
	return $cols;
}
add_filter( 'manage_bs_lead_posts_columns', 'bright_stars_lead_columns' );

function bright_stars_lead_column_content( $col, $post_id ) {
	if ( in_array( $col, array( 'bs_email', 'bs_phone', 'bs_service' ), true ) ) {
		echo esc_html( get_post_meta( $post_id, '_' . $col, true ) );
	}
}
add_action( 'manage_bs_lead_posts_custom_column', 'bright_stars_lead_column_content', 10, 2 );
