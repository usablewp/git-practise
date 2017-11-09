<?php
/*
Template Name: Diabetes Programs
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
      <div class="diabetes-programs">
        <?php the_content(); ?>
        <div class="programs">
          <?php
            $programs = new WP_Query( array(
              'post_parent' => get_the_ID(),
              'post_type' => 'page',
              "order" => 'ASC'
            ) );
          ?>
          <?php if( $programs->have_posts() ):  ?>
            <?php while( $programs->have_posts() ): $programs->the_post(); ?>
              <div class="program">
                <h3><?php the_title(); ?></h3>
                <div class="program-body">
                  <div class="excerpt">
                    <?php the_excerpt(); ?>
                  </div>
                  <a class="know-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e( 'Know More', 'firstshow-tekzenit' ); ?></a>
                </div>
              </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
      </div>
    </article>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
