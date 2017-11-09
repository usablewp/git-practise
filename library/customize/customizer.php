<?php
/**
 * Registers options with the Theme Customizer
 *
 * @param      object    $wp_customize    The WordPress Theme Customizer
 * @package    fst
 * @since      0.2.0
 * @version    0.2.0
 */
add_action( 'customize_register', 'fst_customize_register' );
function fst_customize_register( $wp_customize ) {

  // Load JavaScript files.
  add_action( 'customize_preview_init', 'fst_enqueue_customizer_scripts' );

  /**
   * ----------------------------------------------------------------------------------------
   * Enable live preview for wordpress theme features
   * ----------------------------------------------------------------------------------------
   */
  $wp_customize->get_setting( 'blogname' )->transport               = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport        = 'postMessage';
  $wp_customize->get_setting( 'background_color' )->transport       = 'postMessage';
  $wp_customize->get_setting( 'background_image' )->transport       = 'postMessage';
  $wp_customize->get_setting( 'background_position_x' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'background_repeat' )->transport      = 'postMessage';
  $wp_customize->get_setting( 'background_attachment' )->transport  = 'postMessage';

   /**
   * ----------------------------------------------------------------------------------------
   * Changing the priority value of wordpress customizer's default sections and panels
   * ----------------------------------------------------------------------------------------
   */

  //Site Identity
  $wp_customize->get_section('title_tagline')->priority = 1;
  $wp_customize->get_section('title_tagline')->title = __( 'Site Name and Logo', 'firstshow-tekzenit' );

  //Home page preferences
  $wp_customize->get_section('static_front_page')->priority = 2;
  $wp_customize->get_section('static_front_page')->title = __( 'Home page preferences', 'firstshow-tekzenit' );

  //Background Image
  $wp_customize->get_section('background_image')->priority = 4;
  $wp_customize->get_section('background_image')->title = __( 'Site Background Image', 'firstshow-tekzenit' );

  /**
   * ----------------------------------------------------------------------------------------
   * Remove pre-existing "Colors" Section
   * ----------------------------------------------------------------------------------------
   */
   $wp_customize->remove_section("colors");

  /**
   * ----------------------------------------------------------------------------------------
   * 1.0 - Logo Section
   * ----------------------------------------------------------------------------------------
   */

  require_once dirname(__FILE__) . '/parts/logo-options.php';

}
