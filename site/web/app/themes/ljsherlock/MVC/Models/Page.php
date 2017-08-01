<?php

namespace MVC\Models;

class Page extends Single
{
    public $sidebars = array();

    public function __construct($args)
    {
        parent::__construct($args);

        $this->sidebars = array( 'sidebar', 'sidebar__header', 'sidebar__footer', 'sidebar__homepage_main', 'sidebar__after_app' );

        if( isset( $this->args['sidebars'] ) )
        {
            array_merge( $this->sidebars, $this->args['sidebars'] ) ;
        }
    }

    public function get()
    {
        $this->timber->addContext( array(
            'menu' => new \TimberMenu('Primary'),
        ) );

        if( isset($this->sidebars) )
        {
            $this->addSidebar( $this->sidebars );
        }

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
