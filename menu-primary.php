<?php if ( has_nav_menu( 'primary' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'container'       => 'div',
			'container_id'    => 'menu-primary',
			'container_class' => 'menu',
		)
	);

} ?>
