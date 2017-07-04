<?php

/**
 * Adds Newsletter_Widget widget.
 */
class contentBlock_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'content_block_widget', // Base ID
			esc_html__( 'Content Block', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'A Content Block Widget', 'text_domain' ), ) // Args
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
		echo $args['before_widget'];
		if(!empty($instance) ) {
            $post = get_post( $instance['block'] );
            $pattern = get_shortcode_regex();

            //get acf fields
            $fields = get_fields($post->ID);
			$c = [];

            preg_match('/'.$pattern.'/s', $post->post_content, $matches);

            // generate the content
            if ( is_array($matches) && !empty($matches[2]) )
            {
                $c['content'] = do_shortcode( wpautop( $post->post_content ) );
            }
            else
            {
               $c['content'] = wpautop($post->post_content);
            }

			if( isset( $fields['pseudo_image'] ) )
			{
				$c['span_style'] = 'background-image: url(' .$fields['pseudo_image']['sizes']['large'] .' );';
				$c['span_class'] = 'content-block--' . $post->post_name;
			}

            //background image and background color
            $background_color = 'background-color:' .$fields['background_color'].';';
            $background_image = 'background-image: url(' . Redwire\RW_Images::serve_image( $fields['background_image'], 'tile', true ) .' );';

            // Add context properties
            $c['style'] = $background_color . $background_image;

			if( isset($fields['custom_styles']) )
            	$c['style'] .= $fields['custom_styles'];

            $c['class'] = 'block--'.$post->post_name.' ';

			if( isset($fields['custom_class']) )
				$c['class'] .= $fields['custom_class'];

			$c['bem'][] = ['block' => 'content'];

            Timber::render('project_fps/_molecules/content/block--content-block.twig', $c );
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
        $title = 'bla';
		$block = ! empty( $instance['block'] ) ? $instance['block'] : esc_html__( 'New title', 'text_domain' );
        query_posts(array(
            'post_type' => 'content-block',
        ));
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'block' ) ); ?>"><?php esc_attr_e( 'Content Block :', 'text_domain' ); ?></label>
            <select id="<?php echo $this->get_field_id('block'); ?>"  name="<?php echo $this->get_field_name('block'); ?>">
    			<?php while (have_posts()) : the_post(); ?>
                     <option <?= (get_the_ID() == $block) ? 'selected="selected"' : ''; ?> value="<?= get_the_ID(); ?>">
                         <?= the_title(); ?>
                     </option>
                <?php endwhile;?>
    		</select>
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
		// $instance = array();
        $instance = $old_instance;
		$instance['block'] = ( ! empty( $new_instance['block'] ) ) ? strip_tags( $new_instance['block'] ) : '';
        $instance['title'] = ( ! empty( $new_instance['block'] ) ) ? strip_tags( $new_instance['block'] ) : '';
		return $instance;
	}

}
