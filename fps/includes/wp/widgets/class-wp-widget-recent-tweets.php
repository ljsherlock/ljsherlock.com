<?php
/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class WP_Widget_Recent_Tweets extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_recent_tweets',
			'description' => __( 'Your site&#8217;s most recent Tweets.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'recent-custom-tweets', __( 'Recent Tweets' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_tweets';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance )
	{
		if(!empty($instance) )
		{
			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
			$anchor_text = ( ! empty( $instance['anchor_text'] ) ) ? $instance['anchor_text'] : __( 'Read All' );
			$anchor_link = ( ! empty( $instance['anchor_link'] ) ) ? $instance['anchor_link'] : __( 'Read All' );
			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
			if ( ! $number )
				$number = 1;

			$c['anchor_text'] = $anchor_text;
			$c['anchor_link'] = $anchor_link;
			$c['post_type'] = 'twitter';
			$c['title'] = $title;
			$tweet = new Redwire\Tweets();
			$c['tweets'] = $tweet->get_tweet($number);
		}

		// recent posts
		// anchor_link
		// anchor_text
		// list_items
		Timber::render('project_fps/_molecules/content/block--recent-tweets.twig', $c);

	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['anchor_text'] = sanitize_text_field( $new_instance['anchor_text'] );
		$instance['anchor_link'] = sanitize_text_field( $new_instance['anchor_link'] );
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$anchor_text     = isset( $instance['anchor_text'] ) ? esc_attr( $instance['anchor_text'] ) : '';
		$anchor_link     = isset( $instance['anchor_link'] ) ? esc_attr( $instance['anchor_link'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		//$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;

		?>
		<!-- TITLE -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<!-- Archive link text -->
		<p><label for="<?php echo $this->get_field_id( 'anchor_text' ); ?>"><?php _e( 'Twitter link label:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'anchor_text' ); ?>" name="<?php echo $this->get_field_name( 'anchor_text' ); ?>" type="text" value="<?php echo $anchor_text; ?>" /></p>

		<!-- Archive link text -->
		<p><label for="<?php echo $this->get_field_id( 'anchor_link' ); ?>"><?php _e( 'Twitter Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'anchor_link' ); ?>" name="<?php echo $this->get_field_name( 'anchor_link' ); ?>" type="text" value="<?php echo $anchor_text; ?>" /></p>

		<!-- NUMBER -->
		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}
