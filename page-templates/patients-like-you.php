<?php
/*
Template Name: Patients Like You
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
            <div class="container patients-container">
  						<div class="row">
  							<div class="article-content-container col-sm-12">
                  <div class="patients-like-you">
                    <?php
                      $patient_categories = new WP_Query( array(
                        'post_parent' => get_the_ID(),
                        'post_type' => 'page',
                        "order" => 'ASC'
                      ) );
                    ?>
                    <?php if( $patient_categories->have_posts() ):  ?>
                      <?php while( $patient_categories->have_posts() ): $patient_categories->the_post(); ?>
                        <div class="patient-box">
                          <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )[0]; ?>" alt="<?php the_title(); ?>"/>
                          <div class="patient-information">
                            <div><strong><?php _e( 'Age: ', 'firstshow-tekzenit' ); ?></strong><span><?php the_field('age'); ?></span></div>
                            <div><span><?php the_field('additional_information'); ?></span></div>
                          </div>
                          <a href="<?php the_permalink(); ?>" class="know-more"><?php _e( 'Know More', 'firstshow-tekzenit' ); ?></a>
                        </div>
                      <?php endwhile; ?>
                      <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                  </div>
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
