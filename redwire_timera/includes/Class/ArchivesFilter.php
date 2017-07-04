<?php

namespace Redwire;

class ArchivesFilter
{

    public $tags = [];

    public $cats = [];

    public $years = array();

    public function __construct()
    {
        // Categories
        $this->tags = get_taxonomy('post_tag');
        $this->tags->terms = get_tags();

        // Tags
        $this->cats = get_taxonomy('category');
        $this->cats->terms = get_terms(array(
            'taxonomy' => 'category',
            'orderby' => 'name',
            'childless' => true
        ));

        // Years
        $all_posts = get_posts(array( 'posts_per_page' => -1 ));
        $this->years = array();

        foreach ($all_posts as $single)
        {
            if( !array_key_exists( mysql2date( 'Y', $single->post_date ), $this->years )  )
            {
                $this->years['terms'][mysql2date( 'Y', $single->post_date )] = mysql2date( 'Y', $single->post_date );
            }
        }
        $this->years['name'] = "Years";

    }
    /*
     * Store the paged somewhere.
     * pass it to ajax
     *
     *
     *
     *
    */
    public function search_ajax($filters)
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode( $request_body );
        if( $data->paged > 0 )
        {
            $posts = self::filterQueryAjax( $data->post, $data->paged );
        } else {
            $posts = self::filterQueryAjax( $data->post );
        }

        // compile timber tmpl.
        echo json_encode( array(
            'template' => \Timber::compile( '_organisms/blog-archive-posts/blog-archive-posts.twig', array('posts' => $posts['posts'], 'pagination' => $posts['pagination'] ) ),
            'num_of_posts' => $posts['pagination']['total'] * 5,
            'pagination' => $posts['pagination'],
        ));
        die();
    }

    public static function filterQueryAjax($filters, $paged = 0)
    {
        $tax_query = [];
        $year_query = [];

        $prop = 'post_tag[]';
        if( isset( $filters->$prop) )
        {
            $tags = $filters->$prop;
            array_push( $tax_query,
                array( 'taxonomy' => 'post_tag', 'field' => 'slug', 'terms' => get_object_vars($tags), 'operator' => 'AND')
            );
        }

        $prop = 'category[]';
        if( isset( $filters->$prop ) )
        {
            $categories = $filters->$prop;
            array_push( $tax_query,
                array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => get_object_vars($categories), 'operator' => 'AND')
            );
        }

        $prop = 'years[]';
        if( isset( $filters->$prop ) )
        {
            $years = $filters->$prop;
            $year_query['relation'] = 'AND';
            foreach( $years as $year)
            {
                array_push( $year_query, array('year' => $year));
            }
        }

        if( !empty($tax_query) || !empty($year_query) || !empty($filters->keyword) )
        {
            $args = array(
                'post_type' => 'post',
                "orderby"   => "post_date",
                'posts_per_page' => '5',
                'paged' => $paged,
                "order"     => "DSC"
            );
            if( isset($tax_query[0]) )
            {
                $args['tax_query'] = array('relation' => 'AND');
                array_push( $args['tax_query'], $tax_query );
            }
            if( isset($year_query) )
            {
                $args['date_query'] = $year_query;
            }
            if( !empty($filters->keyword) )
            {
                $args = array_merge( $args, array( 's' => $filters->keyword ) );
            }
        }

        // var_dump($args['tax_query']);

        query_posts($args);

        // search for posts with terms
        return array( 'posts' => \Timber::get_posts( $args ), 'pagination' => \Timber::get_pagination() );

    }

    public static function filterQuery($filters, $paged = 0)
    {
        $tax_query = [];
        $year_query = [];

        if( isset($filters['post_tag']))
        {
            array_push( $tax_query,
                array( 'taxonomy' => 'post_tag', 'field' => 'slug', 'terms' => $filters['post_tag'], 'operator' => 'AND')
            );
        }

        if( isset($filters['category']))
        {
            array_push( $tax_query,
                array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => $filters['category'], 'operator' => 'AND')
            );
        }

        $prop = 'years[]';
        if( isset($filters['years']))
        {
             $years = $filters['years'];
             $year_query['relation'] = 'AND';
             foreach( $years as $year)
             {
                 array_push( $year_query, array('year' => $year));
             }
        }

        if( !empty($tax_query) || !empty($year_query) || !empty($filters->keyword) )
        {
            $args = array(
                'post_type' => 'post',
                "orderby"   => "post_date",
                'posts_per_page' => '5',
                "order"     => "DSC"
            );
            if( isset($tax_query[0]) )
            {
                $args['tax_query'] = array('relation' => 'AND');
                array_push( $args['tax_query'], $tax_query[0] );
            }
            if( isset($year_query) )
            {
                $args['date_query'] =  $year_query;
            }
            if( !empty($filters->keyword) )
            {
                $args = array_merge( $args, array( 's' => $filters->keyword ) );
            }
        }

        query_posts($args);

        // search for posts with terms
        return array( 'posts' => \Timber::get_posts( $args ), 'pagination' => \Timber::get_pagination() );

    }
}
