<?php
/**
 * tag.php
 *
 * The template for displaying tag pages.
 */
?>
<?php get_header(); ?>
 <div class="blog-posts" role="main">
	 <header>
		 <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
			 <?php if( function_exists('bcn_display') ) bcn_display(); ?>
		 </div>
		 <h2 class="archive-title"><?php printf( __( '%s', 'firstshow-tekzenit' ), single_tag_title( '', false ) ); ?></h2>
	 </header>
		<div class="container">
			<div class="row">
				<div class="categories-list col-sm-12">
					<ul>
					<?php wp_list_categories(array(
						 'title_li' => '',
					 )); ?>
				 </ul>
				</div>
				<div class="col-md-8">
					<div class="row">
						<?php get_template_part('loop'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<?php get_sidebar( 'archive' ); ?>
				</div>
			</div>
		</div>
 </div>
<?php get_footer(); ?>
