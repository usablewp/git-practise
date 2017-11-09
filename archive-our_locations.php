<?php get_header(); ?>
<div id="main-content" role="main">
  <header>
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
      <?php if( function_exists('bcn_display') ) bcn_display(); ?>
    </div>
    <h2><?php the_title(); ?></h2>
  </header>
    <article <?php post_class('page-article'); ?>>
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
            <h3><?php _e( 'Find the nearest Apollo Sugar Clinic', 'firstshow-tekzenit' ); ?></h3>
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
        <h3 class="selected-city-name"><?php printf( __( 'City : %s ', 'firstshow-tekzenit' ), $selected_city ) ?></h3>
        <?php while( have_posts() ): the_post(); ?>
          //
        <?php endwhile; ?>
      </div>
    </article>
    <?php get_sidebar( 'internal-page-below-main-content' ); ?>

</div>
<?php get_footer(); ?>
