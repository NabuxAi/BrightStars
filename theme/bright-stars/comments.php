<?php
/**
 * Themed comments template for Bright Stars.
 *
 * Replaces WordPress's default (unstyled) comment markup with markup that
 * matches the theme — a card-based comment list and a form that reuses the
 * site's input styling. All visible strings run through bs_t() so the
 * comments UI follows the EN / AR / FA language switch.
 *
 * @package Bright_Stars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Don't show comments on password-protected posts until the password is entered.
if ( post_password_required() ) {
	return;
}

$bs_commenter = wp_get_current_commenter();
$bs_req       = (bool) get_option( 'require_name_email' );
$bs_req_attr  = $bs_req ? ' required' : '';
$bs_req_star  = $bs_req ? ' <span class="bs-req">*</span>' : '';
?>
<section id="comments" class="bs-comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="bs-comments__title">
			<?php
			$bs_n = (int) get_comments_number();
			if ( 1 === $bs_n ) {
				echo esc_html( bs_t( 'co.one' ) );
			} else {
				printf(
					/* translators: %s: comment count. */
					esc_html( bs_t( 'co.many' ) ),
					'<span class="bs-comments__n">' . esc_html( number_format_i18n( $bs_n ) ) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="bs-commentlist">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 46,
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => bs_icon( bs_is_rtl_lang() ? 'arrow-right' : 'arrow-left', array( 'size' => 16 ) ) . '<span class="screen-reader-text">' . esc_html( bs_t( 'ui.back' ) ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . esc_html( bs_t( 'ui.readmore' ) ) . '</span>' . bs_icon( bs_is_rtl_lang() ? 'arrow-left' : 'arrow-right', array( 'size' => 16 ) ),
			)
		);
		?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="bs-comments__closed"><?php echo esc_html( bs_t( 'co.closed' ) ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_form'           => 'bs-comment-form',
			'title_reply'          => bs_t( 'co.form_title' ),
			'title_reply_to'       => bs_t( 'co.form_title_to' ),
			'title_reply_before'   => '<h3 id="reply-title" class="bs-comments__formtitle">',
			'title_reply_after'    => '</h3>',
			'comment_notes_before' => '<p class="bs-comments__notes">' . esc_html( bs_t( 'co.notes' ) ) . '</p>',
			'comment_notes_after'  => '',
			'label_submit'         => bs_t( 'co.submit' ),
			'class_submit'         => 'bs-btn bs-btn--primary',
			'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
			'comment_field'        => sprintf(
				'<p class="comment-form-comment bs-field"><label for="comment">%1$s <span class="bs-req">*</span></label><textarea id="comment" name="comment" cols="45" rows="6" required></textarea></p>',
				esc_html( bs_t( 'co.comment' ) )
			),
			'fields'               => array(
				'author' => sprintf(
					'<p class="comment-form-author bs-field"><label for="author">%1$s%2$s</label><input id="author" name="author" type="text" value="%3$s" size="30" maxlength="245"%4$s /></p>',
					esc_html( bs_t( 'co.name' ) ),
					$bs_req_star,
					esc_attr( $bs_commenter['comment_author'] ),
					$bs_req_attr
				),
				'email'  => sprintf(
					'<p class="comment-form-email bs-field"><label for="email">%1$s%2$s</label><input id="email" name="email" type="email" value="%3$s" size="30" maxlength="100"%4$s /></p>',
					esc_html( bs_t( 'co.email' ) ),
					$bs_req_star,
					esc_attr( $bs_commenter['comment_author_email'] ),
					$bs_req_attr
				),
				'url'    => sprintf(
					'<p class="comment-form-url bs-field"><label for="url">%1$s</label><input id="url" name="url" type="url" value="%2$s" size="30" maxlength="200" /></p>',
					esc_html( bs_t( 'co.website' ) ),
					esc_attr( $bs_commenter['comment_author_url'] )
				),
			),
		)
	);
	?>
</section>
