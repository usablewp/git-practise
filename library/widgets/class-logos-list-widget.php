<?php
/**
 * Repeatable Logos List.
 * Code taken from https://github.com/proteusthemes/ProteusWidgets and modified to suit the needs of this theme.
 *
 * @package    The Basics of Everything
 * @author     Primoz Cigler
 * @copyright  Primoz Cigler <primoz.cigler@gmail.com>
 * @link       https://github.com/proteusthemes/ProteusWidgets
 * @license    https://www.gnu.org/licenses/gpl.html
 * @depends on Backbone.js, Underscore.js, Jquery
 */

/**
 * Register the widget with WordPress
 */
add_action( 'widgets_init', function(){
  register_widget( 'Logos_List_Widget' );
});

class Logos_List_Widget extends WP_Widget {

  /**
	 * Register widget with WordPress.
	 */
  public function __construct() {
    parent::__construct(
     false,
     'TBE Logos List',
     array( 'description' => __( 'list of websites that your product is featured on', 'firstshow-tekzenit' ) )
    );
  }

 public function update( $new_instance, $old_instance ) {

    $instance = array();
    $instance['title']     = wp_kses_post( $new_instance['title'] );
    $instance['columns']   = sanitize_key( $new_instance['columns'] );

    foreach ( $new_instance['logos_list'] as $key => $logo ) {
      $instance['logos_list'][ $key ]['id']    = sanitize_key( $logo['id'] );
      $instance['logos_list'][ $key ]['name']  = sanitize_key( $logo['name'] );
    	$instance['logos_list'][ $key ]['url']   = esc_url_raw( $logo['url'] );
    }

    return $instance;
 }

 public function form( $instance ) {
   $title     = empty( $instance['title'] ) ? 'Featured On' : $instance['title'];
   $columns   = empty( $instance['columns'] ) ? '4' : $instance['columns'];

   $logos_list = isset( $instance['logos_list'] ) ? array_values( $instance['logos_list'] ) : array(
     array(
       'id'                 => 1,
       'name'               => '',
       'url'                => '',
     ),
   );
   // Page Builder fix when using repeating fields
   if ( 'temp' === $this->id ) {
    $this->current_widget_id = $this->number;
   }
   else {
    $this->current_widget_id = $this->id;
   }
  ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'firstshow-tekzenit' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
  		<label for="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>"><?php esc_html_e( 'Logos per row:', 'firstshow-tekzenit' ); ?></label>
  		<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'columns' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>">
  			<option value="three-columns"<?php selected( $columns, 'three-columns' ) ?>><?php esc_html_e( 'Three', 'firstshow-tekzenit' ); ?></option>
  			<option value="four-columns"<?php selected( $columns, 'four-columns' ) ?>><?php esc_html_e( 'Four', 'firstshow-tekzenit' ); ?></option>
        <option value="five-columns"<?php selected( $columns, 'five-columns' ) ?>><?php esc_html_e( 'Five', 'firstshow-tekzenit' ); ?></option>
        <option value="single-row"<?php selected( $columns, 'single-row' ) ?>><?php esc_html_e( 'Single Row', 'firstshow-tekzenit' ); ?></option>
  		</select>
  	</p>
    <h4><?php esc_html_e( 'Logos List', 'firstshow-tekzenit' ); ?></h4>
    <script type="text/template" id="js-logos-list-<?php echo esc_attr( $this->current_widget_id ); ?>">
      <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'logos_list' ) ); ?>-{{ id }}-name"><?php esc_html_e( 'Name', 'firstshow-tekzenit' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'logos_list' ) ); ?>-{{ id }}-name" name="<?php echo esc_attr( $this->get_field_name( 'logos_list' ) ); ?>[{{ id }}][name]" type="text" value="{{ name }}" />
      </p>
      <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'logos_list' ) ); ?>-{{ id }}-url"><?php esc_html_e( 'Logo', 'firstshow-tekzenit' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'logos_list' ) ); ?>-{{ id }}-url" name="<?php echo esc_attr( $this->get_field_name( 'logos_list' ) ); ?>[{{ id }}][url]" type="text" value="{{ url }}" />
        <img src="{{ url }}" alt="" />
        <input type="button" style="margin-top: 5px;" onclick="UwpWidgetsMediaUploader.imageUploader.openFileFrame('<?php echo esc_attr( $this->get_field_id( 'logos_list' ) ); ?>-{{ id }}-url');" class="button button-secondary button-upload-image" value="Upload Image" />
      </p>
			<p>
        <input name="<?php echo esc_attr( $this->get_field_name( 'logos_list' ) ); ?>[{{ id }}][id]" type="hidden" value="{{ id }}" />
        <a href="#" class="js-remove-logo"><span class="dashicons dashicons-dismiss"></span> <?php esc_html_e( 'Remove Logo', 'firstshow-tekzenit' ); ?></a>
      </p>
    </script>

    <div id="js-logos-<?php echo esc_attr( $this->current_widget_id ); ?>">
      <div id="js-logos-list"></div>
      <p>
        <a href="#" class="button js-add-logo"><?php _e( 'Add New Logo', 'firstshow-tekzenit' ); ?></a>
      </p>
    </div>

    <script type="text/javascript">
      ( function(){

        // repopulate the form
				var logosJSON = <?php echo wp_json_encode( $logos_list ) ?>;

        // get the right widget id and remove the added < > characters at the start and at the end.
				var widgetId = '<<?php echo esc_js( $this->current_widget_id ); ?>>'.slice( 1, -1 );

        if ( _.isFunction( logosListWidget.render ) ) {
						logosListWidget.render( widgetId, logosJSON );
				}

      } )();

    </script>
<?php
  }

  public function widget( $args, $instance ) {
    extract( $args );
    $title                    = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
    $logos_list               = array_values( $instance['logos_list'] );
    $widget_id                = esc_attr( $widget_id );

    $columns                  = $instance['columns'];
?>
    <?php echo $before_widget; ?>
    <?php echo $before_title . $title . $after_title; ?>
    <div class="logos-list <?php echo $columns; ?>">
    <?php foreach ( $logos_list as $logo ): ?>
      <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['name']; ?>"/>
    <?php endforeach; ?>
    </div>
    <?php echo $after_widget; ?>
  <?php
  //End of
  }
// End of widget class
}
?>
