<?php
/**
 * author.php
 *
 * The template for displaying author archive pages.
 */
?>

<?php get_header(); ?>
<div id="main-content" role="main">
	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
		<?php if( function_exists('bcn_display') ) bcn_display(); ?>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<header class="archive-page-header">
					<p class="topic"><?php _e( 'Articles by', 'firstshow-tekzenit' ); ?></p>
					<h2 class="archive-title"><?php echo get_the_author(); ?></h2>
					<?php
						// If the author bio exists, display it.
						if ( get_the_author_meta( 'description' ) ) {
							echo '<p class="author-description">' . the_author_meta( 'description' ) . '</p>';
						}
					?>
					<?php rewind_posts(); ?>
				</header>
			</div>
			<div class="col-sm-8">
				<div class="row">
					<?php get_template_part('loop'); ?>
				</div>
				<?php fst_paging_nav(); ?>
			</div>
			<div class="col-sm-4">
				<?php get_sidebar( 'archive' ); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
