<?php

/**
 * Adds Address_Widget widget.
 */
class Address_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'address_widget', // Base ID
			esc_html__( 'Address', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'An Address Widget', 'text_domain' ), ) // Args
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
	public function widget( $args, $instance )
	{
		// getting the fields manually rather than get context and waste data.
		$c['options'] = get_fields('options');
		$c['address'] = $c['options']['address'];
		// $c['href'] = $c['address']

		$die = implode(', ', array_map(function ($entry) {
		  return $entry['line'];
	  	}, $c['address']));
		$c['google_map_query_string'] = 'http://maps.google.com/?q=' . $die;
		$c['small'] = true;

		echo $args['before_widget'];
			Timber::render( '_atoms/content/list--address.twig', $c );
		echo $args['after_widget'];
	}
}
