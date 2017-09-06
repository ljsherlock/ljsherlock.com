<?php

namespace MVC\Models;

use Includes\Classes\CMB2 as CMB2;

class Single__Work extends Single
{

    public $sidebars = array();

    /**
    *   @method __construct
    *   @return get
    **/
    public function __construct($args)
    {
        parent::__construct($args);
    }

    /**
    *   @method get
    *   @return parent::get()
    *
    *
    **/
    public function get()
    {
        $this->timber->addContext( array(
            'produce' => get_post_meta( $this->post->ID, CMB2::$prefix . 'produced', true ),
            'project_colours' => get_post_meta( $this->post->ID, CMB2::$prefix . 'project_colours', true ),
            'browser_image' => get_post_meta( $this->post->ID, CMB2::$prefix . 'browser_image', true ),
            'primary_image' => get_post_meta( $this->post->ID, CMB2::$prefix . 'primary_image', true ),
            'secondary_images' => get_post_meta( $this->post->ID, CMB2::$prefix . 'secondary_images', true ),
        ));

        return parent::get();
    }
}
