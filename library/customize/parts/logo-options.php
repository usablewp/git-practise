<?php
$wp_customize->add_section( 'fst_branding', array(
 'title'        => __( 'Logo & Branding', 'firstshow-tekzenit' ),
 'description'	 => __('Upload logo and change styling around it','firstshow-tekzenit'),
'priority'     => 35,
) );

 /* Retina Logo */
 $wp_customize->add_setting( 'fst_retina_logo', array(
  'type'                  => 'theme_mod',
  'capability'            => 'edit_theme_options',
  'sanitize_callback'     => 'fst_sanitize_image_callback',
 ) );
 $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fst_retina_logo', array(
  'label' 		   => __('Logo Retina Version','firstshow-tekzenit'),
  'section' 		 => 'fst_branding',
  'settings'     => 'fst_retina_logo',
 ) ) );

 // Setting for footer text.
 $wp_customize->add_setting(
   'fst_maximum_logo_height', array(
     'default'              => apply_filters( 'theme_mod_maximum_logo_height', '' ),
     'sanitize_callback'    => 'fst_sanitize_number_absint',
     'transport'            => 'postMessage',
 ) );
 // Control for footer text
 $wp_customize->add_control( 'fst_maximum_logo_height', array(
   'type'        => 'number',
   'section'     => 'fst_branding',
   'label'       => 'Maximum Logo Height',
   'description' => 'Enter height in "px"',
 ) );
?>
