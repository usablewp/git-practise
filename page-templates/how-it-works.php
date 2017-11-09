<?php
/*
Template Name: How it works
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
      <div class="why-choose-us">
        <?php
        // If the post has a thumbnail and it's not password protected
		    // then display the thumbnail
		    if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			      <figure class="entry-thumbnail"><?php the_post_thumbnail( 'full' ); ?></figure>
		    <?php endif; ?>
        <div>
          <?php the_content(); ?>
        </div>
      </div>
    </article>
    <?php get_sidebar( 'internal-page-below-main-content' ); ?>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
