<?php
/**
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    The Basics of Everything
 * @subpackage Functions
 * @author     Naresh Devineni <nareshdevineni@usablewp.com>
 * @copyright  Copyright (c) 2016, Naresh Devineni
 * @link       http://usablewp.com/themes/firstshow-tekzenit
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

 // Get the template directory and make sure it has a trailing slash.
 $fst_dir = trailingslashit( get_template_directory() );


/**
 * ----------------------------------------------------------------------------------------
 * 1.0 - Wordpress Built In Customizer
 * ----------------------------------------------------------------------------------------
 */
require_once ( $fst_dir . 'library/customize/customizer.php' );


/**
 * ----------------------------------------------------------------------------------------
 * 1.2 - Load third specific actions and filters
 * ----------------------------------------------------------------------------------------
 */
require_once ( $fst_dir . 'library/includes/third-party-plugin-integration-utilities.php' );


/**
 * ----------------------------------------------------------------------------------------
 * 4.0 - Setting Up Theme.
 * ----------------------------------------------------------------------------------------
 */
add_action( 'after_setup_theme', 'fst_theme_setup_constants', -95 );
add_action( 'after_setup_theme', 'fst_theme_setup', 5 );


// Set up contants
function fst_theme_setup_constants(){

   // Sets the path to the parent theme directory.
   define( 'TBE_THEME_DIR', trailingslashit( get_template_directory() ) );

   //Sets the path to the parent theme directory URI.
   define( 'TBE_THEME_URI', trailingslashit( get_template_directory_uri() ) );

   // Sets the path to the child theme directory.
   define( 'TBE_CHILD_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );

   // Sets the path to the child theme directory URI.
   define( 'TBE_CHILD_THEME_URI', trailingslashit( get_stylesheet_directory_uri() ) );

   // Sets the path to the library directory
   define( 'TBE_LIBRARY_DIR', trailingslashit( TBE_THEME_DIR . 'library' ) );

   // Sets the path to the library URI
   define( 'TBE_LIBRARY_URI', trailingslashit( TBE_THEME_URI . 'library' ) );

   // Sets the path to the library Javascript folder
   define( 'TBE_LIBRARY_JS_DIR', trailingslashit( TBE_LIBRARY_DIR . 'js' ) );

   // Sets the path to the library Javascript folder
   define( 'TBE_LIBRARY_JS_URI', trailingslashit( TBE_LIBRARY_URI . 'js' ) );

   // Sets the path to the library Javascript vendor folder
   define( 'TBE_LIBRARY_JS_VENDOR_URI', trailingslashit( TBE_LIBRARY_JS_URI  . 'vendor' ) );

   // Sets the path to the library Javascript admin folder
   define( 'TBE_LIBRARY_JS_ADMIN_URI', trailingslashit( TBE_LIBRARY_JS_URI  . 'admin' ) );

   // Sets the path to the library CSS folder
   define( 'TBE_LIBRARY_CSS_URI', trailingslashit( TBE_LIBRARY_URI  .'css' ) );

   // Sets the path to the library CSS admin folder
   define( 'TBE_LIBRARY_CSS_ADMIN_URI', trailingslashit( TBE_LIBRARY_CSS_URI  .'admin' ) );

   // Sets the path to the library Images vendor folder
   define( 'TBE_LIBRARY_IMAGES_URI', trailingslashit( TBE_LIBRARY_URI  . 'images' ) );

   // Sets the path to the library Includes folder
   define( 'TBE_LIBRARY_INCLUDES_DIR', trailingslashit( TBE_LIBRARY_DIR  . 'includes' ) );

   // Sets the path to the library Widgets folder
   define( 'TBE_LIBRARY_WIDGETS_DIR', trailingslashit( TBE_LIBRARY_DIR  . 'widgets' ) );
}

// Set up theme features, translation, menus
function fst_theme_setup(){

  // Load Custom widgets
  include_once( TBE_LIBRARY_WIDGETS_DIR . 'class-related-articles-widget.php' );
  include_once( TBE_LIBRARY_WIDGETS_DIR . 'class-social-menu-widget.php' );

  // Register Menus, Sidebars, comments template, other utility functions
  include_once( TBE_LIBRARY_INCLUDES_DIR . 'firstshow-tekzenit.php' );

  // Load custom CSS & Javascript scripts
  include_once( TBE_LIBRARY_INCLUDES_DIR . 'enqueue.php' );

  //Make the theme available for translation.
  load_theme_textdomain( 'firstshow-tekzenit', TBE_THEME_DIR . 'languages' );

  // Post Thumbnails
  add_theme_support( 'post-thumbnails' );

  // Adds core WordPress HTML5 support.
  add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

  // Automatically add <title> to head.
  add_theme_support( 'title-tag' );

   // Add RSS feed links to <head> for posts and comments.
  add_theme_support( 'automatic-feed-links' );

  // Enable Support for Post Formats.
  add_theme_support(
    'post-formats',
    array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' )
  );

  // Adds custom logo support
  add_theme_support(
    'custom-logo',
    array(
      'flex-height' => true,
      'flex-width' => true
    )
  );

  // This theme allows users to set a custom background
  require_once ( TBE_LIBRARY_INCLUDES_DIR . 'custom-background.php' );

  // Set content width
  fst_set_content_width();
}
