<?php
	$slider_args = array(
		'post_type' => 'homeslides',
		'order'		=> 'ASC'
	);
	$slider_query = new WP_Query($slider_args);
?>
<?php if( $slider_query->have_posts() ):?>
			<div class="flexslider clearfix">
				<ul class="slides">
					<?php while($slider_query->have_posts()): $slider_query->the_post(); ?>
						<?php if( has_post_thumbnail() ) : ?>
						<li class="slide">
							<?php $page_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'full' ); ?>
							<?php $link = get_field('link'); ?>
							<?php if( ! empty( $link ) ): ?>
	                <a href="<?php echo $link; ?>" target="_blank"><img src="<?php echo $page_thumb[0]; ?>" alt="" /></a>
							<?php else: ?>
									<img src="<?php echo $page_thumb[0]; ?>" alt="" />
							<?php endif; ?>
						</li>
						<?php endif; ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
<?php endif;?>
