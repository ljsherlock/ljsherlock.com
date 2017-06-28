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

        add_action('wp_ajax_archivesFilterSearch', array(__CLASS__, 'search') );
        add_action('wp_ajax_nopriv_archivesFilterSearch', array(__CLASS__, 'search') );
    }

    public function search($filters)
    {
        if( !isset($filters) )
        {
            $request_body = file_get_contents('php://input');
            $filters = json_decode($request_body);
        }
        // WPSearch::search_posts( $term );
        echo $this->filterQuery($filters);
    }

    private function filterQuery($filters)
    {
        $tax_query = array('relation' => 'OR');
        $year_query = array('relation' => 'OR');

        if( isset( $filters['post_tag'] ) ) {
            array_push( $tax_query,
                array( 'taxonomy' => 'post_tag', 'field' => 'slug', 'terms' => $filters['post_tag'] )
            );
        }

        if( isset( $filters['category'] ) ) {
            array_push( $tax_query,
                array( 'taxonomy' => 'tag', 'field' => 'slug', 'terms' => $filters['category'] )
            );
        }

        if( isset( $filters['years )'] ) )
        {
            $year_query = array('relation' => 'OR');
            foreach ($filters['years'] as $year)
            {
                array_push( $year_query,
                    array( 'year' => $year )
                );
            }
        }

        // search for posts with terms
        $args = array(
            'post_type' => 'post',
            "orderby"   => "post_date",
            "order"     => "ASC",
            'tax_query' => $tax_query,
            'date_query' => $year_query,
        );

        return \Timber::get_posts( $args );
    }
}
