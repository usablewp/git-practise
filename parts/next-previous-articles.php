<?php
	//Getting Next and Previous Posts
	$next_post 		= get_adjacent_post( true, '', '', 'category' );
	$previous_post 	= get_adjacent_post( true, '', true, 'category' );
?>

<?php if ( ! empty( $next_post ) or ! empty( $previous_post ) ) : ?>
	<div class="next-previous-articles">
    <?php if ( ! empty( $previous_post ) ) : ?>
		<div class="previous-article">
			<?php $prev_page_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous_post->ID ), 'thumbnail' ); ?>
			<div class="article-thumb">
			<?php if( ! empty( $prev_page_thumb[0] ) ) : ?>
				<a href="<?php echo get_the_permalink( $previous_post->ID ); ?>"><img src="<?php echo $prev_page_thumb[0]; ?>" /></a>
			<?php endif; ?>
			</div>
			<div class="link-container">
				<h4><?php _e( 'Previous Article','firstshow-tekzenit' ); ?></h4>
				<a href="<?php echo get_the_permalink( $previous_post->ID ); ?>" class="prev-post-link"><?php echo $previous_post->post_title; ?></a>
			</div>
		</div>
		<?php endif; ?>
		<?php if ( ! empty( $next_post ) ) : ?>
			<?php $page_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'thumbnail' ); ?>
			<div class="next-article">
				<div class="article-thumb">
				<?php if( ! empty( $page_thumb[0] ) ) : ?>
					<a href="<?php echo get_the_permalink( $next_post->ID ); ?>"><img src="<?php echo $page_thumb[0]; ?>" /></a>
				<?php endif; ?>
				</div>
				<div class="link-container">
          <h4><?php _e( 'Next Article','firstshow-tekzenit' ); ?></h4>
					<a href="<?php echo get_the_permalink( $next_post->ID ); ?>" class="next-post-link"><?php echo $next_post->post_title; ?></a>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
