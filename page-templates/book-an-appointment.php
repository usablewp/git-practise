<?php
/*
Template Name: Book and Appointment
*/
?>
<?php get_header(); ?>
		<div id="main-content" class="appointment-bg" role="main" style="background-image:url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )[0]; ?>)">
			<?php if ( have_posts() ) : ?>
      	<?php while ( have_posts() ) : the_post(); ?>
          <div class="book-an-appointment-content">
						<?php the_content(); ?>
          </div>
				<?php endwhile; ?>
      <?php else : ?>
      	<?php get_template_part( 'content', 'none' ); ?>
      <?php endif; ?>
		</div> <!-- end of main-content -->
<?php get_footer(); ?>
