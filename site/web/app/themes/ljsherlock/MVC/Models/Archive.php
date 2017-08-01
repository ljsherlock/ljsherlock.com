<?php

namespace MVC\Models;

class Archive extends Base
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
        $posts = $this->query($this->args);

        $this->timber->addContext(array( 'posts' => $this->addTerms($posts) ) );
        $this->timber->addContext(array( 'pagination' => \TImber::get_pagination() ));

        $this->get_post_type_obj();
        $this->get_term_obj();
        $this->get_tax_obj();

        return parent::get();
    }

    public function get_post_type_obj()
    {
        if(isset($this->args['post_type']))
            $this->timber->addContext( array( 'postObj' => get_post_type_object( $this->args['post_type'] )) );
    }

    public function get_term_obj()
    {
        if(isset( $this->args['tax'], $this->args['term'] ))
        {
            $this->timber->addContext(
                //array( 'termObj' => get_term_by('slug', $this->args['term'],    $this->args['tax']->name )
                array( 'termObj' => new \TimberTerm($this->args['term'], $this->args['tax']->name ) )
            );
        }
    }

    public function get_tax_obj()
    {
        if(isset( $this->args['tax'] ))
            $this->timber->addContext( array( 'taxObj' => $this->args['tax'] ) );
    }

    /**
    * @method Query posts grab pagination data
    *
    * @param Array $args
    *
    * @return Array of Objs $posts
    */
    public function query($args)
    {
        $query = array(
            'posts_per_page' => \get_option( 'posts_per_page' ),
            'paged' => \get_query_var('paged'),
        );
        if( isset($args['post_type']) ) {
            $query['post_type'] = $args['post_type'];
        }
        if( isset($args['query']) )
        {
            $query = array_merge( $query, $args['query'] );
        }
        query_posts($query);

        return \Timber::get_posts( $query );
    }

    /**
    * @method Add terms obj to post object
    *
    * @param Array $posts
    *
    * @return updated $posts
    */
    public function addTerms($posts = array())
    {
        foreach ($posts as $key => $post)
        {
            $single = new \MVC\Models\Single(array());
            $post->terms = $single->terms($post);
        }

        return $posts;
    }
}
