<?php
  $decider = esc_html( get_query_var('decider') );
?>
<?php
$locations_query = new WP_Query( array(
    'post_type' => 'our_locations',
    'name' => $decider,
) );
?>
<?php if( $locations_query->have_posts() ): ?>
  <?php while( $locations_query->have_posts() ): $locations_query->the_post(); ?>
    <?php $location_title = get_the_title(); ?>
    <?php
       // Find connected pages
      $connected_doctors = new WP_Query( array(
        'connected_type' => 'doctors_to_locations',
        'connected_items' => get_the_ID(),
        'nopaging' => true,
      ) );

      // Display connected pages
      if ( $connected_doctors->have_posts() ) :
      ?>

      <?php while ( $connected_doctors->have_posts() ) : $connected_doctors->the_post(); ?>

        <div class="individual-doctor">
          <?php $post_slug = get_post_field( 'post_name', get_the_ID() ); ?>
          <div class="doctor-image">
            <?php $doctor_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )[0]; ?>
            <?php if( empty( $doctor_image ) ): ?>
              <?php $doctor_image = TBE_LIBRARY_IMAGES_URI . 'dummy-portrait.png'; ?>
            <?php endif; ?>
            <img src="<?php echo $doctor_image; ?>" />
          </div>
          <div class="doctor-information-table">
            <h3><?php the_title(); ?></h3>
            <a target="_blank" href="<?php echo home_url('/') . 'diabetes-specialist/' . $post_slug ?>" class="know-more"><?php _e( 'View Profile', 'firstshow-tekzenit' ); ?></a>
            <table>
              <?php $qualification = get_post_meta( get_the_ID(), 'qualification', true ); ?>
              <?php if( ! empty( $qualification ) ): ?>
              <tr>
                <th><?php _e( 'Qualification', 'firstshow-tekzenit' ); ?></th>
                <td><?php echo $qualification; ?></td>
              </tr>
              <?php endif;?>

              <?php $designation = get_post_meta( get_the_ID(), 'designation', true ); ?>
              <?php if( ! empty( $designation ) ): ?>
              <tr>
                <th><?php _e( 'Designation', 'firstshow-tekzenit' ); ?></th>
                <td><?php echo $designation; ?></td>
              </tr>
              <?php endif; ?>
              <tr>
                <th><?php _e( 'City', 'firstshow-tekzenit' ); ?></th>
                <?php $cities = wp_get_post_terms(get_the_ID(), 'city'); ?>
                <td><?php echo $cities[0]->name; ?></td>
              </tr>
            </table>
            <h4><?php _e( 'Location Information', 'firstshow-tekzenit' ); ?></h4>
            <table>
              <tr>
                <th><?php echo $location_title; ?></th>
                <td><?php $slot = p2p_get_meta( get_post()->p2p_id, 'slot', true ); echo do_shortcode( $slot );?></td>
              </tr>
            </table>
          </div>
        </div>
      <?php endwhile; ?>
      <?php
      // Prevent weirdness
      wp_reset_postdata();

      endif;
    ?>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php else: ?>
  <p><?php _e( 'No Doctors Found', 'firstshow-tekzenit' ); ?></p>
<?php endif; ?>
