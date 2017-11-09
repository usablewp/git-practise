<?php
$doctors_query = new WP_Query( array(
    'post_type' => 'our_doctors',
    'posts_per_page' => -1,
) );
?>
<?php if( $doctors_query->have_posts() ): ?>
  <?php while( $doctors_query->have_posts() ): $doctors_query->the_post(); ?>
    <?php get_template_part( 'parts/individual-doctor' ); ?>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php else: ?>
  <p><?php _e( 'No Doctors Found', 'firstshow-tekzenit' ); ?></p>
<?php endif; ?>
