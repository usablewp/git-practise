<?php
  $selected_city = esc_html( get_query_var('city') );
  $selected_location = esc_html( get_query_var('location') );
?>
<?php
$location_query = new WP_Query( array(
    'post_type' => 'our_locations',
    'name' => $selected_location,
    'tax_query' => array(
        array (
            'taxonomy' => 'city',
            'field' => 'slug',
            'terms' => $selected_city,
        )
    ),
) );
?>
<?php if( $location_query->have_posts() ): ?>
  <?php while( $location_query->have_posts() ): $location_query->the_post(); ?>
    <div class="location-information">
      <div class="location-content">
        <h3><?php the_title(); ?></h3>
        <?php $content = get_the_content(); ?>
        <?php $clinic_map = get_post_meta( get_the_ID(), 'clinic_map', true ); ?>
        <?php echo $content; ?>
        <div class="additional-information">
          <h4><?php _e( 'Clinic Information', 'firstshow-tekzenit' ); ?></h4>
          <table class="clinic-metadata">
            <tbody>
              <?php if( $clinic_landmark = get_post_meta( get_the_ID(), 'clinic_landmark', true ) ): ?>
              <tr>
                <th><?php _e( 'Clinic Landmark', 'firstshow-tekzenit' ); ?></th>
                <td><?php echo $clinic_landmark; ?></td>
              </tr>
              <?php endif; ?>
              <?php if( $clinic_phone_number = get_post_meta( get_the_ID(), 'clinic_phone_number', true ) ): ?>
              <tr>
                <th><?php _e( 'Clinic Phone Number', 'firstshow-tekzenit' ); ?></th>
                <td><?php echo $clinic_phone_number; ?></td>
              </tr>
              <?php endif; ?>
              <?php if( $clinic_manager_phone_number = get_post_meta( get_the_ID(), 'clinic_manager_phone_number', true ) ): ?>
              <tr>
                <th><?php _e( 'Clinic Manager Phone Number', 'firstshow-tekzenit' ); ?></th>
                <td><?php echo $clinic_manager_phone_number; ?></td>
              </tr>
              <?php endif; ?>
              <?php if( $clinic_email = get_post_meta( get_the_ID(), 'clinic_email', true ) ): ?>
              <tr>
                <th><?php _e( 'Clinic Email', 'firstshow-tekzenit' ); ?></th>
                <td><?php echo $clinic_email; ?></td>
              </tr>
              <?php endif; ?>
              <?php if( $clinic_timing = get_post_meta( get_the_ID(), 'clinic_timing', true ) ): ?>
              <tr>
                <th><?php _e( 'Clinic Timing', 'firstshow-tekzenit' ); ?></th>
                <td><?php echo $clinic_timing; ?></td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
          <h4><?php _e( 'Doctors Available', 'firstshow-tekzenit' ); ?></h4>
          <table class="clinic-metadata doctors">
            <tbody>
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
                  <tr>
                    <th><?php the_title(); ?></th>
                    <td>
                      <ul>
                        <?php $slot = p2p_get_meta( get_post()->p2p_id, 'slot', true ); echo do_shortcode( $slot );?>
                      </ul>
                    </td>
                  </tr>
                <?php endwhile; ?>
                <?php
                // Prevent weirdness
                wp_reset_postdata();

                endif;
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="location-map">
        <?php echo $clinic_map; ?>
      </div>
    </div>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>
