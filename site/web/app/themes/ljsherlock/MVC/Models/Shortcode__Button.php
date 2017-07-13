<?php

namespace MVC\Models;

class Shortcode__Button extends Shortcode
{
    public function __construct( $args = array() )
    {
        parent::__construct( $args );

    }

    public function add_attributes()
    {
        $this->timber->addContext( array(
            'attrs' => array(
                'href' => $this->attrs['href'],
            ),
            'bem' => array(
                array( 'block' => 'btn--primary' )
            ),
            'texts' => array(
                array( 'text' => $this->attrs['title'] ),
            ),
        ));

    }

}
