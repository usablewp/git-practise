<?php if ( has_nav_menu( 'complications' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'complications',
			'container'       => 'div',
			'container_id'    => 'menu-complications',
			'container_class' => 'complications',
		)
	);

} ?>
