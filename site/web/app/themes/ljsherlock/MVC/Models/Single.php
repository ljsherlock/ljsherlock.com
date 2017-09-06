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
            //header
            'menu' => new \TimberMenu('Primary'),
            // footer
            'email' => CMB2::myprefix_get_option( CMB2::$prefix . 'contact_email'),
            'telephone' => CMB2::myprefix_get_option(CMB2::$prefix . 'contact_telephone'),
            'social_media' => CMB2::myprefix_get_option( CMB2::$prefix . 'social_media_links'),
            'footer_posts' => $posts,
            'footer_menu' => new \TimberMenu('Footer'),
            'copyright' => 'Copyright ' . Date('Y') . ' Sherlock Ltd',
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
