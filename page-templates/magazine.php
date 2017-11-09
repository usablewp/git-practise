<?php
/*
Template Name: Magazine
*/
?>
<?php get_header(); ?>
		<div id="main-content" role="main">
      <?php if ( have_posts() ) : ?>
      	<?php while ( have_posts() ) : the_post(); ?>
          <article <?php post_class('page-article'); ?>>
            <header>
              <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
                <?php if( function_exists('bcn_display') ) bcn_display(); ?>
              </div>
              <h1><?php the_title(); ?></h1>
            </header>
  					<div class="container give-me-some-room">
  						<div class="row">
                <div class="col-sm-12">
                  <?php the_content(); ?>
                </div>
  							<div class="col-sm-12">
                  <?php
                  $magazine = new WP_Query( array(
                      'post_type' => 'magazine',
                      'posts_per_page' => -1,
                      'order' => 'ASC'
                  ) );
                  ?>
                  <div class="magazine-items">
                  <?php while( $magazine->have_posts() ) : $magazine->the_post(); ?>
                      <div class="magazine-item">
                        <?php $full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
                        <img src="<?php echo $full[0]; ?>" alt="<?php the_title(); ?>" />
                        <?php the_content(); ?>
                      </div>
                  <?php endwhile; ?>
                  </div>
                  <?php wp_reset_postdata(); ?>
  							</div>
  						</div>
  					</div>
          </article>
      	<?php endwhile; ?>
      <?php else : ?>
      	<?php get_template_part( 'content', 'none' ); ?>
      <?php endif; ?>
		</div> <!-- end of main-content -->
<?php get_footer(); ?>
