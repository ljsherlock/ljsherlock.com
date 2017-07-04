<?php

Class RW_widgets {

    public static function add_widget_areas() {
        /**
         * Register our sidebars and widgetized areas.
         *
         */

         // Footer
    	register_sidebar( array(
    		'name'          => 'Footer 1',
    		'id'            => 'widget_footer_1',
            'before_widget' => '',
    		'after_widget'  => '',
    	));

        register_sidebar( array(
    		'name'          => 'Footer 2',
    		'id'            => 'widget_footer_2',
    		'before_widget' => '',
    		'after_widget'  => '',
    	));

        register_sidebar( array(
    		'name'          => 'Footer 3',
    		'id'            => 'widget_footer_3',
    		'before_widget' => '',
    		'after_widget'  => '',
    	));

        register_sidebar( array(
    		'name'          => 'Home Intro 1',
    		'id'            => 'home_intro_1',
    		'before_widget' => '',
    		'after_widget'  => '',
    	));

        register_sidebar( array(
    		'name'          => 'Home Intro 2',
    		'id'            => 'home_intro_2',
    		'before_widget' => '',
    		'after_widget'  => '',
    	));
        register_sidebar( array(
    		'name'          => 'Home Intro 3',
    		'id'            => 'home_intro_3',
    		'before_widget' => '',
    		'after_widget'  => '',
    	));
        register_sidebar( array(
            'name'          => 'Find a Member 1',
            'id'            => 'home_find_member_1',
            'before_widget' => '',
            'after_widget'  => '',
        ));

        register_sidebar( array(
            'name'          => 'Find a Member 2',
            'id'            => 'home_find_member_2',
            'before_widget' => '',
            'after_widget'  => '',
        ));


        // SANE NAMES

        register_sidebar( array(
            'name'          => 'Feed 1',
            'id'            => 'feed_1',
            'before_widget' => '',
            'after_widget'  => '',
        ));
        register_sidebar( array(
            'name'          => 'Feed 2',
            'id'            => 'feed_2',
            'before_widget' => '',
            'after_widget'  => '',
        ));
        register_sidebar( array(
            'name'          => 'Feed 3',
            'id'            => 'feed_3',
            'before_widget' => '',
            'after_widget'  => '',
        ));
        register_sidebar( array(
            'name'          => 'Feed 4',
            'id'            => 'feed_4',
            'before_widget' => '',
            'after_widget'  => '',
        ));

        register_sidebar( array(
            'name'          => 'FPS Recent Posts',
            'id'            => 'fps_recent_posts',
            'before_widget' => '',
            'after_widget'  => '',
        ));

        register_sidebar( array(
            'name'          => 'Events Sidebar',
            'id'            => 'events_sidebar',
            'before_widget' => '',
            'after_widget'  => '',
        ));

        // Careers
        register_sidebar( array(
            'name'          => 'Careers - 1',
            'id'            => 'careers_1',
            'before_widget' => '',
            'after_widget'  => '',
        ));
        register_sidebar( array(
            'name'          => 'Careers - 2',
            'id'            => 'careers_2',
            'before_widget' => '',
            'after_widget'  => '',
        ));
        register_sidebar( array(
            'name'          => 'Careers - 3',
            'id'            => 'careers_3',
            'before_widget' => '',
            'after_widget'  => '',
        ));
        register_sidebar( array(
            'name'          => 'Careers - 4',
            'id'            => 'careers_4',
            'before_widget' => '',
            'after_widget'  => '',
        ));

        // courses
        register_sidebar( array(
            'name'          => 'Courses - 1',
            'id'            => 'courses_1',
            'before_widget' => '',
            'after_widget'  => '',
        ));
        register_sidebar( array(
            'name'          => 'Courses - 2',
            'id'            => 'courses_2',
            'before_widget' => '',
            'after_widget'  => '',
        ));


    }


    public static function initialize_widgets()
    {
        register_widget( 'Newsletter_Widget' );

        register_widget( 'Address_Widget' );

        register_widget( 'Contact_Widget' );

        register_widget( 'contentBlock_Widget' );

        register_widget( 'WP_Widget_Recent_Custom_Posts' );

        register_widget( 'WP_Widget_Recent_Tweets' );

        register_widget( 'WP_Widget_Title_Link_Block' );

        register_widget( 'WP_Widget_Recent_Custom_Posts_Tile' );
    }
}
