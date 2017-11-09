<?php 
/**
 * sidebar.php
 *
 * The primary sidebar.
 */
?>

<?php if ( is_active_sidebar( 'single-post' ) ) : ?>
	<?php dynamic_sidebar( 'single-post' ); ?>
<?php endif; ?>