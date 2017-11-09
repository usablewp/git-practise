<?php
/**
 * Actions and filters for modifying look and feel of third party plugins from wordpress plugin repository.
 *
 * @package    Firstshow-Tekzenit
 * @author     Naresh Devineni <nareshdevineni@usablewp.com>
 * @copyright  Copyright (c) 2016, Naresh Devineni
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

 add_action( 'cmb2_admin_init', 'cmb2_site_metaboxes' );

 /**
  * Define the metabox and field configurations.
  */
 function cmb2_site_metaboxes() {

     // Start with an underscore to hide fields from custom fields list
     $prefix = 'fst_';

     /**
      * Initiate the program eco system metabox
      */
     $cmb = new_cmb2_box( array(
         'id'            => 'program_ecosystem',
         'title'         => __( 'Program Ecosystem', 'firstshow-tekzenit' ),
         'object_types'  => array( 'page' ), // Post type
         'show_on'       => array( 'key' => 'page-template', 'value' => 'page-templates/diabetes-program.php' ),
         'context'       => 'normal',
         'priority'      => 'high',
         'show_names'    => true, // Show field names on the left
         // 'cmb_styles' => false, // false to disable the CMB stylesheet
         // 'closed'     => true, // Keep the metabox closed by default
     ) );

     $program_ecosystem_group = $cmb->add_field( array(
     	'id'          => 'program_ecosystem_group',
     	'type'        => 'group',
     	// 'repeatable'  => false, // use false if you want non-repeatable group
     	'options'     => array(
     		'group_title'   => __( 'Parameter {#}', 'firstshow-tekzenit' ), // since version 1.1.4, {#} gets replaced by row number
     		'add_button'    => __( 'Add Another Parameter', 'firstshow-tekzenit' ),
     		'remove_button' => __( 'Remove Parameter', 'firstshow-tekzenit' ),
     		'sortable'      => true, // beta
     		// 'closed'     => true, // true to have the groups closed by default
     	),
     ) );

     $cmb->add_group_field( $program_ecosystem_group, array(
     	'name' => __( 'Title', 'firstshow-tekzenit' ),
     	'id'   => 'title',
     	'type' => 'text',
     ) );

     $cmb->add_group_field( $program_ecosystem_group, array(
     	'name' => __( 'Content', 'firstshow-tekzenit' ),
     	'id'   => 'content',
     	'type' => 'wysiwyg',
     ) );

     /**
      * Our Locations Post Type
      */

     $cmb2 = new_cmb2_box( array(
         'id'            => 'our_location_fields',
         'title'         => __( 'Location Fields', 'firstshow-tekzenit' ),
         'object_types'  => array( 'our_locations' ), // Post type
         'context'       => 'normal',
         'priority'      => 'high',
         'show_names'    => true, // Show field names on the left
         // 'cmb_styles' => false, // false to disable the CMB stylesheet
         // 'closed'     => true, // Keep the metabox closed by default
     ) );

     $cmb2->add_field( array(
    	'name' => 'Clinic Landmark',
    	'type' => 'text',
    	'id'   => 'clinic_landmark'
     ) );

     $cmb2->add_field( array(
    	'name' => 'Clinic Phone Number',
    	'type' => 'text',
    	'id'   => 'clinic_phone_number'
     ) );

     $cmb2->add_field( array(
    	'name' => 'Clinic Manager Phone Number',
    	'type' => 'text',
    	'id'   => 'clinic_manager_phone_number'
     ) );

     $cmb2->add_field( array(
    	'name' => 'Clinic Email',
    	'type' => 'text',
    	'id'   => 'clinic_email'
     ) );

     $cmb2->add_field( array(
    	'name' => 'Clinic Timing',
    	'type' => 'wysiwyg',
    	'id'   => 'clinic_timing'
     ) );

     $cmb2->add_field( array(
    	'name' => 'Clinic Map',
    	'type' => 'wysiwyg',
    	'id'   => 'clinic_map',
      'sanitization_cb' => false,
     ) );

     /**
      * Our Doctors Post Type
      */

     $cmb3 = new_cmb2_box( array(
         'id'            => 'our_doctors_fields',
         'title'         => __( 'Doctor Information', 'firstshow-tekzenit' ),
         'object_types'  => array( 'our_doctors' ), // Post type
         'context'       => 'normal',
         'priority'      => 'high',
         'show_names'    => true, // Show field names on the left
         // 'cmb_styles' => false, // false to disable the CMB stylesheet
         // 'closed'     => true, // Keep the metabox closed by default
     ) );

     $cmb3->add_field( array(
    	'name' => 'Clinic Location',
    	'type' => 'wysiwyg',
    	'id'   => 'clinic_location'
     ) );

     $cmb3->add_field( array(
    	'name' => 'Experience',
    	'type' => 'text',
    	'id'   => 'experience'
     ) );

     $cmb3->add_field( array(
    	'name' => 'Specialization',
    	'type' => 'wysiwyg',
    	'id'   => 'specialization'
     ) );

     $cmb3->add_field( array(
    	'name' => 'Education',
    	'type' => 'wysiwyg',
    	'id'   => 'education'
     ) );

     $cmb3->add_field( array(
    	'name' => 'Qualification',
    	'type' => 'wysiwyg',
    	'id'   => 'qualification'
     ) );

     $cmb3->add_field( array(
    	'name' => 'Designation',
    	'type' => 'wysiwyg',
    	'id'   => 'designation'
     ) );

     $cmb3->add_field( array(
    	'name' => 'Awards',
    	'type' => 'wysiwyg',
    	'id'   => 'awards'
     ) );

     $cmb3->add_field( array(
    	'name' => 'Certification & Membership',
    	'type' => 'wysiwyg',
    	'id'   => 'certification_and_membership'
     ) );

     $cmb3->add_field( array(
    	'name' => 'Registration Number',
    	'type' => 'wysiwyg',
    	'id'   => 'registration_number'
     ) );


     /**
      * Initiate the Diabetes Complications
      */
     $cmb4 = new_cmb2_box( array(
         'id'            => 'diabetes_complications',
         'title'         => __( 'Diabetes Complications', 'firstshow-tekzenit' ),
         'object_types'  => array( 'page' ), // Post type
         'show_on'       => array( 'key' => 'page-template', 'value' => 'page-templates/diabetes-complications.php' ),
         'context'       => 'normal',
         'priority'      => 'high',
         'show_names'    => true, // Show field names on the left
         // 'cmb_styles' => false, // false to disable the CMB stylesheet
         // 'closed'     => true, // Keep the metabox closed by default
     ) );

     $diabetes_complications_group = $cmb4->add_field( array(
     	'id'          => 'diabetes_complications_group',
     	'type'        => 'group',
     	// 'repeatable'  => false, // use false if you want non-repeatable group
     	'options'     => array(
     		'group_title'   => __( 'Complication {#}', 'firstshow-tekzenit' ), // since version 1.1.4, {#} gets replaced by row number
     		'add_button'    => __( 'Add Another Complication', 'firstshow-tekzenit' ),
     		'remove_button' => __( 'Remove Complication', 'firstshow-tekzenit' ),
     		'sortable'      => false, // beta
     		// 'closed'     => true, // true to have the groups closed by default
     	),
     ) );

     $cmb4->add_group_field( $diabetes_complications_group, array(
     	'name' => __( 'Title', 'firstshow-tekzenit' ),
     	'id'   => 'title',
     	'type' => 'text',
     ) );

     $cmb4->add_group_field( $diabetes_complications_group, array(
     	'name' => __( 'Class Name', 'firstshow-tekzenit' ),
     	'id'   => 'class_name',
     	'type' => 'text',
     ) );

     $cmb4->add_group_field( $diabetes_complications_group, array(
     	'name' => __( 'Link', 'firstshow-tekzenit' ),
     	'id'   => 'link',
     	'type' => 'text_url',
     ) );

}

