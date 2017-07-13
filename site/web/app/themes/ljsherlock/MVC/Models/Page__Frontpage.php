<?php

namespace MVC\Models;

class Page__Frontpage extends Page
{
    /**
    * @type (obj) page object with ACF fields added
    * @property featured_image (url)
    * @property icon (string)
    * @property sub_heading (string)
    * @property colour (string)
    */
    public $featured_pages = array();

    /**
    * __construct
    * @param array $args Model arguments
    */
    public function __construct( $args )
    {
        parent::__construct( $args );

        $this->pages = get_field('pages');
    }

    public function get()
    {
        $this->timber->addContext( array(
            'featured_image' => \Includes\Classes\Images::serve_image( get_field('featured_image'), 'banner', true, false),
            'featured_pages' => $this->featured_pages(),
        ) );

        return parent::get();
    }

    public function featured_pages()
    {
        foreach ($this->pages as $key => $page)
        {
            $this->featured_pages[$key] = $page['page'];
            $this->featured_pages[$key]->featured_image = \Includes\Classes\Images::serve_image( get_field('featured_image1', $page['page']->ID), 'tile', true, false );
            $this->featured_pages[$key]->sub_heading = get_field('sub_heading', $page['page']->ID);
            $this->featured_pages[$key]->intro = get_field('intro', $page['page']->ID)[0];
            $this->featured_pages[$key]->icon = 'icon-' . get_field('icon', $page['page']->ID);
            $this->featured_pages[$key]->colour = get_field('colour', $page['page']->ID);
        }
        return $this->featured_pages;
    }
}
