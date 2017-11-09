<?php
/*
Template Name: Diabetes Complications
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
          <div class="article-content-container col-sm-12">
            <div class="article-content">
              <?php the_content(); ?>
              <?php
                  $diabetes_complications_group = get_post_meta( get_the_ID(), 'diabetes_complications_group', true );
      						foreach ( (array) $diabetes_complications_group as $key => $complication ) {
                    $classname = $title = $link = '';
                    if ( isset( $complication['class_name'] ) ) {
                      $classname = esc_attr($complication['class_name']);
                    }
      							if ( isset( $complication['title'] ) ) {
                      $title = esc_attr( $complication['title'] );
                    }
                    if ( isset( $complication['link'] ) ) {
                      $link = esc_attr( $complication['link'] );
                    }
      					?>
                <button class="<?php echo $classname; ?>" data-trigger="focus" data-html="true" type="button" data-toggle="popover" data-content="<a target='_blank' href='<?php echo $link; ?>'><?php echo $title; ?></a>"></button>
              <?php } ?>
            </div>
            <div class="diabetes-complications-links-mobile">
              <ul>
              <?php
                  foreach ( (array) $diabetes_complications_group as $key => $complication ) {
                    $classname = $title = $link = '';
                    if ( isset( $complication['class_name'] ) ) {
                      $classname = esc_attr($complication['class_name']);
                    }
      							if ( isset( $complication['title'] ) ) {
                      $title = esc_attr( $complication['title'] );
                    }
                    if ( isset( $complication['link'] ) ) {
                      $link = esc_attr( $complication['link'] );
                    }
      					?>
                <li><a href='<?php echo $link; ?>'><?php echo $title; ?></a></li>
              <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </article>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
