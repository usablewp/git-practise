<?php
/**
 * search.php
 *
 * The template for displaying search results.
 */
?>

<?php get_header(); ?>
<article <?php post_class('page-article'); ?>>
	<header class="search-page-header">
		<p class="topic"><?php _e( 'Search results for', 'firstshow-tekzenit' ); ?></p>
		<h2 class="archive-title"><?php printf( __( '%s', 'firstshow-tekzenit' ), get_search_query() ); ?></h2>
	</header>
	<div class="blog-posts" role="main">
     <div class="container">
       <div class="row">
         <div class="col-sm-8">
           <div class="row">
						 <?php get_template_part('loop'); ?>
					 </div>
         </div>
         <div class="col-sm-4">
           <?php get_sidebar( 'archive' ); ?>
         </div>
       </div>
     </div>
 	</div>
</article>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
