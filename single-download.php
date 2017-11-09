<?php
/* single-download.php
* The template for displaying single edd product.
*/
?>
<?php get_header(); ?>
<div id="main-content" role="main">
  <?php while( have_posts() ): the_post(); ?>
    <article <?php post_class('page-article'); ?>>
      <div class="container">
        <div class="row">
          <div class="col-sm-7 download-content">
            <?php the_content(); ?>
            <?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
          </div>
          <div class="col-sm-5">
            <?php $full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
            <img src="<?php echo $full[0]; ?>"/>
          </div>
        </div>
      </div>
    </article>
    <?php get_sidebar( 'download' ); ?>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>
