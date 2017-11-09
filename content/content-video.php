<?php
/**
 * content-video.php
 *
 * The default template for displaying video content.
 */
?>
<?php
	// Getting article information
	$id 						= get_the_ID();
	$home_thumb 		= wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'home-thumb' );
	$full 					= wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
?>
<!-- <span aria-hidden="true" class="icon-video-camera format-icon"></span> -->
<?php $format = get_post_format(); ?>
<div class="post-format-<?php echo esc_attr( $format ); ?>">
	<!-- Article header -->
	<?php get_template_part( 'parts/single-post-header' ); ?>
	<!-- Article content -->
	<?php get_template_part( 'parts/single-post-content' ); ?>
	<!-- Article footer -->
	<?php get_template_part( 'parts/single-post-footer' ); ?>
</div>
