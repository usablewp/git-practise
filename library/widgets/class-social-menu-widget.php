<?php
/**
 * Social Menu Widget.
 *
 * @package    The Basics of Everything
 * @author     Naresh Devineni <nareshdevineni@usablewp.com>
 * @copyright  Copyright (c) 2017, Naresh Devineni
 * @license    https://www.gnu.org/licenses/gpl.html
 */

/**
 * Register the widget with WordPress
 */
add_action( 'widgets_init', function(){
  register_widget( 'Social_Menu_Widget' );
});

class Social_Menu_Widget extends WP_Widget {

  /**
	 * Register widget with WordPress.
	 */
  public function __construct() {
    parent::__construct(
     false,
     'TBE Social Menu',
     array( 'description' => __( 'Displays "Social" Menu from the "Menus" area', 'firstshow-tekzenit' ) )
    );
  }

 public function update( $new_instance, $old_instance ) {

    $instance = array();
    $instance['title']     = wp_kses_post( $new_instance['title'] );

    return $instance;
 }

 public function form( $instance ) {
   $title = $instance['title'];
?>
  <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'firstshow-tekzenit' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
  </p>
<?php
 }

  public function widget( $args, $instance ) {
    extract( $args );
    $title                    = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

?>
    <?php echo $before_widget; ?>
    <?php if( ! empty( $title ) ): ?>
      <?php echo $before_title . $title . $after_title; ?>
    <?php endif; ?>  
    <?php get_template_part( 'menu', 'social' ); ?>
    <?php echo $after_widget; ?>
  <?php
  //End of
  }
// End of widget class
}
?>
