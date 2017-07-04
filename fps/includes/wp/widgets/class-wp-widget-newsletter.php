<?php

/**
 * Adds Newsletter_Widget widget.
 */
class Newsletter_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'newsletter_widget', // Base ID
			esc_html__( 'Newsletter', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'A Newsletter Widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $c ) {
		echo $args['before_widget'];

		if(!empty($c) ) {
			Timber::render( '_molecules/interface/newsletter.twig', $c );
		}

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		$input_title = ! empty( $instance['input_title'] ) ? $instance['input_title'] : esc_html__( 'New title', 'text_domain' );
		$label = ! empty( $instance['label'] ) ? $instance['label'] : esc_html__( 'New label', 'text_domain' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title :', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>"><?php esc_attr_e( 'Label :', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'label' ) ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'input_title' ) ); ?>"><?php esc_attr_e( 'Submit Text :', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'input_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'input_title' ) ); ?>" type="text" value="<?php echo esc_attr( $input_title ); ?>">
		</p>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['input_title'] = ( ! empty( $new_instance['input_title'] ) ) ? strip_tags( $new_instance['input_title'] ) : '';
		$instance['label'] = ( ! empty( $new_instance['label'] ) ) ? strip_tags( $new_instance['label'] ) : '';

		return $instance;
	}

}
