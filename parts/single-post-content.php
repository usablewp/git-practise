<?php global $detect; ?>
<?php
	// Getting article information
	$id 				= get_the_ID();
	$home_thumb 		= wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'home-thumb' );
	$full 				= wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
?>
<!-- Article content -->
	<?php if ( is_single() ): ?>
	<div class="entry-content">
		<?php fst_wp_link_pages(); ?>
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<figure class="entry-thumbnail"><a href="<?php the_permalink(); ?>"><img src="<?php echo $full[0]; ?>" alt="" /></a></figure>
		<?php endif; ?>
		<div class="article-header">
			<h2 class="article-title"><?php the_title(); ?> </h2>
		</div>
		<div class="the-content">
			<?php the_content(); ?>
		</div>
		<div class="the-author">
			<div class="meta-author">
		    <div class="author-avatar">
		      <?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
		    </div>
		    <?php
		      // Get the post author.
		      printf(
		        '<div class="meta-author"><a href="%1$s" rel="author"> Published By %2$s</a></div>',
		        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		        get_the_author()
		      );
		    ?>
		  </div>
		</div>
		<?php
			 fst_wp_link_pages();
			 /*wp_link_pages(array(
		        'before' => '<p>' . __('Pages:'),
		        'after' => '</p>',
		        'next_or_number' => 'next_and_number',
		        'nextpagelink' => __('Next'),
		        'previouspagelink' => __('Previous'),
		        'pagelink' => '%',
		        'echo' => 1 )
		    );*/
		?>
		<?php if( shortcode_exists( 'fbcomments' ) ): ?>
			<?php echo do_shortcode( '[fbcomments count="off" num="5" countmsg="Discussion" title="Discussion"]' ); ?>
		<?php endif; ?>
	</div> <!-- end entry-content -->
	<?php endif; ?>
