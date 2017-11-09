<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */
?>

<?php get_header(); ?>
<?php while( have_posts() ) : the_post(); ?>
	<article <?php post_class( array( 'page-article' ) ); ?>>
		<header>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
				<?php if( function_exists('bcn_display') ) bcn_display(); ?>
			</div>
		</header>
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="article-content">
						<?php get_template_part( 'content/content', get_post_format() ); ?>
					</div>
				</div>
				<div class="col-md-4">
					<?php get_sidebar( 'archive' ); ?>
				</div>
			</div>
		</div>
	</article>
<?php endwhile; ?>
<?php get_footer(); ?>
