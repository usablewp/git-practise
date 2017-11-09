<?php

/*---------------------------------------------------------------------*/
/*------------------ Register and Enqueue scripts ---------------------*/
/*---------------------------------------------------------------------*/

function fst_enqueue_scripts(){

	// Register Vendor Scripts

	$suffix = fst_get_min_suffix();

	// modernizr, hoverintent, superfish, match-height, scrollto, fitvid, owl-carousel
	wp_register_script( 'a11y-accordion', TBE_LIBRARY_JS_VENDOR_URI . 'accessible-accordion.min.js', 'jquery', '0.1.0', true );
	wp_register_script( 'accessible-tabs', TBE_LIBRARY_JS_VENDOR_URI . 'accessible-tabs.min.js', 'jquery', '0.1.0', true );
	wp_register_script( 'accessible-toggles', TBE_LIBRARY_JS_VENDOR_URI . 'accessible-toggles.min.js', 'jquery', '0.1.0', true );

	// Enqueue Vendor Scripts
  wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'vendor', TBE_LIBRARY_JS_VENDOR_URI . 'vendor.js', 'jquery', '0.1.0', true );

	// Enqueue Main Script
	$main_script_uri = TBE_LIBRARY_JS_URI . 'main.js';
	// If a '.min' version of the parent theme main.js file exists, use it.
	if ( file_exists( TBE_LIBRARY_JS_DIR . "main{$suffix}.js" ) ){
			$main_script_uri = TBE_LIBRARY_JS_URI . "main{$suffix}.js";
	}
	wp_enqueue_script( 'main', $main_script_uri, 'jquery', '0.1.0', true );

	wp_localize_script( 'main', 'ajax_object',
    array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'our_locations_link' => get_permalink( get_page_by_path( 'Our Locations' ) ),
			'diabetes_specialist_link' => get_permalink( 322 ) 
		)
	);
}
add_action( 'wp_enqueue_scripts', 'fst_enqueue_scripts' );

/*---------------------------------------------------------------------*/
/*------------------ Register and Enqueue styles ----------------------*/
/*---------------------------------------------------------------------*/
function fst_enqueue_styles(){

	$suffix = fst_get_min_suffix();

	// Enqueue Fonts
	wp_enqueue_style( 'fst-fonts', '//fonts.googleapis.com/css?family=Droid+Sans:400,700' );

	// Enqueue Styles

	// Get the parent theme stylesheet.
	$stylesheet_uri = TBE_THEME_URI . 'style.css';

	// If a '.min' version of the parent theme stylesheet exists, use it.
	if ( $suffix && file_exists( TBE_THEME_DIR . "style{$suffix}.css" ) )
		$stylesheet_uri = TBE_THEME_URI . "style{$suffix}.css";

	wp_enqueue_style( 'main-style', $stylesheet_uri, array(), '0.1.0', 'all' ); // main style.css

}
add_action( 'wp_enqueue_scripts', 'fst_enqueue_styles' );
