<div class="locations-container">
<?php
  $selected_city = esc_html( get_query_var('city') );
  $permalink = get_permalink();
?>
<?php
$city_query = new WP_Query( array(
    'post_type' => 'our_locations',
    'tax_query' => array(
        array (
            'taxonomy' => 'city',
            'field' => 'slug',
            'terms' => $selected_city,
        )
    ),
) );
?>
<?php if( $city_query->have_posts() ): ?>
  <?php while( $city_query->have_posts() ): $city_query->the_post(); ?>
    <div class="location-meta">
      <div class="location-meta-content">
        <h3><?php the_title(); ?></h3>
        <?php the_content(); ?>
        <?php $location_name = get_post_field( 'post_name', get_the_ID() ); ?>
        <a class="know-more" href="<?php echo $permalink .  $selected_city . "/" . $location_name; ?>"><?php _e( 'Know More', 'firstshow-tekzenit' ); ?></a>
      </div>
    </div>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>
</div>
