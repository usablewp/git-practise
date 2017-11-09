<?php
/**
 * Repeatable Testimonials Widget.
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
  register_widget( 'Testimonials_Widget' );
});

class Testimonials_Widget extends WP_Widget {

  private $fields;
	private $current_widget_id;

  /**
	 * Register widget with WordPress.
	 */
  public function __construct() {
    parent::__construct(
     false,
     'TBE Testimonials',
     array( 'description' => __( 'Showcase your testimonials', 'firstshow-tekzenit' ) )
    );

    // Get the settings for the testimonial widgets
    $this->fields = array(
      'quote_heading'                  => true,
    	'rating'                          => true,
    	'author_description'              => true,
    	'author_avatar'                   => true,
    	'number_of_testimonial_per_slide' => 1,
    );

  }

 public function update( $new_instance, $old_instance ) {

    $instance = array();
    $instance['title']     = wp_kses_post( $new_instance['title'] );
    $instance['autocycle'] = sanitize_key( $new_instance['autocycle'] );
    $instance['interval']  = absint( $new_instance['interval'] );
    foreach ( $new_instance['testimonials'] as $key => $testimonial ) {
    	$instance['testimonials'][ $key ]['id']     = sanitize_key( $testimonial['id'] );
      $instance['testimonials'][ $key ]['quote_heading']  = wp_kses_post( $testimonial['quote_heading'] );
      $instance['testimonials'][ $key ]['quote']  = wp_kses_post( $testimonial['quote'] );
      $instance['testimonials'][ $key ]['author'] = sanitize_text_field( $testimonial['author'] );
    	if ( $this->fields['author_description'] ) {
    		$instance['testimonials'][ $key ]['author_description'] = sanitize_text_field( $testimonial['author_description'] );
    	}
    	if ( $this->fields['author_avatar'] ) {
    		$instance['testimonials'][ $key ]['author_avatar']      = esc_url_raw( $testimonial['author_avatar'] );
    	}
    	if ( $this->fields['rating'] ) {
    		$instance['testimonials'][ $key ]['rating']             = sanitize_text_field( $testimonial['rating'] );
    	}
    }
    return $instance;
 }

 public function form( $instance ) {
   $title     = empty( $instance['title'] ) ? 'Testimonials' : $instance['title'];
   $autocycle = empty( $instance['autocycle'] ) ? 'no' : $instance['autocycle'];
   $interval  = empty( $instance['interval'] ) ? 5000 : $instance['interval'];

   $testimonials = isset( $instance['testimonials'] ) ? array_values( $instance['testimonials'] ) : array(
     array(
       'id'                 => 1,
       'quote_heading'      => '',
       'quote'              => '',
       'author'             => '',
       'rating'             => 5,
       'author_description' => '',
       'author_avatar'      => '',
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
  		<label for="<?php echo esc_attr( $this->get_field_id( 'autocycle' ) ); ?>"><?php esc_html_e( 'Automatically cycle the carousel:', 'firstshow-tekzenit' ); ?></label>
  		<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'autocycle' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'autocycle' ) ); ?>">
  			<option value="yes"<?php selected( $autocycle, 'yes' ) ?>><?php esc_html_e( 'Yes', 'firstshow-tekzenit' ); ?></option>
  			<option value="no"<?php selected( $autocycle, 'no' ) ?>><?php esc_html_e( 'No', 'firstshow-tekzenit' ); ?></option>
  		</select>
  	</p>
    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'interval' ) ); ?>"><?php esc_html_e( 'Interval (in milliseconds):', 'firstshow-tekzenit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'interval' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'interval' ) ); ?>" type="number" min="0" step="1000" value="<?php echo esc_attr( $interval ); ?>" />
		</p>

    <h4><?php esc_html_e( 'Testimonials', 'firstshow-tekzenit' ); ?></h4>
    <script type="text/template" id="js-testimonial-<?php echo esc_attr( $this->current_widget_id ); ?>">
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-quote_heading"><?php esc_html_e( 'Quote Heading', 'firstshow-tekzenit' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-quote_heading" name="<?php echo esc_attr( $this->get_field_name( 'testimonials' ) ); ?>[{{ id }}][quote_heading]" type="text" value="{{quote_heading}}" />
      </p>
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-quote"><?php esc_html_e( 'Quote', 'firstshow-tekzenit' ); ?></label>
        <textarea rows="4" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-quote" name="<?php echo esc_attr( $this->get_field_name( 'testimonials' ) ); ?>[{{ id }}][quote]">{{quote}}</textarea>
      </p>
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-author"><?php esc_html_e( 'Author', 'firstshow-tekzenit' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-author" name="<?php echo esc_attr( $this->get_field_name( 'testimonials' ) ); ?>[{{ id }}][author]" type="text" value="{{ author }}" />
      </p>
      <?php if ( $this->fields['author_description'] ) : ?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-author_description"><?php esc_html_e( 'Author description', 'firstshow-tekzenit' ); ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-author_description" name="<?php echo esc_attr( $this->get_field_name( 'testimonials' ) ); ?>[{{ id }}][author_description]" type="text" value="{{ author_description }}" />
				</p>
			<?php endif; ?>
      <?php if ( $this->fields['author_avatar'] ) : ?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-author_avatar"><?php esc_html_e( 'Author avatar', 'firstshow-tekzenit' ); ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-author_avatar" name="<?php echo esc_attr( $this->get_field_name( 'testimonials' ) ); ?>[{{ id }}][author_avatar]" type="text" value="{{ author_avatar }}" />
          <img src="{{ author_avatar }}" alt="" />
          <input type="button" style="margin-top: 5px;" onclick="UwpWidgetsMediaUploader.imageUploader.openFileFrame('<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-author_avatar');" class="button button-secondary button-upload-image" value="Upload Image" />
        </p>
			<?php endif; ?>
      <?php if ( $this->fields['rating'] ) : ?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'testimonials' ) ); ?>-{{ id }}-rating"><?php esc_html_e( 'Rating', 'firstshow-tekzenit' ); ?></label>
					<select name="<?php echo esc_attr( $this->get_field_name( 'testimonials' ) ); ?>[{{ id }}][rating]" id="<?php echo esc_attr( $this->get_field_id( 'rating' ) ); ?>-{{ id }}-rating" class="js-rating">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
 					</select>
				</p>
			<?php endif; ?>
      <p>
        <input name="<?php echo esc_attr( $this->get_field_name( 'testimonials' ) ); ?>[{{ id }}][id]" type="hidden" value="{{ id }}" />
        <a href="#" class="js-remove-testimonial"><span class="dashicons dashicons-dismiss"></span> <?php esc_html_e( 'Remove Testimonial', 'firstshow-tekzenit' ); ?></a>
      </p>
    </script>

    <div id="js-testimonials-<?php echo esc_attr( $this->current_widget_id ); ?>">
      <div id="js-testimonials-list"></div>
      <p>
        <a href="#" class="button js-add-testimonial"><?php _e( 'Add New Testimonial', 'firstshow-tekzenit' ); ?></a>
      </p>
    </div>

    <script type="text/javascript">
      ( function(){

        // repopulate the form
				var testimonialsJSON = <?php echo wp_json_encode( $testimonials ) ?>;

        // get the right widget id and remove the added < > characters at the start and at the end.
				var widgetId = '<<?php echo esc_js( $this->current_widget_id ); ?>>'.slice( 1, -1 );

        if ( _.isFunction( testimonialsWidget.render ) ) {
						testimonialsWidget.render( widgetId, testimonialsJSON );
				}

      } )();

    </script>