/**
 * Populate "Book an Appointment Form" City field dynamically
 */

add_filter("gform_pre_render", "dropdown_clinic_city");
add_filter("gform_admin_pre_render", "dropdown_clinic_city");
function dropdown_clinic_city($form){
		if($form["id"] != 3){
        return $form;
    }
		$terms = get_terms( array(
       'taxonomy' => 'city',
       'hide_empty' => false,
    ) );
		foreach($terms as $term)
				$items[] = array( "text" => $term->name, "value" => $term->slug );
		foreach($form["fields"] as &$field){
      	if($field["id"] === 4 ){
						$field["choices"] = $items;
				}
		}
		return $form;
}

/**
 * Populate "Book an Appointment Form" Location field dynamically
 */

function get_location_name_fn(){
    $clinic_city = $_POST['clinicCity'];
    $use_slug = $_POST['useSlug'];
    $items = array();
    if( $clinic_city ){
      $locations = get_posts(array(
          "post_type" => "our_locations",
          "city" => $clinic_city,
          "post_status" => "publish",
          "orderby" => "title",
          "order" => "ASC",
          "posts_per_page"  => -1
      ));
      foreach( $locations as $location ){
          $final_value = '';
          if( $use_slug ){
            $final_value = $location->post_name;
          } else{
            $final_value = $location->post_title;
          }
          $items[] = array( "text" => $location->post_title, "value" => $final_value );
      }
    }
    echo json_encode($items);
    die;
}
add_action('wp_ajax_get_location_name', 'get_location_name_fn');
add_action('wp_ajax_nopriv_get_location_name', 'get_location_name_fn');


