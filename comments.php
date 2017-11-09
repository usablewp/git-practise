<?php
/**
 * comments.php
 *
 * The template for displaying comments.
 */
?>

<?php
	// Prevent the direct loading of comments.php.
	if ( ! empty( $_SERVER['SCRIPT-FILENAME'] ) && basename( $_SERVER['SCRIPT-FILENAME'] ) == 'comments.php' ) {
		die( __( 'You cannot access this page directly.', 'firstshow-tekzenit' ) );
	}
?>

<?php
	// If the post is password protected, display info text and return.
	if ( post_password_required() ) : ?>
		<p>
			<?php
				_e( 'This post is password protected. Enter the password to view the comments.', 'firstshow-tekzenit' );

				return;
			?>
		</p>
<?php endif; ?>
<div class="comments-area" id="comments">
	<h3 class="comments-title">
		<?php
			if ( have_comments() ) :
				printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'Comment title', 'firstshow-tekzenit' ), number_format_i18n( get_comments_number() ) );
			else:
				_e( 'Comments', 'firstshow-tekzenit' );
			endif;
		?>
	</h3>
	<?php // If Comments for this post are closed. ?>
	<?php if ( ! comments_open() ) : ?>
		<p class="comments-closed">
			<?php _e( 'Sorry, Discussion is closed.', 'firstshow-tekzenit' ); ?>
		</p>
	<?php endif; ?>

	<?php // If the post is open for comments but there are no comments. ?>
	<?php if ( ! have_comments() && comments_open()  ) :?>
		<p class="no-comments-message"><?php _e( 'Whoa! It looks like there are no comments yet, Be the first one to comment :)', 'firstshow-tekzenit' ); ?></p>
	<?php endif; ?>

	<?php // If the post is open for comments and there are comments. ?>
	<?php if ( have_comments() ) : ?>
		<ol class="comments clearfix">
			<?php wp_list_comments( array( 'callback' => 'fst_comment', 'style' => 'ol' ) ); ?>
		</ol>

		<?php
			// If the comments are paginated, display the controls.
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="comment-nav" role="navigation">
			<p class="comment-nav-prev">
				<?php previous_comments_link( '<span aria-hidden="true" class="icon-arrow-left"></span><span class="older-posts">' . __( 'Older comments', 'firstshow-tekzenit' ) . '</span>' ); ?>
			</p>

			<p class="comment-nav-next">
				<?php next_comments_link( '<span class="newer-posts">' . __( 'Newer comments', 'firstshow-tekzenit' ) . '</span><span aria-hidden="true" class="icon-arrow-right"></span>' ); ?>
			</p>
		</nav> <!-- end comment-nav -->
		<?php endif; ?>
	<?php endif; ?>
	<?php //If this is open for comments, then display comment form ?>
	<?php if( comments_open() ): ?>
		<?php $comment_args = array(
				'comment_notes_before'	=> '<p class="required-message">'. __( 'Fields with ( * ) are required', 'firstshow-tekzenit' ) .'</p>',
				'title_reply'						=> __( 'We would love your opinion', 'firstshow-tekzenit'  ),
				'comment_field' 				=> '<p>' .
	                '<label for="comment">' . __( 'Let us know what you have to say:', 'firstshow-tekzenit' ) . '</label>' .
	                '<textarea id="comment" name="comment" cols="45" rows="6" aria-required="true"></textarea>' .
	                '</p>',
				'comment_notes_after'		=> '',
			  );
		?>
		<?php comment_form( $comment_args ); ?>
	<?php endif; ?>
</div>
