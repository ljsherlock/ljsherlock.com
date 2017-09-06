<?php

namespace MVC\Models;

use Includes\Classes\CMB2 as CMB2;

class Single extends Base
{

    public $sidebars = array();

    /**
    *   @method __construct
    *   @return get
    **/
    public function __construct($args)
    {
        parent::__construct($args);

        // set Sidebars and merge
        $this->sidebars = array(
            'sidebar',
            'sidebar__header',
            'sidebar__footer',
            'sidebar__homepage_main',
            'sidebar__after_app',
        );
        if( isset( $this->args['sidebars'] ) )
        {
            array_merge( $this->sidebars, $this->args['sidebars'] ) ;
        }

        $this->post = new \TimberPost();
    }

    /**
    *   @method get
    *   @return parent::get()
    *
    *
    **/
    public function get()
    {
        // if sidebars exist, call addSidebar().
        if( isset($this->sidebars) )
        {
            $this->addSidebar( $this->sidebars );
        }

        // query Work posts for Footer
        $archive = new \MVC\Models\Archive(array());
        $args = array( 'query' => array( 'posts_per_page' => 3 ) );
        $posts = $archive->query($args);

        $this->timber->addContext( array(
            // content
            'subtitle' => get_post_meta( $this->post->ID, CMB2::$prefix . 'subtitle', true ),
            'post' => $this->post,
            'terms' => $this->terms(),
            //header
            'menu' => new \TimberMenu('Primary'),
            // footer
            'email' => CMB2::myprefix_get_option( CMB2::$prefix . 'contact_email'),
            'telephone' => CMB2::myprefix_get_option(CMB2::$prefix . 'contact_telephone'),
            'social_media' => CMB2::myprefix_get_option( CMB2::$prefix . 'social_media_links'),
            'footer_posts' => $posts,
            'footer_menu' => new \TimberMenu('Footer'),
            'copyright' => 'Copyright ' . date('Y') . ' Sherlock Ltd',
        ));

        return parent::get();
    }

    public function addSidebar($sidebars)
    {
        foreach ($sidebars as $key => $sidebar)
        {
            $this->timber->addContext( array( $sidebar => \Timber::get_widgets( $sidebar ) ) );
        }
    }

    public function terms($args = array(), $output = 'names')
    {
        $terms = wp_get_object_terms( $this->post->ID, get_taxonomies($args, $output));

        $timberTerms = array();

        foreach ($terms as $key => $term)
        {
            $timberTerms[$key] = new \TimberTerm( $term->term_id );
        }

        return $timberTerms;
    }

    public function wp_get_terms_hierarchy($tax)
    {
        $terms = get_terms( array('taxonomy' => $tax, 'parent' => 0, 'hide_empty' => true) );
        $sorted_terms = [];

        $sorted_terms = $this->wp_get_terms_hierarchy_loop($tax, $terms, $sorted_terms);

        unset( $sorted_terms['children'] );

        return $sorted_terms['sorted_terms'];
    }

    public function wp_get_terms_hierarchy_loop($tax, $terms, $sorted_terms = array())
    {
        foreach ($terms as $key => &$term)
        {
            // get children at current level.
            $children = get_terms($tax, array( 'parent' => $term->term_id, 'hide_empty' => true) );

            if( count($children) > 0 )
            {
                // loop through indefinite children (scary).
                $loop = $this->wp_get_terms_hierarchy_loop($tax, $children, $sorted_terms);

                // add returned children to current term.
                $term->children = $loop['children'];
            }
            // Add the current term to final array.
            $sorted_terms[$term->slug] = $term;
        }

        return array('children' => $terms, 'sorted_terms' => $sorted_terms);
    }
}
