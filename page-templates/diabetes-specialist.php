<?php
/*
Template Name: Diabetes Specialist
*/
?>
<?php
  $doctor_name = esc_html( get_query_var('doctor_name') );
?>
<?php get_header(); ?>
<div id="main-content" role="main">
  <?php while( have_posts() ): the_post(); ?>
    <article <?php post_class('page-article'); ?>>
      <?php
      $doctors_query = new WP_Query( array(
          'post_type' => 'our_doctors',
          'name' => $doctor_name,
      ) );
      ?>
      <?php if( $doctors_query->have_posts() ): ?>
        <?php while( $doctors_query->have_posts() ): $doctors_query->the_post(); ?>
          <?php $city = wp_get_post_terms(get_the_ID(), 'city')[0]->name; ?>
          <?php $specialization = wp_get_post_terms(get_the_ID(), 'specialization')[0]->name; ?>
          <header>
            <a href="<?php echo get_permalink(322); ?>" class="custom-breadcrumb">&larr; <?php echo get_the_title(322); ?></a>
            <h1><?php printf( __( '%s - %s in %s', 'firstshow-tekzenit' ), get_the_title(), $specialization, $city ); ?></h1>
          </header>
          <div class="single-doctor container">
            <div class="row">
              <?php $post_slug = get_post_field( 'post_name', get_the_ID() ); ?>
              <div class="doctor-image col-md-3">
                <?php $doctor_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )[0]; ?>
                <?php if( empty( $doctor_image ) ): ?>
                  <?php $doctor_image = TBE_LIBRARY_IMAGES_URI . 'dummy-portrait.png'; ?>
                <?php endif; ?>
                <img src="<?php echo $doctor_image; ?>" />
              </div>
              <div class="doctor-information col-md-9">
                <div class="row">
                  <div class="col-sm-12 introduction">
                    <h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>
                  </div>
                  <div class="section-metadata col-md-6">
                    <?php $experience = get_post_meta( get_the_ID(), 'experience', true ); ?>
                    <?php if( ! empty( $experience ) ): ?>
                    <div class="experience">
                      <h4><?php _e( 'Experience', 'firstshow-tekzenit' ); ?></h4>
                      <p><?php echo $experience; ?></p>
                    </div>
                    <?php endif;?>

                    <?php if( ! empty( $specialization ) ): ?>
                    <div class="specialization">
                      <h4><?php _e( 'Specialization', 'firstshow-tekzenit' ); ?></h4>
                      <p><?php echo $specialization; ?></p>
                    </div>
                    <?php endif;?>

                    <?php $education = get_post_meta( get_the_ID(), 'education', true ); ?>
                    <?php if( ! empty( $education ) ): ?>
                    <div class="education">
                      <h4><?php _e( 'Education', 'firstshow-tekzenit' ); ?></h4>
                      <p><?php echo $education; ?></p>
                    </div>
                    <?php endif;?>

                    <?php $qualification = get_post_meta( get_the_ID(), 'qualification', true ); ?>
                    <?php if( ! empty( $qualification ) ): ?>
                    <div class="qualification">
                      <h4><?php _e( 'Qualification', 'firstshow-tekzenit' ); ?></h4>
                      <p><?php echo $qualification; ?></p>
                    </div>
                    <?php endif;?>

                    <?php $designation = get_post_meta( get_the_ID(), 'designation', true ); ?>
                    <?php if( ! empty( $designation ) ): ?>
                    <div class="designation">
                      <h4><?php _e( 'Designation', 'firstshow-tekzenit' ); ?></h4>
                      <p><?php echo $designation; ?></p>
                    </div>
                    <?php endif;?>
                  </div>
                  <div class="section-location-information col-md-6">
                    <div class="city">
                      <h4><?php _e( 'City', 'firstshow-tekzenit' ); ?></h4>
                      <p><?php echo $city; ?></p>
                    </div>
                    <div class="locations">
                      <h4><?php _e( 'Locations', 'firstshow-tekzenit' ); ?></h4>
                      <table>
                        <?php
                           // Find connected pages
                          $connected_locations = new WP_Query( array(
                            'connected_type' => 'doctors_to_locations',
                            'connected_items' => get_the_ID(),
                            'nopaging' => true,
                          ) );

                          // Display connected pages
                          if ( $connected_locations->have_posts() ) :
                          ?>
                          <tr>
                            <th><?php _e( 'Location', 'firstshow-tekzenit' ); ?></th>
                            <th><?php _e( 'Slot', 'firstshow-tekzenit' ); ?></th>
                          </tr>
                          <?php $slot = p2p_get_meta( get_post()->p2p_id, 'slot', true ); echo do_shortcode( $slot );?>
                          <?php while ( $connected_locations->have_posts() ) : $connected_locations->the_post(); ?>

                            <tr>
                              <th><?php the_title(); ?></th>
                              <td><?php $slot = p2p_get_meta( get_post()->p2p_id, 'slot', true ); echo do_shortcode( $slot );?></td>
                            </tr>
                          <?php endwhile; ?>
                          <?php
                          // Prevent weirdness
                          wp_reset_postdata();

                          endif;
                        ?>
                      </table>
                    </div>

                    <?php $awards = get_post_meta( get_the_ID(), 'awards', true ); ?>
                    <?php if( ! empty( $awards ) ): ?>
                    <div class="awards">
                      <h4><?php _e( 'Awards', 'firstshow-tekzenit' ); ?></h4>
                      <p><?php echo $awards; ?></p>
                    </div>
                    <?php endif;?>

                    <?php $registration_number = get_post_meta( get_the_ID(), 'registration_number', true ); ?>
                    <?php if( ! empty( $registration_number ) ): ?>
                    <div class="registration-number">
                      <h4><?php _e( 'Registration', 'firstshow-tekzenit' ); ?></h4>
                      <p><?php echo $registration_number; ?></p>
                    </div>
                    <?php endif;?>

                    <?php $certification_and_membership = get_post_meta( get_the_ID(), 'certification_and_membership', true ); ?>
                    <?php if( ! empty( $certification_and_membership ) ): ?>
                    <div class="certification-and-membership">
                      <h4><?php _e( 'Certification & Membership', 'firstshow-tekzenit' ); ?></h4>
                      <p><?php echo $certification_and_membership; ?></p>
                    </div>
                    <?php endif;?>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php else: ?>
        <p><?php _e( 'No Doctors Found', 'firstshow-tekzenit' ); ?></p>
      <?php endif; ?>
    </article>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
