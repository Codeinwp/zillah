<?php

class Zillah_About_Me extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'Zillah_About_Me', 'description' => __('About me widget.', 'zillah'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('Zillah_About_Me', __('Zillah: About me', 'zillah'), $widget_ops, $control_ops);
	}

	public function widget( $args, $instance ) {

		$title 		= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$image_url 	= isset( $instance['image_url'] ) ? esc_url($instance['image_url']) : '';
		$text 		= apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		if ( $image_url ) {
			echo '<div class="photo-wrapper"><img class="about-photo" src="' . $image_url . '" '. ( $title ? 'alt="'.$title.'"' : 'alt=""' ) . '/></div>';
		}

		?>
		<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['image_url'] 	= esc_url_raw( $new_instance['image_url'] );
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		return $instance;
	}

	public function form( $instance ) {
		$instance 	= wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'image_url' => '') );
		$title 		= strip_tags($instance['title']);
		$text 		= esc_textarea($instance['text']);
		$image_url  = esc_url($instance['image_url']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'zillah'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Enter the URL for your photo', 'zillah'); ?></label>
			<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" type="text" value="<?php echo esc_url($image_url); ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Add your text:', 'zillah'); ?></label>
			<textarea class="widefat" rows="10" cols="16" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
		<?php
	}
}