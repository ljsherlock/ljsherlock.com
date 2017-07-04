<?php

namespace Redwire;

class OptimiseWP
{
    public static function setup()
    {
        global $locale;

        /**
         *  Set locale var to save 1 SQL query
         */
        $locale = 'en_US';

        /**
         *  Remove useless widgets
         */
        add_action('widgets_init', array(__CLASS__, 'removeWidgets'));

        /**
         *  Remove useless info in head
         */
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'rsd_link');

        /**
         * @var $roleObject WP_Role
         */
        $roleObject = get_role( 'editor' );
        if (!$roleObject->has_cap( 'edit_theme_options' ) )
        {
            $roleObject->add_cap( 'edit_theme_options' );
        }

        /**
         *  Remove comments & Trackbacks
         */
        add_action('admin_menu', array(__CLASS__, 'removeCommentFromAdmin'));
        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);

        /**
         * Remove emojis
         */
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');

        /**
         *  Disable admin bar on the front end
         */
        add_filter('show_admin_bar', '__return_false');

        /**
         *  Disable REST
         */
        add_filter('rest_enabled', '_return_false');
        add_filter('rest_jsonp_enabled', '_return_false');
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        add_action('wp', array(__CLASS__, 'removeRestLinkHeader'));

        add_filter( 'upload_mimes' , array( __CLASS__ , 'cc_mime_types' ) );

        // Redirect Non-admin users
        // add_filter( 'login_redirect', array( __CLASS__ ,'acme_login_redirect'), 10, 3 );

    }

    public static function removeWidgets()
    {
        $default_widgets = array(
            'WP_Widget_Pages',
            'WP_Widget_Calendar',
            'WP_Widget_Archives',
            'WP_Widget_Links',
            'WP_Widget_Meta',
            'WP_Widget_Search',
            'WP_Widget_Text',
            'WP_Widget_Categories',
            'WP_Widget_Recent_Posts',
            'WP_Widget_Recent_Comments',
            'WP_Widget_RSS',
            'WP_Widget_Tag_Cloud',
            'WP_Nav_Menu_Widget'
        );

        foreach ($default_widgets as $widget) {
            unregister_widget($widget);
        }
    }

    public static function removeCommentFromAdmin()
    {
        remove_menu_page('edit-comments.php');
    }

    public static function removeRestLinkHeader()
    {
        header_remove('Link');
    }

    /**
    * Allow SVG through WordPress Media Uploader
    */
    public static function cc_mime_types( $mimes )
    {
        // Vector/Image formats
        $mimes[ 'svg' ] = 'image/svg+xml';

        // Misc application formats
        $mimes[ 'exe' ] = 'application/x-msdownload';
        $mimes['jar']   = 'application/java-jar';

        return $mimes;
    }

    /**
     * Redirect non-admins to the homepage after logging into the site.
     *
     * @since 	1.0
     */
    public static function acme_login_redirect( $redirect_to, $request, $user  ) {
    	return ( is_array( $user->roles ) && in_array( 'administrator', $user->roles ) ) ? admin_url() : site_url() . '/members' ;
    }

}
