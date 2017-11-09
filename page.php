<?php
/* Page.php
* The template for displaying all pages.
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
      <div class="container">
        <div class="row">
          <div class="article-content-container col-md-8">
            <div class="article-content">
              <?php
              // If the post has a thumbnail and it's not password protected
					    // then display the thumbnail
					    if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						      <figure class="entry-thumbnail"><?php the_post_thumbnail( 'full' ); ?></figure>
					    <?php endif; ?>
              <?php the_content(); ?>
            </div>
          </div>
          <div class="col-md-4">
            <?php
            global $post;     // if outside the loop
              if ( is_page() && $post->post_parent ) { ?>
                <ul class="sub-page-list">
                <?php wp_list_pages( array(
                    'child_of'  => $post->post_parent,
                    'title_li' => '<h3>' . __('Navigation', 'firstshow-tekzenit') . '</h3>',
                ) ); ?>
                </ul>
              <?php } else { ?>
                <ul class="sub-page-list">
                <?php wp_list_pages( array(
                    'child_of'  => $post->ID,
                    'title_li' => '<h3>' . __('Navigation', 'firstshow-tekzenit') . '</h3>',
                ) ); ?>
                </ul>
            <?php }
            ?>
          </div>
        </div>
      </div>
    </article>
    <?php get_sidebar( 'internal-page-below-main-content' ); ?>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
