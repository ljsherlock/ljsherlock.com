<?php

namespace MVC\ContentTypes;

abstract class Post
{
    /**
    * @type (string)
    * @desc post type name
    */
    protected $name = '';

    /**
    * @type (string)
    * @desc Nice Singular name
    */
    protected $singular = '';

    /**
    * @type (string)
    * @desc Nice plural name
    */
    protected $plural = '';

    /**
    * @type (string)
    * @desc Taxonomy type name
    */
    protected $taxonomy = '';

    /**
    * @type (string)
    * @desc Taxonomy type name
    */
    protected $taxonomy_name = '';

    public function __construct()
    {
        $labels = array(
            'name'               => _x($this->plural, 'post type general name', LJS_TEXT_DOMAIN),
            'singular_name'      => _x($this->singular, 'post type singular name', LJS_TEXT_DOMAIN),
            'menu_name'          => _x($this->plural, 'admin menu', LJS_TEXT_DOMAIN),
            'name_admin_bar'     => _x($this->singular, 'add new on admin bar', LJS_TEXT_DOMAIN),
            'add_new'            => _x('Add New', 'post', LJS_TEXT_DOMAIN),
            'add_new_item'       => __("Add New {$this->singular}", LJS_TEXT_DOMAIN),
            'new_item'           => __("New {$this->singular}", LJS_TEXT_DOMAIN),
            'edit_item'          => __("Edit {$this->singular}", LJS_TEXT_DOMAIN),
            'view_item'          => __("View {$this->singular}", LJS_TEXT_DOMAIN),
            'all_items'          => __("All {$this->plural}", LJS_TEXT_DOMAIN),
            'search_items'       => __("Search {$this->plural}", LJS_TEXT_DOMAIN),
            'parent_item_colon'  => __("Parent {$this->plural}:", LJS_TEXT_DOMAIN),
            'not_found'          => __("No {$this->plural} found.", LJS_TEXT_DOMAIN),
            'not_found_in_trash' => __("No {$this->plural} found in Trash.", LJS_TEXT_DOMAIN)
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => $this->name ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon'          => 'dashicons-align-left'
        );

        register_post_type( $this->name , $args );

        if( $this->taxonomy != null )
        {
            $this->register_taxonomy();
        }
    }

    /**
     *  Register Case Study category Taxonomy
     */
    public function register_taxonomy()
    {
        register_taxonomy(
            $this->taxonomy,
            $this->name,
            array(
                'label' => __($this->taxonomy_name . ' Category', LJS_TEXT_DOMAIN),
                'hierarchical' => true,
                'show_admin_column' => true,
            )
        );
    }

}
