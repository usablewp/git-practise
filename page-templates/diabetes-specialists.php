<?php
/*
Template Name: Diabetes Specialists
*/
?>
<?php
  $decider = esc_html( get_query_var('decider') );
  $city_decider = '';
  $headline_string = str_replace('-', ' ', $decider);
?>
<?php get_header(); ?>
<div id="main-content" role="main">
  <?php while( have_posts() ): the_post(); ?>
    <article <?php post_class('page-article'); ?>>
      <header>
        <?php if( ! empty( $decider ) ):  ?>
          <a href="<?php echo get_permalink(322); ?>" class="custom-breadcrumb">&larr; <?php echo get_the_title(322); ?></a>
        <?php else: ?>
          <a href="<?php echo home_url(); ?>" class="custom-breadcrumb">&larr; <?php _e( 'Home', 'firstshow-tekzenit' ); ?></a>
        <?php endif; ?>
        <?php if( ! empty( $decider ) ): ?>
          <h1><?php printf( __( '%s in %s', 'firstshow-tekzenit' ), get_the_title(), ucwords( $headline_string ) );?></h1>
        <?php else: ?>
          <h1><?php the_title(); ?></h1>
        <?php endif;?>
      </header>
      <div class="diabetes-specialist">
        <?php
        // If the post has a thumbnail and it's not password protected
		    // then display the thumbnail
		    if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			      <figure class="entry-thumbnail"><?php the_post_thumbnail( 'full' ); ?></figure>
		    <?php endif; ?>
        <div class="content">
          <?php the_content(); ?>
          <div class="clinics-filter-form">
              <div class="filter-container">
                  <?php
                    $city_decider = '';
                    if( term_exists( $decider , 'city') ):
                      $city_decider = $decider;
                    else:
                      $result = fst_location_slug_exists( $decider );
                      if( $result ):
                        $terms = wp_get_post_terms( $result['ID'], 'city');
                        $city_decider = $terms[0]->slug;
                      endif;
                    endif;
                  ?>
                  <select name="" id="filter-city" class="filter" placeholder="Select City" required>
                      <option value="" selected><?php _e( 'Select City', 'firstshow-tekzenit' ); ?></option>
                      <?php
                      $terms = get_terms( array(
                         'taxonomy' => 'city',
                         'hide_empty' => false,
                      ) );
                      foreach($terms as $term){
                      ?>
                      <option value="<?php echo $term->slug; ?>" <?php selected( $city_decider, $term->slug ); ?>><?php echo $term->name; ?></option>
                      <?php
                      }
                      ?>
                  </select>

                  <select name="" id="filter-location" class="filter" placeholder="Select Your Area" data-selected = "<?php echo $decider; ?>">
                      <option value=""><?php _e( 'Select Your Area', 'firstshow-tekzenit' ); ?></option>
                  </select>
                  <button id="display-doctors">Submit</button>
              </div>
          </div>
        </div>
        <div class="list-of-doctors">
          <?php if( empty( $decider ) ):?>
            <?php get_template_part( 'parts/all-doctors' ); ?>
          <?php elseif( term_exists( $decider , 'city') ): ?>
            <?php get_template_part( 'parts/doctors-of-city' ); ?>
          <?php elseif( fst_location_slug_exists( $decider ) ): ?>
            <?php get_template_part( 'parts/doctors-of-location' ); ?>
          <?php endif; ?>
        </div>
      </div>
    </article>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
