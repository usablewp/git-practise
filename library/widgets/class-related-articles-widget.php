<?php
/*
 * Related Articles Widget
 */

 class Related_Articles_Widget extends WP_Widget {
 	/*
	 * Constructor Function
	 */
	 function __construct() {
	 	parent::__construct( false, $name = __( 'TBE Related Articles', 'firstshow-tekzenit' ) );
	 }

	 /*
	  * Widget functions
	  */
	  function widget( $args,$instance ) {
	  	extract( $args );
	  	/** This filter is documented in wp-includes/default-widgets.php */
		  $headline 	= apply_filters( 'widget_title', empty( $instance['headline'] ) ? '' : $instance['headline'], $instance, $this->id_base );
		  $number	  	= ( isset( $instance['number'] ) ) ? $instance['number'] : 7;
	    $columns  	= ( isset( $instance['columns'] ) ) ? $instance['columns'] : 1;
	  echo $before_widget;
		?>
		<?php if ( is_single() ) : ?>
		<div class="more-articles <?php echo 'n-' . $columns . '-col'; ?> type-1">
				<?php $icon_markup = "";?>
				<?php if( ! empty( $headline ) ) : ?>
					<?php echo $before_title . $headline . $after_title; ?>
				<?php endif; ?>
						<?php
							$include_categores 	= wp_get_post_categories( get_the_ID() );
							$post_not_in 		= array();
							$post_not_in[] 		= get_the_ID();
							$related_args		= array(
							    'post_type' 		=> 'post',
							    'post__not_in'		=> $post_not_in,
							    'category__in'		=> $include_categores,
							    'posts_per_page'	=> $number,
							    'ignore_sticky_posts'=> true
							);
							$related_posts = new WP_Query( $related_args );
						?>
						<?php if ( $related_posts->have_posts() ) : ?>
							<ul class="more-articles-container clearfix">
							<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
								<li>
                  <div class="related-article-container">
  									<a href ="<?php the_permalink(); ?>">
  										<div class="morefrom-article-thumb">
  											<?php if( has_post_thumbnail() ) : ?>
  											   <?php $page_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'small-rectangle' ); ?>
  										       <img src="<?php echo $page_thumb[0]; ?>" alt="" />
  											<?php endif; ?>
  										</div>
  									</a>
  									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  </div>
								</li>
							<?php endwhile; ?>
							</ul>
							<?php wp_reset_postdata(); ?>
						<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php echo $after_widget; ?>

	<?php  }

	/*
	 * Update Widget
	 */

    function update( $new_instance, $old_instance ) {
    	$instance = $old_instance;
  		$instance['headline'] = strip_tags( $new_instance['headline'] );
  		$instance['number']   = strip_tags( $new_instance['number'] );
  		$instance['columns']  = $new_instance['columns'];
		return $instance;
    }

	/*
	 * Widget Form
	 */
	 function form( $instance ) {
	 	//headline
	 	$headline 	= ( isset( $instance['headline'] ) ) ? esc_attr( $instance['headline'] ) : '';
	 	$number 	= ( isset( $instance['number'] ) ) ? esc_attr( $instance['number'] ) : 4;
	 	$columns 	= ( isset( $instance['columns'] ) ) ? esc_attr( $instance['columns'] ) : 1;
	 ?>
	 <div class="headline">
	 			<p>
		      		<label for="<?php echo $this->get_field_id( 'headline' ); ?>"><?php _e( 'Headline', 'firstshow-tekzenit' ); ?></label>
		      		<input class="widefat" id="<?php echo $this->get_field_id( 'headline' ); ?>" name="<?php echo $this->get_field_name( 'headline' ); ?>" type="text" value="<?php echo $headline; ?>" />
		      	</p>
	 		</div>
	 <div class="number">
	 			<p>
		      		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts', 'firstshow-tekzenit' ); ?></label>
		      		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" value="<?php echo $number; ?>" />
		      	</p>
	 		</div>
	 <div class="columns">
		 <p>
			<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e( 'Articles in a row', 'firstshow-tekzenit' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'columns' ); ?>" id="<?php echo $this->get_field_id( 'columns' ); ?>" class="widefat">
				<?php $cols = array( 1, 2, 3, 4, 5, 6 ); ?>
				<?php foreach ( $cols as $col ) : ?>
					<option <?php selected( $columns, $col ); ?> value="<?php echo $col; ?>">
						<?php echo $col; ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
	 </div>
	 <?php
	 }
 }
// register Introduction widget
add_action( 'widgets_init', create_function( '', 'return register_widget( "Related_Articles_Widget" );' ) );