<?php
  }

  public function widget( $args, $instance ) {
    extract( $args );
    $title                    = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
    $testimonials             = array_values( $instance['testimonials'] );
    $widget_id                = esc_attr( $widget_id );

    $autocycle                = $instance['autocycle'];
    $interval                 = $instance['interval'];

    $autocycle_options        = '';
    if( $autocycle === "yes" ){
      $autocycle_options = '"autoplay":true, "autoplaySpeed":' . $interval;
    } else{
      $autocycle_options = '"autoplay":false';
    }
?>
    <?php echo $before_widget; ?>
    <?php echo $before_title . $title . $after_title; ?>
    <div class="slick-carousel inside-widget" data-slick='{
      "slidesToShow":1,
      "appendArrows":"#<?php echo $widget_id; ?>-navigation",
      "prevArrow":"<button type=\"button\" class=\"slick-prev  slick-arrow\"><span class=\"screen-reader-text\">Previous<\/span><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"><\/i><\/button>",
      "nextArrow":"<button type=\"button\" class=\"slick-next  slick-arrow\"><span class=\"screen-reader-text\">Next<\/span><i class=\"fa fa-arrow-right\" aria-hidden=\"true\"><\/i><\/button>",
      <?php echo $autocycle_options; ?>
    }'>
    <?php foreach ( $testimonials as $testimonial ): ?>
      <div class="individual-testimonial">
        <span class="fa fa-quote-left"></span>
        <h3><?php echo $testimonial['quote_heading']; ?></h3>
        <blockquote>
          <p><?php echo $testimonial['quote']; ?></p>
          <footer>
            <?php if( ! empty( $testimonial['author_avatar'] ) ): ?>
            <div class="it-author-avatar">
              <img src="<?php echo $testimonial['author_avatar']; ?>" alt="<?php echo $testimonial['author']; ?>"/>
            </div>
            <?php endif; ?>
            <div class="it-author-rating">
              <?php $rating = absint( $testimonial['rating'] ); ?>
              <?php for( $i = 1; $i <= $rating; $i++ ) { ?>
                <span class="fa fa-star"></span>
              <?php } ?>
            </div>
            <cite><?php echo $testimonial['author']; ?></cite>
            <div class="it-author-description"><?php echo $testimonial['author_description']; ?></div>
          </footer>
        </blockquote>
      </div>
    <?php endforeach; ?>
    </div>
    <div id="<?php echo $widget_id; ?>-navigation" class="js-testimonials-navigation"></div>
    <?php echo $after_widget; ?>
  <?php
  //End of
  }
// End of widget class
}
?>
