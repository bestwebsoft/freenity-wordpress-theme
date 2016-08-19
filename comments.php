<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @subpackage Freenity
 * @since      Freenity 1.0
 */

if ( post_password_required() ) {
	return;
} ?>

	<div id="comments" class="comments-area">
		<?php if ( have_comments() ) { ?>
			<h2 class="comments-title">
				<?php printf( _n( 'One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'freenity' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
			</h2>
			<ul class="comment-list">
				<?php wp_list_comments( array(
					'walker'            => null,
					'max_depth'         => 10,
					'style'             => 'ul',
					'callback'          => 'freenity_comment',
					'type'              => 'all',
					'reply_text'        => __( 'Reply', 'freenity' ) . '&nbsp;' . '<i class="fa fa-share"></i>',
					'page'              => '',
					'per_page'          => 5,
					'avatar_size'       => 50,
					'reverse_top_level' => false,
					'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
				) ); ?>
			</ul><!-- .comment-list -->
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
				<div class="freenity-another-comments">
					<div class="freenity-previous-comments"><?php previous_comments_link( '<i class="fa fa-chevron-left"></i> <span>' . __( 'Previous Comments', 'freenity' ) . '</span>' ); ?></div>
					<div class="freenity-next-comments"><?php next_comments_link( '<span>' . __( 'Next Comments', 'freenity' ) . '</span><i class="fa fa-chevron-right"></i>' ); ?></div>
				</div>
				<div class="freenity-clear"></div>
			<?php }
			if ( ! comments_open() && get_comments_number() ) { ?>
				<p class="no-comments"><?php _e( 'Comments are closed.', 'freenity' ); ?></p>
			<?php }
		} ?>
	</div><!-- .comments-area -->
<?php $fields = array(
	'author'  => '<p class="comment-form-author"> <label for="author">' . __( 'Name:', 'freenity' ) . '</label> <span class="required"> *</span> </p>' .
	             '<input id="author" name="author" type="text" size="30" required="required" placeholder="' . __( 'Please enter your full name...', 'freenity' ) . '">',
	'email'   => '<p class="comment-form-email"> <label class="email" for="email">' . __( 'Email:', 'freenity' ) . '</label> <span class="required">*</span></p>' .
	             '<input id="email" name="email" type="text" size="30" required="required" placeholder="' . __( 'Please enter your email address...', 'freenity' ) . '">',
	'website' => '<p class="comment-form-url"><label for="url">' . __( 'Website:', 'freenity' ) . '</label></p>' .
	             '<input id="url" name="url" type="text"  value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . __( 'Please enter your website url...', 'freenity' ) . '">',
);

$comment_args = array(
	/* change the title of send button */
	'label_submit'         => __( 'Post comment', 'freenity' ),
	/* change the title of the reply section */
	'title_reply'          => __( 'Leave a Reply', 'freenity' ),
	/* remove "Text or HTML to be displayed befor the set of comment fields" */
	'comment_notes_before' => __( 'Your email address will not be published. Required fields are marked', 'freenity' ) . '<span class="required">*</span>',
	/* remove "Text or HTML to be displayed after the set of comment fields" */
	'comment_notes_after'  => '',
	/* redefine your own textarea (the comment body) */
	'comment_field'        => '<p class="comment-form-comment"> <label for="comment">' . __( 'Comment:', 'freenity' ) . '</label> <span class="required"> * </span></p>
	</label><textarea id="comment" name="comment" cols="30" rows="8" placeholder="' . __( 'Please enter your message...', 'freenity' ) . ' ">' . '</textarea>',
	'fields'               => $fields,
);
comment_form( $comment_args );
