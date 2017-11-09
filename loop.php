<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'item article-style-1', 'col-sm-6' ) ); ?>>
			<div>
				<?php $format = get_post_format(); ?>
				<?php get_template_part( 'content/content', $format ); ?>
			</div>
		</article>
	<?php endwhile; ?>
	<?php wp_pagenavi(); ?>
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
