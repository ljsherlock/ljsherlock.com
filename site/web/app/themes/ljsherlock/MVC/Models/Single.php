<?php

namespace MVC\Models;

class Single extends Base
{

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
        $post = new \TimberPost();

        $this->timber->addContext( array(
            'post' => $post,
            'terms' => $this->terms($post),
        ));

        return parent::get();
    }

    public function terms($post)
    {
        $terms = wp_get_object_terms( $post->ID, get_taxonomies('', 'names'));
        $timberTerms = array();
        foreach ($terms as $key => $term)
        {
            $timberTerms[$key] = new \TimberTerm( $term->term_id );
        }

        // die(var_dump($timberTerms));

        return $timberTerms;
    }
}
