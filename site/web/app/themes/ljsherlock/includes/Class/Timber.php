<?php

namespace Redwire;

class WPTimber
{

    public static function setup()
    {
        //Timber
        // add_filter( 'timber_context' , array(__CLASS__, 'context' ) );

        $Timber = new \Timber\Timber;

        self::initialize();
    }

    public static function initialize()
    {
        \Timber\Timber::$dirname = array(  'View/_macros', 'View/_components' );

        // \Routes::map('news-views/:name', function($params)
        // {
        //     \Routes::load(RW_ROOT . '/archive.php', $params);
        // });

    }

    // public static function context( $c )
    // {
    //     /**
    //     *   Dynamic data
    //     *
    //     *   @return post
    //     *   @property WP Post Object
    //     *
    //     *   @return year
    //     *   @property String
    //     *
    //     */
    //     $post = new \TimberPost();
    //     $c['post'] = $post;
    //
    //     $c['year'] = date("Y");
    //
    //     /**
    //     *   Browser Info
    //     *
    //     *   @return Device
    //     *   @property String type of device (Mobile, Tablet, Desktop)
    //     *
    //     *   @return Mustard:
    //     *   @property bolean
    //     */
    //     $c['device'] = Utils::isDevice();
    //     $c['mustard'] = (_MUSTARD == 'true') ? true : '';
    //     $c['ajax'] = false;
    //
    //
    //     // AJAX
    //
    //     $request_body = file_get_contents('php://input');
    //     $data = json_decode($request_body);
    //
    //     if(isset($data)) {
    //         $c['ajax']['data'] = $data;
    //         $c['ajax']['method'] = true;
    //     }
    //
    //     /**
    //     *   Global data
    //     *
    //     *   @return sitename
    //     *   @return website_title
    //     *   @return head_title
    //     *   @return icons
    //     *   @return primary_menu
    //     *   @return footer_mennu
    //     *   @return footer_widgets_1
    //     *   @return footer_widgets_2
    //     *
    //     */
    //
    //     // Meta
    //     $website_title = \get_bloginfo('name');
    //     $c['sitename'] = $website_title;
    //     $c['website_title'] = $website_title;
    //     $c['head_title'] = $website_title;
    //     $c['head_title'].= ' - ' . $post->post_title;
    //
    //     // SVG
    //     $c['icons'] = file_get_contents(RW_MEDIA_DIR . '/icons/icons.svg');
    //
    //     // Navigation
    //     $c['primary_menu'] = new \TimberMenu('primary');
    //     $c['secondary_menu'] = new \TimberMenu('secondary');
    //     $c['footer_menu'] = new \TimberMenu('footer');
    //
    //     // Widgets
    //     $c['widget_footer_1'] = \Timber::get_widgets('widget_footer_1');
    //     $c['widget_footer_2'] = \Timber::get_widgets('widget_footer_2');
    //     $c['widget_footer_3'] = \Timber::get_widgets('widget_footer_3');
    //
    //     // called here one on every page rather than many times in templates.
    //     $c['options'] = get_fields('options');
    //     $c['fields'] = get_fields();
    //     $c['post_obj'] = get_post_type_object($c['post']->post_type);
    //     $c['posts_per_page'] = get_option('posts_per_page');
    //
    //     $c['breadcrumbs'] = Utils::breadcrumbs($post);
    //     $c['slideshow_img'] = RW_Images::serve_image( $c['fields']['hero'][0]['hero__item_image'], 'banner', true );
    //
    //     return $c;
    // }
}
