<?php
/**
 * Custom post types + trilingual meta boxes.
 *
 * Repeatable, editable collections power the dynamic sections:
 *   - bs_client      Clients / case studies (public, SEO single pages)
 *   - bs_service     Service cards
 *   - bs_pricing     Pricing plans
 *   - bs_team        Team members
 *   - bs_testimonial Client testimonials
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the post types.
 */
function bright_stars_register_cpts() {
	$base = array(
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => 'bright-stars',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'page-attributes' ),
		'menu_position'      => 26,
	);

	// Clients — public so each becomes an SEO-indexable case study.
	register_post_type(
		'bs_client',
		array_merge(
			$base,
			array(
				'labels'             => bright_stars_cpt_labels( 'Client', 'Clients' ),
				'public'             => true,
				'publicly_queryable' => true,
				'has_archive'        => 'case-studies',
				'rewrite'            => array( 'slug' => 'case-study', 'with_front' => false ),
				'menu_icon'          => 'dashicons-groups',
				'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'bs_service',
		array_merge(
			$base,
			array(
				'labels'    => bright_stars_cpt_labels( 'Service', 'Services' ),
				'menu_icon' => 'dashicons-screenoptions',
				'supports'  => array( 'title', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'bs_pricing',
		array_merge(
			$base,
			array(
				'labels'    => bright_stars_cpt_labels( 'Pricing plan', 'Pricing' ),
				'menu_icon' => 'dashicons-tag',
				'supports'  => array( 'title', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'bs_team',
		array_merge(
			$base,
			array(
				'labels'    => bright_stars_cpt_labels( 'Team member', 'Team' ),
				'menu_icon' => 'dashicons-businessperson',
				'supports'  => array( 'title', 'thumbnail', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'bs_testimonial',
		array_merge(
			$base,
			array(
				'labels'    => bright_stars_cpt_labels( 'Testimonial', 'Testimonials' ),
				'menu_icon' => 'dashicons-format-quote',
				'supports'  => array( 'title', 'page-attributes' ),
			)
		)
	);
}
add_action( 'init', 'bright_stars_register_cpts' );

/**
 * Generate a standard label set.
 */
function bright_stars_cpt_labels( $singular, $plural ) {
	return array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'add_new'            => __( 'Add New', 'bright-stars' ),
		/* translators: %s: singular post type name. */
		'add_new_item'       => sprintf( __( 'Add %s', 'bright-stars' ), $singular ),
		'edit_item'          => sprintf( __( 'Edit %s', 'bright-stars' ), $singular ),
		'new_item'           => sprintf( __( 'New %s', 'bright-stars' ), $singular ),
		'view_item'          => sprintf( __( 'View %s', 'bright-stars' ), $singular ),
		'search_items'       => sprintf( __( 'Search %s', 'bright-stars' ), $plural ),
		'not_found'          => __( 'None found', 'bright-stars' ),
		'all_items'          => $plural,
	);
}

/**
 * Field schema for each post type. Field types:
 *   text, url, textarea, checkbox, select, i18n_text, i18n_textarea, i18n_lines
 *
 * @return array
 */
function bright_stars_cpt_fields() {
	$icons = array(
		'search' => 'Search / SEO', 'target' => 'Target', 'share' => 'Share / social',
		'pen' => 'Pen / content', 'layout' => 'Layout / web', 'compass' => 'Compass / strategy',
		'aperture' => 'Aperture / camera', 'send' => 'Send / launch', 'radio' => 'Signal',
		'megaphone' => 'Megaphone', 'play' => 'Play',
	);

	return array(
		'bs_service' => array(
			array( 'key' => 'icon', 'label' => 'Icon', 'type' => 'select', 'options' => $icons ),
			array( 'key' => 'title', 'label' => 'Title', 'type' => 'i18n_text' ),
			array( 'key' => 'desc', 'label' => 'Description', 'type' => 'i18n_textarea' ),
		),
		'bs_pricing' => array(
			array( 'key' => 'name', 'label' => 'Plan name', 'type' => 'i18n_text' ),
			array( 'key' => 'price', 'label' => 'Price (number, or “Custom”)', 'type' => 'i18n_text' ),
			array( 'key' => 'period', 'label' => 'Period suffix (e.g. OMR / mo)', 'type' => 'i18n_text' ),
			array( 'key' => 'desc', 'label' => 'Short description', 'type' => 'i18n_textarea' ),
			array( 'key' => 'features', 'label' => 'Features (one per line)', 'type' => 'i18n_lines' ),
			array( 'key' => 'cta', 'label' => 'Button label', 'type' => 'i18n_text' ),
			array( 'key' => 'badge', 'label' => 'Badge text (optional)', 'type' => 'i18n_text' ),
			array( 'key' => 'featured', 'label' => 'Highlight as “most popular”', 'type' => 'checkbox' ),
		),
		'bs_team' => array(
			array( 'key' => 'role', 'label' => 'Role', 'type' => 'i18n_text' ),
			array( 'key' => 'quote', 'label' => 'Headline quote', 'type' => 'i18n_text' ),
			array( 'key' => 'bio', 'label' => 'Bio', 'type' => 'i18n_textarea' ),
		),
		'bs_testimonial' => array(
			array( 'key' => 'quote', 'label' => 'Quote', 'type' => 'i18n_textarea' ),
			array( 'key' => 'author', 'label' => 'Author name', 'type' => 'text' ),
			array( 'key' => 'role', 'label' => 'Author role / company', 'type' => 'i18n_text' ),
			array( 'key' => 'initials', 'label' => 'Initials (avatar)', 'type' => 'text' ),
		),
		'bs_client' => array(
			array( 'key' => 'logo', 'label' => 'Logo / profile image', 'type' => 'media', 'desc' => 'The round logo shown in the grid and case-study hero. (You can also use the Featured image.)' ),
			array( 'key' => 'feed', 'label' => 'Instagram feed screenshot (the grid we built)', 'type' => 'media', 'desc' => 'Upload the Instagram grid screenshot — shown in the scrollable “feed we built” window.' ),
			array( 'key' => 'category', 'label' => 'Category', 'type' => 'i18n_text' ),
			array( 'key' => 'tagline', 'label' => 'Tagline', 'type' => 'i18n_text' ),
			array( 'key' => 'brief', 'label' => 'Brief / the challenge', 'type' => 'i18n_textarea' ),
			array( 'key' => 'services', 'label' => 'What we did (one per line)', 'type' => 'i18n_lines' ),
			array( 'key' => 'results', 'label' => 'Results (one per line: value | label)', 'type' => 'i18n_lines' ),
			array( 'key' => 'instagram', 'label' => 'Instagram URL', 'type' => 'url' ),
			array( 'key' => 'handle', 'label' => 'Instagram handle (without @)', 'type' => 'text' ),
			array( 'key' => 'website', 'label' => 'Website URL', 'type' => 'url' ),
			array( 'key' => 'color', 'label' => 'Hero card gradient (CSS, optional)', 'type' => 'text' ),
			array( 'key' => 'soon', 'label' => 'Show as “coming soon” placeholder', 'type' => 'checkbox' ),
		),
	);
}

/**
 * Register meta boxes.
 */
function bright_stars_add_meta_boxes() {
	foreach ( bright_stars_cpt_fields() as $cpt => $fields ) {
		add_meta_box(
			'bs_details',
			__( 'Bright Stars details', 'bright-stars' ),
			'bright_stars_render_meta_box',
			$cpt,
			'normal',
			'high',
			array( 'fields' => $fields )
		);
	}
}
add_action( 'add_meta_boxes', 'bright_stars_add_meta_boxes' );

/**
 * Render a meta box from a field schema.
 */
function bright_stars_render_meta_box( $post, $box ) {
	$fields = $box['args']['fields'];
	wp_nonce_field( 'bright_stars_meta', 'bright_stars_meta_nonce' );
	$langs = array( 'en' => 'English', 'ar' => 'العربية', 'fa' => 'فارسی' );

	echo '<style>.bs-mb{margin:14px 0}.bs-mb>label{display:block;font-weight:600;margin-bottom:6px}.bs-mb input[type=text],.bs-mb input[type=url],.bs-mb textarea,.bs-mb select{width:100%}.bs-mb textarea{min-height:64px}.bs-mb .bs-lang{display:flex;gap:4px;align-items:flex-start;margin-bottom:6px}.bs-mb .bs-lang .tag{flex:none;width:34px;padding-top:6px;color:#646970;font-size:11px;text-transform:uppercase}.bs-mb .bs-lang>div{flex:1}</style>';

	foreach ( $fields as $f ) {
		$key  = $f['key'];
		$type = $f['type'];
		echo '<div class="bs-mb">';
		echo '<label>' . esc_html( $f['label'] ) . '</label>';

		if ( 0 === strpos( $type, 'i18n_' ) ) {
			$sub = substr( $type, 5 ); // text | textarea | lines
			foreach ( $langs as $lg => $lgLabel ) {
				$name = '_bs_' . $key . '_' . $lg;
				$val  = get_post_meta( $post->ID, $name, true );
				echo '<div class="bs-lang"><span class="tag">' . esc_html( strtoupper( $lg ) ) . '</span><div>';
				if ( 'text' === $sub ) {
					printf( '<input type="text" name="%s" value="%s" dir="auto" />', esc_attr( $name ), esc_attr( $val ) );
				} else {
					printf( '<textarea name="%s" dir="auto">%s</textarea>', esc_attr( $name ), esc_textarea( $val ) );
				}
				echo '</div></div>';
			}
			if ( 'lines' === $sub ) {
				echo '<p class="description">' . esc_html__( 'One feature per line.', 'bright-stars' ) . '</p>';
			}
		} elseif ( 'checkbox' === $type ) {
			$name = '_bs_' . $key;
			$val  = get_post_meta( $post->ID, $name, true );
			printf(
				'<label style="font-weight:400"><input type="checkbox" name="%s" value="1" %s /> %s</label>',
				esc_attr( $name ),
				checked( $val, '1', false ),
				esc_html__( 'Yes', 'bright-stars' )
			);
		} elseif ( 'select' === $type ) {
			$name = '_bs_' . $key;
			$val  = get_post_meta( $post->ID, $name, true );
			echo '<select name="' . esc_attr( $name ) . '">';
			foreach ( $f['options'] as $ov => $ol ) {
				printf( '<option value="%s" %s>%s</option>', esc_attr( $ov ), selected( $val, $ov, false ), esc_html( $ol ) );
			}
			echo '</select>';
		} elseif ( 'media' === $type ) {
			$name  = '_bs_' . $key;
			$val   = get_post_meta( $post->ID, $name, true );
			$is_id = is_numeric( $val ) && (int) $val > 0;
			$url   = $is_id ? wp_get_attachment_image_url( (int) $val, 'medium' ) : ( $val ? $val : '' );
			echo '<div class="bs-mb-media">';
			printf( '<input type="hidden" class="bs-mb-media-id" name="%s" value="%s" />', esc_attr( $name ), esc_attr( $val ) );
			printf( '<img src="%s" class="bs-mb-media-prev" alt="" style="display:%s;max-width:170px;max-height:130px;border:1px solid #dcdcde;border-radius:8px;margin:6px 0" />', esc_url( $url ), $url ? 'block' : 'none' );
			echo '<div><button type="button" class="button bs-mb-media-pick">' . esc_html__( 'Select / upload image', 'bright-stars' ) . '</button> ';
			echo '<button type="button" class="button bs-mb-media-clear" style="' . ( $val ? '' : 'display:none' ) . '">' . esc_html__( 'Remove', 'bright-stars' ) . '</button></div>';
			echo '</div>';
		} else {
			$name = '_bs_' . $key;
			$val  = get_post_meta( $post->ID, $name, true );
			printf( '<input type="%s" name="%s" value="%s" />', 'url' === $type ? 'url' : 'text', esc_attr( $name ), esc_attr( $val ) );
		}
		if ( ! empty( $f['desc'] ) ) {
			echo '<p class="description">' . esc_html( $f['desc'] ) . '</p>';
		}
		echo '</div>';
	}

	if ( 'bs_client' === $post->post_type ) {
		echo '<p class="description">' . esc_html__( 'The featured image is used as the client logo. The editor content becomes the case-study body on the client page.', 'bright-stars' ) . '</p>';
	}
	if ( 'bs_team' === $post->post_type ) {
		echo '<p class="description">' . esc_html__( 'The featured image is the member photo; the title is their name.', 'bright-stars' ) . '</p>';
	}
}

/**
 * Save meta box values.
 */
function bright_stars_save_meta( $post_id ) {
	if ( ! isset( $_POST['bright_stars_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bright_stars_meta_nonce'] ) ), 'bright_stars_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$schemas = bright_stars_cpt_fields();
	$cpt     = get_post_type( $post_id );
	if ( ! isset( $schemas[ $cpt ] ) ) {
		return;
	}

	foreach ( $schemas[ $cpt ] as $f ) {
		$key  = $f['key'];
		$type = $f['type'];

		if ( 0 === strpos( $type, 'i18n_' ) ) {
			$sub = substr( $type, 5 );
			foreach ( array( 'en', 'ar', 'fa' ) as $lg ) {
				$name = '_bs_' . $key . '_' . $lg;
				if ( ! isset( $_POST[ $name ] ) ) {
					continue;
				}
				$raw = wp_unslash( $_POST[ $name ] );
				$val = ( 'text' === $sub ) ? sanitize_text_field( $raw ) : sanitize_textarea_field( $raw );
				update_post_meta( $post_id, $name, $val );
			}
		} elseif ( 'checkbox' === $type ) {
			$name = '_bs_' . $key;
			update_post_meta( $post_id, $name, isset( $_POST[ $name ] ) ? '1' : '' );
		} elseif ( 'media' === $type ) {
			$name = '_bs_' . $key;
			if ( isset( $_POST[ $name ] ) ) {
				$raw = wp_unslash( $_POST[ $name ] );
				update_post_meta( $post_id, $name, is_numeric( $raw ) ? (int) $raw : esc_url_raw( $raw ) );
			}
		} elseif ( 'url' === $type ) {
			$name = '_bs_' . $key;
			update_post_meta( $post_id, $name, isset( $_POST[ $name ] ) ? esc_url_raw( wp_unslash( $_POST[ $name ] ) ) : '' );
		} else {
			$name = '_bs_' . $key;
			update_post_meta( $post_id, $name, isset( $_POST[ $name ] ) ? sanitize_text_field( wp_unslash( $_POST[ $name ] ) ) : '' );
		}
	}
}
add_action( 'save_post', 'bright_stars_save_meta' );

/**
 * Load the media library on our CPT edit screens (for image meta fields).
 */
function bright_stars_cpt_media_enqueue( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( $screen && array_key_exists( $screen->post_type, bright_stars_cpt_fields() ) ) {
		wp_enqueue_media();
	}
}
add_action( 'admin_enqueue_scripts', 'bright_stars_cpt_media_enqueue' );

/**
 * Wire up the image pickers in the CPT meta box.
 */
function bright_stars_cpt_media_footer() {
	$screen = get_current_screen();
	if ( ! $screen || ! array_key_exists( $screen->post_type, bright_stars_cpt_fields() ) ) {
		return;
	}
	?>
	<script>
	(function(){
		document.querySelectorAll('.bs-mb-media').forEach(function(box){
			var idField = box.querySelector('.bs-mb-media-id');
			var prev = box.querySelector('.bs-mb-media-prev');
			var clear = box.querySelector('.bs-mb-media-clear');
			box.querySelector('.bs-mb-media-pick').addEventListener('click', function(e){
				e.preventDefault();
				var frame = wp.media({ title: 'Select or upload image', multiple: false, library: { type: 'image' } });
				frame.on('select', function(){
					var a = frame.state().get('selection').first().toJSON();
					idField.value = a.id;
					var src = (a.sizes && a.sizes.medium) ? a.sizes.medium.url : a.url;
					prev.src = src; prev.style.display = 'block'; clear.style.display = '';
				});
				frame.open();
			});
			clear.addEventListener('click', function(e){
				e.preventDefault(); idField.value = ''; prev.src = ''; prev.style.display = 'none'; clear.style.display = 'none';
			});
		});
	})();
	</script>
	<?php
}
add_action( 'admin_footer-post.php', 'bright_stars_cpt_media_footer' );
add_action( 'admin_footer-post-new.php', 'bright_stars_cpt_media_footer' );

/**
 * Helper: fetch ordered items of a CPT.
 *
 * @param string $cpt   Post type.
 * @param int    $limit Max items (-1 for all).
 * @return WP_Post[]
 */
function bright_stars_get_items( $cpt, $limit = -1 ) {
	return get_posts(
		array(
			'post_type'      => $cpt,
			'post_status'    => 'publish',
			'numberposts'    => $limit,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
		)
	);
}
