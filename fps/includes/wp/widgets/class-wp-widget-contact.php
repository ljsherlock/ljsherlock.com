<?php

/**
 * Adds Contact_Widget widget.
 */
class Contact_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'contact_widget', // Base ID
			esc_html__( 'Contact', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'An Contact Widget', 'text_domain' ), ) // Args
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
	public function widget( $args, $instance ) {

		$context['options'] = get_fields('options');

		echo $args['before_widget'];
		Timber::render( '_atoms/content/list--contact.twig', $context );
		echo $args['after_widget'];
	}
}
