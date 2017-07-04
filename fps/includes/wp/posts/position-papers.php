<?php

namespace Redwire;

class thoughts
{

    const POST_TYPE     = "position-papers";
    const POST_TAXONOMY = "position-papers-category";

    public static function setup()
    {
        self::registerPostType();
        self::registerTaxonomy();

    }

    /**
     *  Register Case Study Post Type
     */
    public static function registerPostType()
    {
        $singular = 'Position Paper';
        $plural = "Position Papers";

        $labels = array(
            'name'               => _x($plural, 'post type general name', RW_TEXT_DOMAIN),
            'singular_name'      => _x($singular, 'post type singular name', RW_TEXT_DOMAIN),
            'menu_name'          => _x($plural, 'admin menu', RW_TEXT_DOMAIN),
            'name_admin_bar'     => _x($singular, 'add new on admin bar', RW_TEXT_DOMAIN),
            'add_new'            => _x('Add New', 'post', RW_TEXT_DOMAIN),
            'add_new_item'       => __("Add New {$singular}", RW_TEXT_DOMAIN),
            'new_item'           => __("New {$singular}", RW_TEXT_DOMAIN),
            'edit_item'          => __("Edit {$singular}", RW_TEXT_DOMAIN),
            'view_item'          => __("View {$singular}", RW_TEXT_DOMAIN),
            'all_items'          => __("All {$plural}", RW_TEXT_DOMAIN),
            'search_items'       => __("Search {$plural}", RW_TEXT_DOMAIN),
            'parent_item_colon'  => __("Parent {$plural}:", RW_TEXT_DOMAIN),
            'not_found'          => __("No {$plural} found.", RW_TEXT_DOMAIN),
            'not_found_in_trash' => __("No {$plural} found in Trash.", RW_TEXT_DOMAIN)
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => self::POST_TYPE ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'menu_icon'          => 'dashicons-admin-post'
        );

        register_post_type( self::POST_TYPE , $args );

    }

    /**
     *  Register Case Study category Taxonomy
     */
    public static function registerTaxonomy()
    {

        register_taxonomy(
            self::POST_TAXONOMY,
            self::POST_TYPE,
            array(
                'label' => __('Position Paper Category', RW_TEXT_DOMAIN),
                'hierarchical' => true,
            )
        );

    }

}
