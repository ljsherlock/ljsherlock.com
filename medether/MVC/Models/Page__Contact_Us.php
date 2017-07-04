<?php

namespace MVC\Models;

class Page__Contact_Us extends Page
{
    public $sidebars = array();

        public function get()
    {
        $this->timber->addContext( array(
            'locations' => $this->loop_images( get_field('locations'), 'map' ),
        ) );

        return parent::get();
    }
}
