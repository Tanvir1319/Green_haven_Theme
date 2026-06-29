<?php
/**
 * Basic Comments Template
 *
 * @package Green_Haven_Theme
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="gh-comments-section container p-0">

	<?php if ( have_comments() ) : ?>

		<h3 class="gh-sidebar-title mb-4">
			<?php
			printf(
				esc_html__( '%1$s Comments', 'green-haven-theme' ),
				number_format_i18n( get_comments_number() )
			);
			?>
		</h3>

		<div class="gh-comments-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'div',
					'short_ping'  => true,
					'avatar_size' => 60,
				)
			);
			?>
		</div>

	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_form'         => 'gh-reply-form row',
			'title_reply'        => esc_html__( 'Leave a Reply', 'green-haven-theme' ),
			'title_reply_before' => '<h3 class="gh-sidebar-title mt-5 mb-4">',
			'title_reply_after'  => '</h3>',

			'comment_field'      => '
				<div class="col-12 form-group mb-4">
					<label for="comment" class="gh-form-label">Comment</label>
					<textarea id="comment" name="comment" class="form-control gh-comment-input" rows="5" required></textarea>
				</div>',

			'submit_button'      => '
				<div class="col-12">
					<button type="submit" class="btn gh-btn-green w-100">%4$s</button>
				</div>',

			'label_submit'       => esc_html__( 'Post Comment', 'green-haven-theme' ),
		)
	);
	?>

</div>