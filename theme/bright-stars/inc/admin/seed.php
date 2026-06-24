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
		array( 'slug' => 'm2-real-estate', 'name' => 'M2 Real Estate', 'logo' => 'm2.realestates.jpg', 'category' => $cat( 'Real estate', 'عقارات', 'املاک' ) ),
		array( 'slug' => 'lubna-khalili-academy', 'name' => 'Lubna Khalili Academy', 'logo' => 'academylubnakhalili.jpg', 'category' => $cat( 'Education', 'تعليم', 'آموزش' ) ),
		array( 'slug' => 'zaytoon-royal', 'name' => 'Zaytoon Royal', 'logo' => 'zaytoonroyal.jpg', 'category' => $cat( 'Hospitality', 'ضيافة', 'مهمان‌نوازی' ) ),
		array( 'slug' => 'hudhud-fabric', 'name' => 'Hudhud Fabric', 'logo' => 'hudhud.fabric.jpg', 'category' => $cat( 'Textile', 'أقمشة', 'نساجی' ) ),
		array( 'slug' => 'seeb-waves', 'name' => 'Seeb Waves', 'logo' => 'seebwaves.jpg', 'category' => $cat( 'Lifestyle', 'نمط حياة', 'سبک زندگی' ) ),
		array( 'slug' => 'sima-vandad', 'name' => 'Sima Vandad', 'logo' => 'sima_vandad.jpg', 'category' => $cat( 'Beauty', 'جمال', 'زیبایی' ) ),
		array( 'slug' => 'nota-jewelry', 'name' => 'Nota Jewelry', 'logo' => 'notajelwery.jpg', 'category' => $cat( 'Jewelry', 'مجوهرات', 'جواهرات' ) ),
		array( 'slug' => 'oman-vision', 'name' => 'Oman Vision', 'logo' => '', 'category' => $cat( 'Media', 'إعلام', 'رسانه' ) ),
		array( 'slug' => 'adam-perfumes', 'name' => 'Adam Perfumes', 'logo' => 'adam.perfumes.jpg', 'category' => $cat( 'Fragrance', 'عطور', 'عطر' ) ),
		array( 'slug' => 'miss-cheff', 'name' => 'Miss Cheff', 'logo' => 'miisscheff.jpg', 'category' => $cat( 'Food', 'طعام', 'غذا' ) ),
		array( 'slug' => 'first-glass-oman', 'name' => 'First Glass Oman', 'logo' => '', 'category' => $cat( 'Glass & aluminium', 'زجاج وألمنيوم', 'شیشه و آلومینیوم' ) ),
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
				if ( $c['logo'] ) {
					update_post_meta( $id, '_bs_logo', bs_asset( 'img/clients/' . $c['logo'] ) );
				}
				$set_tri( $id, 'category', $c['category'] );
			}
			$order++;
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
		// Pages may still need ensuring after a theme re-activation.
		bright_stars_create_pages();
		flush_rewrite_rules();
		return;
	}
	bright_stars_run_setup( false );
}
add_action( 'after_switch_theme', 'bright_stars_after_switch_theme' );

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
