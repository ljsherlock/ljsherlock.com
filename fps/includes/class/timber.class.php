<?php

namespace Redwire;

class WPTimber
{

    public static function setup()
    {
        self::initialize();

        //Timber
        add_filter( 'timber_context' , array(__CLASS__, 'context' ) );

        $Timber = new \Timber\Timber;
    }

    public static function initialize()
    {
        \Timber\Timber::$dirname = array(  '_macros',
                                    '_patterns',
                                    // '_patterns/00-atoms',
                                    // '_patterns/01-molecules',
                                    // '_patterns/02-organisms',
                                    // '_patterns/03-templates',
                                    // '_patterns/04-pages',
                                    // '_patterns/05-fps/00-atoms',
                                    // '_patterns/05-fps/01-molecules',
                                    // '_patterns/05-fps/02-organisms',
                                    // '_patterns/05-fps/03-templates',
                                    // '_patterns/05-fps/04-pages'
        );

        \Routes::map('news-views/:name', function($params)
        {
            \Routes::load(RW_ROOT . '/archive.php', $params);
        });

        \Routes::map('news-views/:name/page/:pg', function($params)
        {
            \Routes::load(RW_ROOT . '/archive.php', $params);
        });

        // \Routes::map('members/page/:pg', function($params)
        // {
        //     \Routes::load(RW_ROOT . '/archive-members.php', $params);
        // });

        // change :taxonomy to documents
        // hard code is in taxonomy
        // \Routes::map('document/document-category/:term', function($params)
        // {
        //     $query = query_posts('post_type=document');
        //     \Routes::load(RW_ROOT . '/taxonomy-document-category.php', $params);
        //
        // });
        //
        // \Routes::map('document/document-cactegory/:term/page/:pg', function($params)
        // {
        //     $query = query_posts('post_type=document');
        //     \Routes::load(RW_ROOT . '/taxonomy-document-category.php', $params);
        //
        // });

        // \Routes::map('members/system/:term', function($params)
        // {
        //     $query = query_posts('post_type=system');
        //     \Routes::load(RW_ROOT . '/taxonomy-system.php', $params);
        //
        // });
        //
        // \Routes::map('members/system/:term/page/:pg', function($params)
        // {
        //     $query = query_posts('post_type=system');
        //     \Routes::load(RW_ROOT . '/taxonomy-system.php', $params);
        //
        // });
        //
        // \Routes::map('members/associate-member/', function($params)
        // {
        //     $query = query_posts('post_type=associate-member');
        //     \Routes::load(RW_ROOT . '/taxonomy-associate-member.php', $params);
        //
        // });
        //
        // \Routes::map('members/associate-member/page/:pg', function($params)
        // {
        //     $query = query_posts('post_type=associate-member');
        //     \Routes::load(RW_ROOT . '/taxonomy-associate-member.php', $params);
        //
        // });

        \Routes::map('events/:m/:y', function($params)
        {
            $query = query_posts('post_type=event');
            \Routes::load(RW_ROOT . '/archive-event.php', $params);

        });

        \Routes::map('events/:m/:y/page/:pg', function($params)
        {
            $query = query_posts('post_type=event');
            \Routes::load(RW_ROOT . '/archive-event.php', $params);

        });
    }

    public static function context( $c )
    {
        /**
        *   Dynamic data
        *
        *   @return post
        *   @property WP Post Object
        *
        *   @return year
        *   @property String
        *
        */
        $post = new \TimberPost();
        $c['post'] = $post;

        $c['year'] = date("Y");

        /**
        *   Browser Info
        *
        *   @return Device
        *   @property String type of device (Mobile, Tablet, Desktop)
        *
        *   @return Mustard:
        *   @property bolean
        */
        $c['device'] = Utils::isDevice();
        $c['mustard'] = (_MUSTARD == 'true') ? true : '';
        $c['ajax'] = false;


        // AJAX

        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        if(isset($data)) {
            $c['ajax']['data'] = $data;
            $c['ajax']['method'] = true;
        }

        /**
        *   Global data
        *
        *   @return sitename
        *   @return website_title
        *   @return head_title
        *   @return icons
        *   @return primary_menu
        *   @return footer_mennu
        *   @return footer_widgets_1
        *   @return footer_widgets_2
        *
        */

        // Meta
        $website_title = \get_bloginfo('name');
        $c['sitename'] = $website_title;
        $c['website_title'] = $website_title;
        $c['head_title'] = $website_title;
        $c['head_title'].= ' - ' . $post->post_title;

        // SVG
        $c['icons'] = file_get_contents(RW_MEDIA_DIR . '/icons/icons.svg');

        // Navigation
        $c['primary_menu'] = new \TimberMenu('primary');
        $c['secondary_menu'] = new \TimberMenu('secondary');
        $c['footer_menu'] = new \TimberMenu('footer');

        // Widgets
        $c['widget_footer_1'] = \Timber::get_widgets('widget_footer_1');
        $c['widget_footer_2'] = \Timber::get_widgets('widget_footer_2');
        $c['widget_footer_3'] = \Timber::get_widgets('widget_footer_3');

        // called here one on every page rather than many times in templates.
        $c['options'] = get_fields('options');
        $c['fields'] = get_fields();
        $c['post_obj'] = get_post_type_object($c['post']->post_type);
        $c['posts_per_page'] = get_option('posts_per_page');

        $c['breadcrumbs'] = Utils::breadcrumbs($post);
        $c['slideshow_img'] = RW_Images::serve_image( $c['fields']['hero'][0]['hero__item_image'], 'banner', true );

        return $c;
    }
}
