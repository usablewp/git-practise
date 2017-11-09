<?php
  $decider = esc_html( get_query_var('decider') );
?>
<?php
$doctors_of_city_query = new WP_Query( array(
    'post_type' => 'our_doctors',
    'tax_query' => array(
        array (
            'taxonomy' => 'city',
            'field' => 'slug',
            'terms' => $decider,
        )
    )
) );
?>
<?php if( $doctors_of_city_query->have_posts() ): ?>
  <?php while( $doctors_of_city_query->have_posts() ): $doctors_of_city_query->the_post(); ?>
    <?php get_template_part( 'parts/individual-doctor' ); ?>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php else: ?>
  <p><?php _e( 'No Doctors Found', 'firstshow-tekzenit' ); ?></p>
<?php endif; ?>
