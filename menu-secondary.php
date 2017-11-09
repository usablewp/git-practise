<?php if ( has_nav_menu( 'secondary' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'secondary',
			'container'       => 'div',
			'container_id'    => 'menu-secondary',
			'container_class' => 'menu',
		)
	);

} ?>
