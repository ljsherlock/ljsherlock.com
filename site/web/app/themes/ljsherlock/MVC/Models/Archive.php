<?php

namespace MVC\Models;

class Archive extends Single
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

        $this->postObj = $this->get_post_type_obj();
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

        $this->timber->addContext(array(
            'posts' => $this->addTerms( $posts ),
            'pagination' => \TImber::get_pagination(),
            'postObj' => $this->postObj,
            'termObj' => $this->get_term_obj(),
            'taxObj' => $this->get_tax_obj(),
        ));

        return parent::get();
    }

    public function get_post_type_obj()
    {
        if( isset($this->args['post_type']) )
            return get_post_type_object( $this->args['post_type'] );

        return null;

    }

    public function get_term_obj()
    {
        if( isset( $this->args['tax'], $this->args['term'] ) )
            return new \TimberTerm($this->args['term'], $this->args['tax']->name );

        return null;

    }

    public function get_tax_obj()
    {
        if( isset( $this->args['tax'] ) )
            return get_taxonomy($this->args['tax']);

        return null;
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
        if( isset($args['post_type']) )
        {
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
