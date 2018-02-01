<?php
/**
 * Class Zillah_About_Me
 *
 * @package zillah
 */

/**
 * Class Zillah_About_Me
 */
class Zillah_About_Me extends WP_Widget {

	/**
	 * Zillah_About_Me constructor.
	 */
	public function __construct() {
		$widget_ops  = array(
			'classname'   => 'Zillah_About_Me',
			'description' => __( 'About me widget.', 'zillah' ),
		);
		$control_ops = array(
			'width'  => 400,
			'height' => 350,
		);
		parent::__construct( 'Zillah_About_Me', __( 'Zillah: About me', 'zillah' ), $widget_ops, $control_ops );
	}

	/**
	 * Build the widget
	 *
	 * @param array $args Array of arguments.
	 * @param array $instance The instance.
	 */
	public function widget( $args, $instance ) {

		$title     = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$image_url = isset( $instance['image_url'] ) ? esc_url( $instance['image_url'] ) : '';
		$text      = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title'];
		}

		if ( ! empty( $image_url ) ) { ?>
			<div class="photo-wrapper">
				<img class="about-photo" src="<?php echo esc_url( $image_url ); ?>" <?php echo ( ! empty( $title ) ? 'alt="' . esc_attr( $title ) . '"' : 'alt=""' ); ?>/>
			</div>
			<?php
		}

		if ( ! empty( $text ) ) {
		?>
			<div class="textwidget">
				<?php echo wp_kses_post( $text ); ?>
			</div>
			<?php
		}

		echo $args['after_widget'];
	}

	/**
	 * Update the variables in the widget
	 *
	 * @param array $new_instance The new values.
	 * @param array $old_instance The old values that needs to be updated.
	 *
	 * @return mixed
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['image_url'] = esc_url_raw( $new_instance['image_url'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) ); // wp_filter_post_kses() expects slashed
		}
		return $instance;
	}

	/**
	 * The widget form
	 *
	 * @param array $instance The widget instance.
	 */
	public function form( $instance ) {
		$instance  = wp_parse_args(
			(array) $instance, array(
				'title'     => '',
				'text'      => '',
				'image_url' => '',
			)
		);
		$title     = strip_tags( $instance['title'] );
		$text      = esc_textarea( $instance['text'] );
		$image_url = esc_url( $instance['image_url'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'zillah' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo wp_kses_post( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'image_url' ); ?>"><?php _e( 'Enter the URL for your photo', 'zillah' ); ?></label>
			<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" type="text" value="<?php echo esc_url( $image_url ); ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Add your text:', 'zillah' ); ?></label>
			<textarea class="widefat" rows="10" cols="16" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo wp_kses_post( $text ); ?></textarea>
		<?php
	}
}
