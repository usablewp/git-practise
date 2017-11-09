<?php
/*
Template Name: Our Locations
*/
?>
<?php
  $selected_city = get_query_var('city');
  $selected_location = get_query_var('location');
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
      <div class="our-locations">
        <?php
        // If the post has a thumbnail and it's not password protected
		    // then display the thumbnail
		    if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			      <figure class="entry-thumbnail"><?php the_post_thumbnail( 'full' ); ?></figure>
		    <?php endif; ?>
        <div class="content">
          <?php the_content(); ?>
        </div>
        <div class="clinics-filter-form">
            <h2><?php _e( 'Find the nearest Apollo Sugar Clinic', 'firstshow-tekzenit' ); ?></h2>
            <div class="filter-container">
                <select name="" id="filter-city" class="filter" placeholder="Select City">
                    <option value="" selected><?php _e( 'Select City', 'firstshow-tekzenit' ); ?></option>
                    <?php
                    $terms = get_terms( array(
                       'taxonomy' => 'city',
                       'hide_empty' => false,
                    ) );
                    foreach($terms as $term){
                    ?>
                    <option value="<?php echo $term->slug; ?>" <?php selected( $selected_city, $term->slug ); ?>><?php echo $term->name; ?></option>
                    <?php
                    }
                    ?>
                </select>

                <select name="" id="filter-location" class="filter" placeholder="Select Location" data-selected = "<?php echo $selected_location; ?>">
                    <option value=""><?php _e( 'Select Your Area', 'firstshow-tekzenit' ); ?></option>
                </select>
                <button id="display-locations">Submit</button>
            </div>
        </div>
        <?php if( ! empty( $selected_city ) ) : ?>
          <h2 class="selected-city-name"><?php printf( __( 'City : %s ', 'firstshow-tekzenit' ), $selected_city ) ?></h2>
        <?php endif; ?>
        <?php if( $selected_city &&  $selected_location ): ?>
          <?php get_template_part( 'parts/city_and_location' ); ?>
        <?php else: ?>
          <?php get_template_part( 'parts/city' ); ?>
        <?php endif; ?>
      </div>
    </article>
    <?php get_sidebar( 'internal-page-below-main-content' ); ?>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
