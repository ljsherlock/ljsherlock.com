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
class WP_Widget_Recent_Custom_Posts_Tile extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_recent_custom_posts_tile',
			'description' => __( 'Your site&#8217;s most recent Custom Posts.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'recent-custom-posts-tile', __( 'Recent Custom Posts Tiles' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_custom_posts_tile';
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
			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
			if ( ! $number )
				$number = 5;
			$post_type = ( ! empty( $instance['post_type'] ) ) ? $instance['post_type'] : post;
			$args = array(
			    'post_type' => $post_type,
				'post_per_page' => $number,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
			    "orderby"   => "title",
			    "order"     => "ASC",
			);

			$c = Timber::get_context();

			$c['anchor_link'] = $post_type;
			$c['anchor_text'] = $anchor_text;
			//$labels = get_post_type_labels($type);
			$c['title'] = $title;
			$c['post_type'] = $post_type;
			$c['posts'] = Timber::get_posts($args);
		}

		// recent posts
		// anchor_link
		// anchor_text
		// list_items
		Timber::render('project_fps/_organisms/interface/thoughts.twig', $c);

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
		$instance['number'] = (int) $new_instance['number'];
		$instance['post_type'] = ( ! empty( $new_instance['post_type'] ) ) ? strip_tags( $new_instance['post_type'] ) : '';
		//$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
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
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		//$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$selected_post_type = ! empty( $instance['post_type'] ) ? $instance['post_type'] : esc_html__( 'post', 'text_domain' );

		$args = array(
		   'public'   => true,
		);

		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'

		$post_types = get_post_types( $args, $output, $operator );
		?>
		<!-- TITLE -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<!-- Archive link text -->
		<p><label for="<?php echo $this->get_field_id( 'anchor_text' ); ?>"><?php _e( 'Archive link label:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'anchor_text' ); ?>" name="<?php echo $this->get_field_name( 'anchor_text' ); ?>" type="text" value="<?php echo $anchor_text; ?>" /></p>

		<!-- NUMBER -->
		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<!-- POST TYPE -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_attr_e( 'Post Type :', 'text_domain' ); ?></label>
			<select id="<?php echo $this->get_field_id('post_type'); ?>"  name="<?php echo $this->get_field_name('post_type'); ?>">
				<?php foreach($post_types as $type)
				{
					$labels = get_post_type_object($type); ?>

					 <option <?= ($type == $selected_post_type) ? 'selected="selected"' : ''; ?> value="<?= $type ?>">
						 <?= $labels->label; ?>
					 </option>

				<?php } ?>
			</select>
		</p>
<?php
	}
}
