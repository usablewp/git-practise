<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Not Found).
 */
?>

<?php get_header(); ?>
	<div id="main-content" class="content-404">
		<article <?php post_class('page-article'); ?>>
			<div class="container">
				<div class="row">
					<div class="article-content-container col-sm-12">
						<h2><?php _e( 'Oooops! we are sorry but this page is not available. ', 'firstshow-tekzenit' ); ?></h2>
						<p><?php _e( 'It looks like nothing was found at this location. Please take a look at our sitemap', 'firstshow-tekzenit' ); ?></p>
						<ul class="sub-page-list">
							<?php wp_list_pages( array(
									'title_li' => '<h3>' . __('Site Map', 'firstshow-tekzenit') . '</h3>',
							) ); ?>
						</ul>
					</div>
				</div>
			</div>
		</article>
		<?php get_sidebar( 'error' ); ?>
	</div> <!-- End of content-404 -->
<?php get_footer(); ?>