function get_doctors_list_fn(){
    $location = $_POST['location'];
    $items = array();
    if( $location ){
      $id = '';
      if ( $post = get_page_by_path( $location, OBJECT, 'our_locations' ) ){
          $id = $post->ID;
          $name = $post->post_title;
          // Find connected pages
          $connected_doctors = new WP_Query( array(
            'connected_type' => 'doctors_to_locations',
            'connected_items' => $id,
            'nopaging' => true,
          ) );

          // Display connected pages
          if ( $connected_doctors->have_posts() ) :
            while ( $connected_doctors->have_posts() ) : $connected_doctors->the_post();
              $doctor_name = get_the_title();
              $slot = p2p_get_meta( get_post()->p2p_id, 'slot', true );
              $items[] = array( 'name' => $doctor_name, 'data' => do_shortcode($slot) );
            endwhile;
            // Prevent weirdness
            wp_reset_postdata();
          endif;
      }
    }
    echo json_encode($items);
    die;
}
add_action('wp_ajax_get_doctors_list', 'get_doctors_list_fn');
add_action('wp_ajax_nopriv_get_doctors_list', 'get_doctors_list_fn');


/**
 * Adding Custom rewrite rules for "Our Locations"
 */

function fst_custom_rewrite_rule() {
    add_rewrite_rule( 'patient-care/diabetes-specialist/([^/]+)', 'index.php?page_id=322&decider=$matches[1]', 'top' );
    add_rewrite_rule( 'diabetes-specialist/([^/]+)', 'index.php?page_id=451&doctor_name=$matches[1]&show_individual_doctor=true', 'top' );
    add_rewrite_rule( 'diabetes-clinics/([^/]+)/([^/]+)', 'index.php?pagename=diabetes-clinics&city=$matches[1]&location=$matches[2]', 'top' );
    add_rewrite_rule( 'diabetes-clinics/([^/]+)', 'index.php?pagename=diabetes-clinics&city=$matches[1]', 'top' );
}

add_action( 'init', 'fst_custom_rewrite_rule' );

/**
 * Registering Query Variables
 */

function fst_register_query_var( $vars ) {
    $vars[] = 'city';
    $vars[] = 'location';
    $vars[] = 'decider';
    $vars[] = 'doctor_name';

    return $vars;
}

add_filter( 'query_vars', 'fst_register_query_var' );

/**
 * Connecting Doctors with Locations
 */

function my_connection_types() {
    p2p_register_connection_type( array(
        'name' => 'doctors_to_locations',
        'from' => 'our_doctors',
        'to' => 'our_locations',
        'fields' => array(
        		'slot' => array(
        			'title' => 'Slot',
        			'type' => 'textarea',
        		)
         )
    ) );
}
add_action( 'p2p_init', 'my_connection_types' );

/**
 * Registering [li] Shortcode
 */

function fst_li_function( $attrs, $content = null ) {
  $return_string = '<li>' . $content . '</li>';
  return $return_string;
}

function fst_register_shortcodes(){
   add_shortcode('li', 'fst_li_function');
}

add_action( 'init', 'fst_register_shortcodes');

function fst_location_slug_exists($post_name) {
    global $wpdb;
    return $wpdb->get_row("SELECT * FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A');

}
