<?php

namespace MVC\Models;

class Page extends Base
{
    public $sidebars = array();

    public function __construct($args)
    {
        parent::__construct($args);

        $this->sidebars = array( 'sidebar', 'sidebar__header', 'sidebar__footer', 'sidebar__after_app' );

        if( isset( $this->args['sidebars'] ) )
        {
            array_merge( $this->sidebars, $this->args['sidebars'] ) ;
        }
    }

    public function loop_images($array, $field_key)
    {
        foreach ($array as $key => &$field)
        {
            if( isset( $field[$field_key] ) && !empty( $field[$field_key] ) )
            {
                $field[$field_key] = \Includes\Classes\Images::serve_image( $field[$field_key] , 'tile', true, false);
            } else {
                $field[$field_key] = 'no image';
            }
        }

        return $array;
    }

    private function menu_add_page($menu_obj)
    {
        $new_menu_obj = [];

        foreach( $menu_obj->items as $key => $menu_item_obj)
        {
            if(isset($menu_item_obj->children))
            {
                foreach ( $menu_item_obj->children as $key1 => $child )
                {
                    $page = get_page_by_title( $child->name );

                    $menu_obj->items[$key]->children[$key1]->icon = get_field('icon', $page->ID);
                    $menu_obj->items[$key]->children[$key1]->colour = get_field('colour', $page->ID);
                }
            }
        }

        return $menu_obj;
    }

    public function get()
    {
        $this->timber->addContext( array(
            'menu' => $this->menu_add_page( new \TimberMenu('primary') ),
        ) );

        $this->timber->addContext( array(
            'banner_image' => \Includes\Classes\Images::serve_image( get_field('featured_image'), 'banner', true, false),
            'sub_heading' => get_field('sub_heading'),
            'post' => new \TimberPost(),
            'intro' => get_field('intro')[0],
            'colour' => get_field('colour'),
        ) );
        if( have_rows('content_block') ) {
            $this->timber->addContext( array(
                'content_block' => $this->loop_images( get_field('content_block'), 'feature_image' ),
            ));
        }
        if( have_rows('content_block_wide') ) {
            $this->timber->addContext( array(
                'content_block_wide' => $this->loop_images( get_field('content_block_wide_content_block'), 'feature_image'  ),
            ));
        }

        $this->addSidebar( $this->sidebars );

        return parent::get();
    }

    public function addSidebar($sidebars)
    {
        foreach ($sidebars as $key => $sidebar)
        {
            $this->timber->addContext( array( $sidebar => \Timber::get_widgets( $sidebar ) ) );
        }
    }
}
