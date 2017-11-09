<?php
/*
Template Name: page builder
*/
?>
<?php get_header(); ?>
		<div id="main-content" role="main">
			<?php if ( have_posts() ) : ?>
      	<?php while ( have_posts() ) : the_post(); ?>
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
      	<?php endwhile; ?>
      <?php else : ?>
      	<?php get_template_part( 'content', 'none' ); ?>
      <?php endif; ?>
		</div> <!-- end of main-content -->
<?php get_footer(); ?>
