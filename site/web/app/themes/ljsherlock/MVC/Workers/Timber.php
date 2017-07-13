<?php

namespace MVC\Workers;

class Timber
{
    public $timber = null;

    public $context = null;

    public function __construct($templateDir, $config = array())
    {
        //initialize Timber
        $this->timber = new \Timber\Timber;

        $this->context = \Timber::get_context();

    	// public static $locations;
    	// public static $dirname = 'views';
    	// public static $twig_cache = false;
    	// public static $cache = false;
    	// public static $auto_meta = true;
    	// public static $autoescape = false;

        // set template location
        \Timber::$locations = $templateDir;

        // set config property
        $this->config = $config;
    }

  public function render($path, $data)
  {
    \Timber::render($path . ".twig", (array)$data);
  }

  public function compile($path, $data)
  {
    return \Timber::compile($path . ".twig", (array)$data);
  }

  public function addExtension($ext)
  {
    return $this->timber->addExtension($ext);
  }

  public function addFilter($filter)
  {
    return $this->timber->addFilter($filter);
  }

  public function addFunction($filter)
  {
    return $this->timber->addFunction($filter);
  }

  public function addContext($context)
  {
      if( isset( $this->context ) )
      {
          $this->context = array_merge( $this->context, $context );
          return;
      }
      $this->context = $context;
  }

}
