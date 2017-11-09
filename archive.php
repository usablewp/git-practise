<?php
/**
 * archive.php
 *
 * The template for displaying archive pages.
 *
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
					<p class="topic"><?php _e( 'Archive', 'firstshow-tekzenit' ); ?></p>
					<h2 class="archive-title">
            <?php
      				if ( is_day() ) {
      					printf( __( 'Daily %s', 'firstshow-tekzenit' ), get_the_date() );
      				} elseif ( is_month() ) {
      					printf( __( 'Monthly %s', 'firstshow-tekzenit' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'firstshow-tekzenit' ) ) );
      				} elseif ( is_year() ) {
      					printf( __( 'Yearly %s', 'firstshow-tekzenit' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'firstshow-tekzenit' ) ) );
      				}
      			?>
          </h2>
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
