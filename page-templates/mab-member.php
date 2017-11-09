<?php
/*
Template Name: Medical Advisory Member
*/
?>
<?php get_header(); ?>
<div id="main-content" role="main">
  <?php while( have_posts() ): the_post(); ?>
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
              <h4><?php the_field( 'qualification' ); ?></h4>
              <div class="row metadata">
                <div class="doctor-image col-md-2">
                  <?php $doctor_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )[0]; ?>
                  <?php if( empty( $doctor_image ) ): ?>
                    <?php $doctor_image = TBE_LIBRARY_IMAGES_URI . 'dummy-portrait.png'; ?>
                  <?php endif; ?>
                  <img src="<?php echo $doctor_image; ?>" />
                </div>
                <div class="col-md-10">
                  <div class="doctor-information-table">
                    <table>
                      <tr>
                        <th><?php _e( 'Specialty', 'firstshow-tekzenit' ); ?></th>
                        <td><?php the_field('specialty'); ?></td>
                      </tr>
                      <tr>
                        <th><?php _e( 'City', 'firstshow-tekzenit' ); ?></th>
                        <td><?php the_field('city'); ?></td>
                      </tr>
                      <tr>
                        <th><?php _e( 'Clinic Location', 'firstshow-tekzenit' ); ?></th>
                        <td><?php the_field('clinic_location'); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-sm-12">
                  <?php the_content(); ?>
                </div>
              </div>
          </div>
        </div>
      </div>
    </article>
    <?php get_sidebar( 'internal-page-below-main-content' ); ?>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
