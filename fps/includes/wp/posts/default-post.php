<?php

namespace Redwire;

class post
{

    public static function setup()
    {
        add_action( 'init',  array(__CLASS__, 'registerPostType'), 1 );
    }

    /**
     *  Register Case Study Post Type
     */
    public static function registerPostType()
    {
        $labels = array(
            'name_admin_bar' => _x( 'Post', 'add new on admin bar' ),
            'singular_name'      => _x('Blog', 'post type singular name'),
            'name'               => _x('Blog', 'post type general name', RW_TEXT_DOMAIN),
        );

        $args = array(
            'labels' => $labels,
            'public'  => true,
            '_builtin' => false, /* internal use only. don't use this when registering your own post type. */
            '_edit_link' => 'post.php?post=%d', /* internal use only. don't use this when registering your own post type. */
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'menu_position' => 5,
            'hierarchical' => false,
            'rewrite' => array( 'slug' => 'news-views/post' ),
            'query_var' => false,
            'delete_with_user' => true,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats' ),
         );

        register_post_type( 'post', $args );

    }

}
