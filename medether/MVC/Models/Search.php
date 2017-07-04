<?php

namespace MVC\Models;

class Search extends Page
{
    public $sidebars = array();

    public function __construct( $args )
    {
        parent::__construct( $args );

        $this->sidebars = array( 'sidebar', 'sidebar__header', 'sidebar__footer' );

        if( isset( $this->args['sidebars'] ) )
        {
            array_merge( $this->sidebars, $this->args['sidebars'] ) ;
        }
    }

    public function get()
    {
        if( isset( $this->data['term'] ) )
        {
            $this->timber->addContext( array( 'posts' => \Timber::get_posts($args) ) );
        }

        return parent::get();
    }

    public function search()
    {
        $args = array(
            'post_type' => get_post_types(),
            'post_status' => 'publish',
            's' => $this->data['term'],
        );

        return \Timber::get_posts( $args );
    }

}
