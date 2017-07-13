<?php

namespace MVC\Models;

abstract class Base
{
    /**
    * Model args
    * @var object
    */
    protected $args = [];

    /**
    * Stores all model data
    * @var object
    */
    protected $data = array();

    /**
    * Twig worker
    * @var \wptwig\Workers\Twig
    */
    public $timber = null;

    /**
    * __construct
    * @param array $args Model arguments
    */
    public function __construct( $args )
    {
        $this->args = $args;
    }

    public function add( $name, $value )
    {
        $this->data[ $name ] = $value;
    }

    /**
    * Fetch data to pass to template for rendering
    * @return array
    */
    public function get()
    {
        // put timber context in the $data variable
        $this->data = $this->timber->context;

        // var_dump( $this->data );

        // force array for twig
        return $this->data;
    }

    /**
    * Twig has trouble with object data,
    * so force the data to be an array.
    * @param mixed $data Array/object
    * @return array
    */
    protected function forceArray($data)
    {
        return json_decode(json_encode($data), true);
    }

    /**
    * Get data needed for all post/page rendering
    * @return array
    */
    protected function getSiteData()
    {
        return array(
          "charset" => get_bloginfo("charset"),
        //   "body_classes" => $this->getBodyClasses()
        );
    }

    /**
    * Fetch WordPress-generated body classes
    * @return array Array of class names
    */
    protected function getBodyClasses()
    {
        $string = str_replace(array('class=', '"'), "", $string);
        return explode(" ", $string);
    }

}
