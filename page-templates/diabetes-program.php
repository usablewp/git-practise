<?php
/*
Template Name: Diabetes Program
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
      <div class="diabetes-program">
        <div class="content">
          <div>
            <?php the_content(); ?>
          </div>
          <?php
          // If the post has a thumbnail and it's not password protected
  		    // then display the thumbnail
  		    if ( has_post_thumbnail() && ! post_password_required() ) : ?>
  			      <figure class="entry-thumbnail"><?php the_post_thumbnail( 'full' ); ?></figure>
  		    <?php endif; ?>
        </div>
        <div class="program-ecosystem">
          <h3><?php the_title(); ?>  <?php _e( 'ECO-SYSTEM' ); ?></h3>
          <div class="flex-container">
            <?php
                $program_ecosystem_group = get_post_meta( get_the_ID(), 'program_ecosystem_group', true );
    						foreach ( (array) $program_ecosystem_group as $key => $section ) {
                  $content = $title = '';
                  if ( isset( $section['content'] ) ) {
                    $content = $section['content'];
                  }
    							if ( isset( $section['title'] ) ) {
                    $title = esc_html( $section['title'] );
                  }
    					?>
              <div class="section">
  							<h4><?php echo $title; ?></h4>
  							<div><?php echo $content; ?></div>
    					</div>
            <?php } ?>
          </div>
          <?php get_sidebar( 'diabetic-program' ); ?>
        </div>
      </div>
    </article>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
