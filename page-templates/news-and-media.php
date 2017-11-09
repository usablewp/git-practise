<?php
/*
Template Name: News and Media
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
      <div class="news-and-media">
        <div>
          <?php the_content(); ?>
        </div>
        <div class="tabs-container accessible-whistles-tabs">
          <ul class="tabs-links">
            <li class="whistle-title"><a href="#press-release"><?php _e( 'Press Release', 'firstshow-tekzenit' ); ?></a></li>
            <li class="whistle-title"><a href="#image-gallery"><?php _e( 'Image Gallery', 'firstshow-tekzenit' ); ?></a></li>
            <li class="whistle-title"><a href="#electronic-coverage"><?php _e( 'Electronic Coverage', 'firstshow-tekzenit' ); ?></a></li>
          </ul>
          <div class="tabs-content">
            <div class="whistle-content" id="press-release">
              <?php
              $press_release = new WP_Query( array(
                  'post_type' => 'press_gallery',
                  'posts_per_page' => -1,
                  'tax_query' => array(
                      array (
                          'taxonomy' => 'gallery_catergory',
                          'field' => 'slug',
                          'terms' => 'press-release',
                      )
                  )
              ) );
              ?>
              <div class="two-column-gallery">
              <?php while( $press_release->have_posts() ) : $press_release->the_post(); ?>
                <?php $full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
                <?php $square = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'square' ); ?>

                  <a href="<?php echo $full[0]; ?>" class="nf-image-popup" data-effect="mfp-zoom-out">
                    <h3><?php the_title(); ?></h3>
                    <img src="<?php echo $square[0]; ?>" alt="<?php the_title(); ?>" />
                  </a>
              <?php endwhile; ?>
              </div>
              <?php wp_reset_postdata(); ?>
            </div>
            <div class="whistle-content" id="image-gallery">
              <?php
              $image_gallery = new WP_Query( array(
                  'post_type' => 'press_gallery',
                  'posts_per_page' => -1,
                  'tax_query' => array(
                      array (
                          'taxonomy' => 'gallery_catergory',
                          'field' => 'slug',
                          'terms' => 'image-gallery',
                      )
                  )
              ) );
              ?>
              <div class="two-column-gallery">
              <?php while( $image_gallery->have_posts() ) : $image_gallery->the_post(); ?>
                <?php $full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
                <?php $square = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'square' ); ?>

                  <a href="<?php echo $full[0]; ?>" class="nf-image-popup" data-effect="mfp-zoom-out">
                    <h3><?php the_title(); ?></h3>
                    <img src="<?php echo $square[0]; ?>" alt="<?php the_title(); ?>" />
                  </a>
              <?php endwhile; ?>
              </div>
              <?php wp_reset_postdata(); ?>
            </div>
            <div class="whistle-content" id="electronic-coverage">
              <?php
              $electronic_coverage = new WP_Query( array(
                  'post_type' => 'electronic_coverage',
                  'posts_per_page' => -1,
              ) );
              ?>
              <div class="ec-items">
              <?php while( $electronic_coverage->have_posts() ) : $electronic_coverage->the_post(); ?>
                  <div class="ec-item">
                    <time><?php the_field( 'date' ); ?></time>
                    <h3><?php the_title(); ?></h3>
                    <a class="read-more" href="<?php the_field('external_link'); ?>" target="_blank"><?php _e( 'Read More', 'firstshow-tekzenit' ); ?></a>
                  </div>
              <?php endwhile; ?>
              </div>
              <?php wp_reset_postdata(); ?>
            </div>
          </div>
        </div>
      </div>
		</article>
    <?php get_sidebar( 'internal-page-below-main-content' ); ?>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
