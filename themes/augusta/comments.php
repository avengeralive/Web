<?php
/**
 * The template for displaying comments
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h4 class="comments-title">
			<?php
			$augusta_comment_count = get_comments_number();
			if ( '1' === $augusta_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'augusta' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $augusta_comment_count, 'comments title', 'augusta' ) ),
					number_format_i18n( $augusta_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h4><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'          => 'ul',
				'short_ping'     => true,
				'avatar_size'	 => 50,
			) );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'augusta' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	?>

	<div class="row justify-content-center">
		<div class="col-md-12">
			<?php $comments_args = array(
				'title_reply_before' => '<h5 id="reply-title" class="comment-reply-title">',
				'title_reply_after' => '</h5>',
			); ?>
			<?php comment_form( $comments_args ); ?>
		</div>
	</div>

</div><!-- #comments -->
