<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>
		<div id="main-content" role="main">
			<?php if ( have_posts() ) : ?>
      	<?php while ( have_posts() ) : the_post(); ?>
          <div id="homepage-sections">
						<div class="home-page-intro">
							<?php get_template_part('/parts/slider');?>
							<div id="enquire-form">
								<img src="<?php the_field( 'book_now_image' ); ?>" alt="" />
								<?php the_field('book_now_content'); ?>
								<?php //the_field('enquire_form'); ?>
							</div>
						</div>
						<div class="complications-menu-container">
							<h2><?php _e( 'Complications: ', 'firstshow-tekzenit' ); ?></h2>
							<?php get_template_part( 'menu', 'complications' );?>
						</div>
						<div class="home-content">
							<?php the_content(); ?>
						</div>
					</div>
      	<?php endwhile; ?>
      <?php else : ?>
      	<?php get_template_part( 'content', 'none' ); ?>
      <?php endif; ?>
		</div> <!-- end of main-content -->
<?php get_footer(); ?>
