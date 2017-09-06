<?php

namespace MVC\Models;

use Includes\Classes\CMB2 as CMB2;

class Archive__Work extends Archive
{
    /**
    *   @property Array $args archive query
    */
    public $args = '';

    /**
    * @method __construct
    *
    * @param Array $args Model arguments
    */
    public function __construct($args)
    {
        parent::__construct($args);
    }

    /**
    * @method get returns data to the controller
    *
    * @param void
    *
    * @return $context array( $posts, $pagination )
    */
    public function get()
    {
        $this->timber->addContext(array(
            'featured_image' => get_post_meta( $this->post->ID, CMB2::$prefix . 'produced', true),
        ));

        return parent::get();
    }
}
