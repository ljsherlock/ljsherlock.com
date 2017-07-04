<?php

namespace Redwire;

class members
{
    const POST_TYPE     = "member";
    const POST_TAXONOMY = "system";

    public static function setup()
    {
        self::registerPostType();
        self::registerTaxonomy();
        // add_filter( 'member_posts_columns', array(__CLASS__, 'edit_columns' ));
        // add_action( 'manage_posts_custom_column', array(__CLASS__, 'custom_columns' ));

    }
    /**
     *  Register Case Study Post Type
     */
    public static function registerPostType()
    {
        $singular = 'Member';
        $plural = "Members";

        $labels = array(
            'name'               => _x($plural, 'post type general name', RW_TEXT_DOMAIN),
            'singular_name'      => _x($singular, 'post type singular name', RW_TEXT_DOMAIN),
            'menu_name'          => _x('Members', 'admin menu', RW_TEXT_DOMAIN),
            'name_admin_bar'     => _x($singular, 'add new on admin bar', RW_TEXT_DOMAIN),
            'add_new'            => _x("Add {$singular}", 'post', RW_TEXT_DOMAIN),
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
            'rewrite'            => array( 'slug' => 'members' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'menu_icon'          => 'dashicons-groups'
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
                'label' => __('System Categories', RW_TEXT_DOMAIN),
                'show_admin_column' => true,
                'hierarchical' => true,
                'rewrite' => array( 'slug' =>  'member/system' ),
                'description' => 'The Member provides the technique using another company working under the Member\'s supervision.'
            )
        );
        register_taxonomy(
            'primary-provider',
            self::POST_TYPE,
            array(
                'label' => __('Primary Provider', RW_TEXT_DOMAIN),
                'show_admin_column' => true,
                'hierarchical' => true,
                // 'rewrite' => array( 'slug' =>  'members/system' ),
            )
        );
        register_taxonomy(
            'secondary-provider',
            self::POST_TYPE,
            array(
                'label' => __('Secondary Provider', RW_TEXT_DOMAIN),
                'show_admin_column' => true,
                'hierarchical' => true,
                // 'rewrite' => array( 'slug' =>  'members/system' ),
            )
        );
        register_taxonomy(
            'type',
            self::POST_TYPE,
            array(
                'label' => __('Member Type', RW_TEXT_DOMAIN),
                'show_admin_column' => true,
                'hierarchical' => true,
                'rewrite' => array( 'slug' => 'member/type' ),
            )
        );
    }

    // public static function edit_columns( $columns )
    // {
    // 	$columns = array(
    // 		'cb' => '<input type="checkbox" />',
    // 		'title' => __( 'Title' ),
    //         'author' => __('Author'),
    // 		'categories' => __( 'Categories' ),
    // 		'date' => __( 'Date' )
    // 	);
    //
    // 	return $columns;
    // }


}
