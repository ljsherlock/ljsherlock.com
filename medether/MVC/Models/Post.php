<?php

namespace MVC\Models;

class Post extends Page
{
  public function __construct($post, $timber)
  {
    parent::__construct($post, $timber);
  }

  public function get()
  {
    $data = parent::get($this->timber);

    // modify data for posts, if needed

    return $this->data = $data;
  }
}
