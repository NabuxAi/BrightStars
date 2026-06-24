<?php
/**
 * The "Bright Stars" admin panel: a tabbed settings hub plus a setup page.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the menu + submenus. CPTs attach themselves via show_in_menu.
 */
function bright_stars_admin_menu() {
	add_menu_page(
		__( 'Bright Stars', 'bright-stars' ),
		__( 'Bright Stars', 'bright-stars' ),
		'manage_options',
		'bright-stars',
		'bright_stars_render_settings_page',
		'dashicons-star-filled',
		25
	);

	add_submenu_page(
		'bright-stars',
		__( 'Theme Settings', 'bright-stars' ),
		__( 'Theme Settings', 'bright-stars' ),
		'manage_options',
		'bright-stars',
		'bright_stars_render_settings_page'
	);

	add_submenu_page(
		'bright-stars',
		__( 'Setup & Demo Content', 'bright-stars' ),
		__( 'Setup & Demo', 'bright-stars' ),
		'manage_options',
		'bright-stars-setup',
		'bright_stars_render_setup_page'
	);
}
add_action( 'admin_menu', 'bright_stars_admin_menu' );

/**
 * Assets for our admin screens only.
 *
 * @param string $hook Current admin page hook.
 */
function bright_stars_admin_assets( $hook ) {
	if ( false === strpos( $hook, 'bright-stars' ) ) {
		return;
	}
	wp_enqueue_media();
	$css = '
		.bs-admin{max-width:880px}
		.bs-admin .bs-tabs{display:flex;flex-wrap:wrap;gap:4px;border-bottom:1px solid #c3c4c7;margin:16px 0 0}
		.bs-admin .bs-tabs button{background:transparent;border:0;border-bottom:2px solid transparent;padding:10px 16px;cursor:pointer;font-size:14px;color:#50575e}
		.bs-admin .bs-tabs button.active{color:#1d2327;border-bottom-color:#2271b1;font-weight:600}
		.bs-admin .bs-panel{display:none;background:#fff;border:1px solid #c3c4c7;border-top:0;padding:8px 20px 20px}
		.bs-admin .bs-panel.active{display:block}
		.bs-admin .bs-field{padding:14px 0;border-bottom:1px solid #f0f0f1}
		.bs-admin .bs-field>label.bs-flabel{display:block;font-weight:600;margin-bottom:6px}
		.bs-admin input[type=text],.bs-admin input[type=url],.bs-admin input[type=email],.bs-admin textarea,.bs-admin select{width:100%;max-width:520px}
		.bs-admin textarea{min-height:70px}
		.bs-admin .bs-i18n{display:flex;gap:6px;align-items:flex-start;margin:0 0 6px}
		.bs-admin .bs-i18n .tag{flex:none;width:30px;padding-top:6px;color:#646970;font-size:11px;text-transform:uppercase}
		.bs-admin .bs-i18n>div{flex:1;max-width:520px}
		.bs-admin .bs-media-prev{display:block;max-width:160px;max-height:80px;margin:8px 0;border:1px solid #dcdcde;border-radius:6px}
		.bs-admin .description{color:#646970}
	';
	wp_add_inline_style( 'common', $css );
}
add_action( 'admin_enqueue_scripts', 'bright_stars_admin_assets' );

/**
 * Render one settings field.
 *
 * @param array $f Field schema.
 */
function bright_stars_render_field( $f ) {
	$type = $f['type'] ?? 'text';

	if ( 'note' === $type ) {
		echo '<div class="bs-field"><p class="description">' . esc_html( $f['desc'] ) . '</p></div>';
		return;
	}

	$key  = $f['key'];
	$o    = bs_options();
	$name = 'bright_stars_options[' . $key . ']';

	echo '<div class="bs-field">';
	echo '<label class="bs-flabel">' . esc_html( $f['label'] ) . '</label>';

	switch ( $type ) {
		case 'i18n_text':
		case 'i18n_textarea':
			$langs = array( 'en' => 'EN', 'ar' => 'AR', 'fa' => 'FA' );
			foreach ( $langs as $lg => $lglabel ) {
				$k    = $key . '_' . $lg;
				$val  = isset( $o[ $k ] ) ? $o[ $k ] : '';
				$ph   = ! empty( $f['i18n'] ) ? bs_t( $f['i18n'], $lg ) : '';
				$nm   = 'bright_stars_options[' . $k . ']';
				echo '<div class="bs-i18n"><span class="tag">' . esc_html( $lglabel ) . '</span><div>';
				if ( 'i18n_text' === $type ) {
					printf( '<input type="text" name="%s" value="%s" dir="auto" placeholder="%s" />', esc_attr( $nm ), esc_attr( $val ), esc_attr( $ph ) );
				} else {
					printf( '<textarea name="%s" dir="auto" placeholder="%s">%s</textarea>', esc_attr( $nm ), esc_attr( $ph ), esc_textarea( $val ) );
				}
				echo '</div></div>';
			}
			break;

		case 'select':
			$val = isset( $o[ $key ] ) ? $o[ $key ] : ( $f['default'] ?? '' );
			echo '<select name="' . esc_attr( $name ) . '">';
			foreach ( $f['options'] as $ov => $ol ) {
				printf( '<option value="%s" %s>%s</option>', esc_attr( $ov ), selected( $val, $ov, false ), esc_html( $ol ) );
			}
			echo '</select>';
			break;

		case 'multicheck':
			$vals = isset( $o[ $key ] ) && is_array( $o[ $key ] ) ? $o[ $key ] : ( $f['default'] ?? array() );
			foreach ( $f['options'] as $ov => $ol ) {
				printf(
					'<label style="display:inline-block;margin-right:16px;font-weight:400"><input type="checkbox" name="%s[]" value="%s" %s /> %s</label>',
					esc_attr( $name ),
					esc_attr( $ov ),
					checked( in_array( $ov, (array) $vals, true ), true, false ),
					esc_html( $ol )
				);
			}
			break;

		case 'checkbox':
			$val = isset( $o[ $key ] ) ? $o[ $key ] : '';
			printf( '<label style="font-weight:400"><input type="checkbox" name="%s" value="1" %s /> %s</label>', esc_attr( $name ), checked( $val, '1', false ), esc_html__( 'Enabled', 'bright-stars' ) );
			break;

		case 'media':
			$id  = isset( $o[ $key ] ) ? (int) $o[ $key ] : 0;
			$url = $id ? wp_get_attachment_image_url( $id, 'medium' ) : '';
			echo '<div class="bs-media" data-target="' . esc_attr( $name ) . '">';
			printf( '<input type="hidden" name="%s" value="%s" class="bs-media-id" />', esc_attr( $name ), esc_attr( $id ) );
			printf( '<img src="%s" class="bs-media-prev" style="%s" alt="" />', esc_url( $url ), $url ? '' : 'display:none' );
			echo '<button type="button" class="button bs-media-pick">' . esc_html__( 'Select image', 'bright-stars' ) . '</button> ';
			echo '<button type="button" class="button bs-media-clear" style="' . ( $id ? '' : 'display:none' ) . '">' . esc_html__( 'Remove', 'bright-stars' ) . '</button>';
			echo '</div>';
			break;

		default:
			$val   = isset( $o[ $key ] ) ? $o[ $key ] : ( $f['default'] ?? '' );
			$itype = in_array( $type, array( 'url', 'email', 'number' ), true ) ? $type : 'text';
			printf( '<input type="%s" name="%s" value="%s" />', esc_attr( $itype ), esc_attr( $name ), esc_attr( $val ) );
	}

	if ( ! empty( $f['desc'] ) ) {
		echo '<p class="description">' . esc_html( $f['desc'] ) . '</p>';
	}
	echo '</div>';
}

/**
 * Render the tabbed settings page.
 */
function bright_stars_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$schema = bright_stars_settings_schema();
	?>
	<div class="wrap bs-admin">
		<h1><?php esc_html_e( 'Bright Stars — Theme Settings', 'bright-stars' ); ?></h1>
		<p class="description">
			<?php esc_html_e( 'Every text field below accepts English, Arabic and Persian. Leave a field empty to use the built-in translation. Repeatable content (services, pricing, team, testimonials, clients) is managed from the menus on the left.', 'bright-stars' ); ?>
		</p>

		<?php settings_errors(); ?>

		<div class="bs-tabs">
			<?php $i = 0; foreach ( $schema as $slug => $tab ) : ?>
				<button type="button" class="bs-tab-btn <?php echo 0 === $i ? 'active' : ''; ?>" data-tab="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $tab['label'] ); ?></button>
			<?php $i++; endforeach; ?>
		</div>

		<form method="post" action="options.php">
			<?php settings_fields( 'bright_stars_settings_group' ); ?>
			<?php $i = 0; foreach ( $schema as $slug => $tab ) : ?>
				<div class="bs-panel <?php echo 0 === $i ? 'active' : ''; ?>" data-panel="<?php echo esc_attr( $slug ); ?>">
					<?php foreach ( $tab['fields'] as $f ) { bright_stars_render_field( $f ); } ?>
				</div>
			<?php $i++; endforeach; ?>
			<?php submit_button( __( 'Save settings', 'bright-stars' ) ); ?>
		</form>
	</div>

	<script>
	(function(){
		var btns = document.querySelectorAll('.bs-tab-btn');
		var panels = document.querySelectorAll('.bs-panel');
		btns.forEach(function(b){
			b.addEventListener('click', function(){
				btns.forEach(function(x){x.classList.remove('active');});
				panels.forEach(function(p){p.classList.remove('active');});
				b.classList.add('active');
				var t = b.getAttribute('data-tab');
				document.querySelector('.bs-panel[data-panel="'+t+'"]').classList.add('active');
			});
		});
		// Media picker.
		document.querySelectorAll('.bs-media').forEach(function(box){
			var idField = box.querySelector('.bs-media-id');
			var prev = box.querySelector('.bs-media-prev');
			var clear = box.querySelector('.bs-media-clear');
			box.querySelector('.bs-media-pick').addEventListener('click', function(e){
				e.preventDefault();
				var frame = wp.media({title:'Select image', multiple:false});
				frame.on('select', function(){
					var a = frame.state().get('selection').first().toJSON();
					idField.value = a.id;
					var src = (a.sizes && a.sizes.medium) ? a.sizes.medium.url : a.url;
					prev.src = src; prev.style.display=''; clear.style.display='';
				});
				frame.open();
			});
			clear.addEventListener('click', function(e){
				e.preventDefault(); idField.value=''; prev.src=''; prev.style.display='none'; clear.style.display='none';
			});
		});
	})();
	</script>
	<?php
}

/**
 * Inject Google Analytics if an ID is configured.
 */
function bright_stars_analytics() {
	$id = bs_opt( 'google_analytics' );
	if ( ! $id || is_admin() ) {
		return;
	}
	$id = preg_replace( '/[^A-Za-z0-9\-]/', '', $id );
	?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $id ); ?>"></script>
	<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo esc_js( $id ); ?>');</script>
	<?php
}
add_action( 'wp_head', 'bright_stars_analytics', 20 );
