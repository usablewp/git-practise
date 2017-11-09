<?php
/*
Template Name: Patient
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
      <div class="patient-container">
        <div class="patient">
          <?php
          // If the post has a thumbnail and it's not password protected
			    // then display the thumbnail
			    if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				      <figure class="entry-thumbnail"><?php the_post_thumbnail( 'full' ); ?></figure>
			    <?php endif; ?>
          <div class="patient-content">
            <div class="patient-information">
              <div><strong><?php _e( 'Age: ', 'firstshow-tekzenit' ); ?></strong><span><?php the_field('age'); ?></span></div>
              <div><span><?php the_field('additional_information'); ?></span></div>
            </div>
            <?php the_content(); ?>
          </div>
        </div>
        <div class="footer-message">
          <p><?php _e('Know more about our holistic diabetes programs', 'firstshow-tekzenit'); ?></p>
          <a href="<?php the_permalink(43);  ?>" class="know-more"><?php _e( 'Click Here', 'firstshow-tekzenit' ); ?></a>
        </div>
      </div>
    </article>
    <?php get_sidebar( 'internal-page-below-main-content' ); ?>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
