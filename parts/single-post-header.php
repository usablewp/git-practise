<?php global $detect; ?>
<?php
	// Getting article information
	$id 				= get_the_ID();
	$home_thumb 		= wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'home-thumb' );
	$full 				= wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
?>
<?php if ( ! is_single() ) : ?>
<header class="entry-header">

		<?php
			// If the post has a thumbnail and it's not password protected
			// then display the thumbnail
			if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				<figure class="entry-thumbnail"><a href="<?php the_permalink(); ?>"><img src="<?php echo $home_thumb[0]; ?>" alt="" /></a></figure>
			<?php endif; ?>
			<div class="archive-article-content">
				<h3 class="article-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<div class="article-excerpt">
					<?php the_excerpt(); ?>
				</div>
				<a href="<?php the_permalink(); ?>" class="read-more">
					<?php _e( 'Read More', 'firstshow-tekzenit' ); ?>
				</a>
				<div class="article-meta clearfix">
					<div class="article-date">
						<time><?php echo esc_html( get_the_date() ); ?></time>
					</div>
				</div>
			</div>
</header> <!-- end entry-header -->
<?php endif; ?>
