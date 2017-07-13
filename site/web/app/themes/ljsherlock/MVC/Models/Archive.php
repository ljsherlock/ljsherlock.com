<?php

namespace MVC\Models;

class Archive extends Base
{
  public function __construct( $timber, $args )
  {
    parent::__construct( $timber, $args );

    $this->query = $this->args['query'];
    unset($this->args['query']);
  }

    public function get()
    {
        $this->timber->addContext( array( 'posts' => \Timber::get_posts( $this->query ) ) );

        return parent::get();
    }
}
