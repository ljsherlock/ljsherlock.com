<?php

namespace Redwire;

class Core
{
    public static function init()
    {

        \RW_Scripts::setup();

        // Widgets
        add_action( 'widgets_init',  array('RW_widgets', 'add_widget_areas' ) );
        add_action( 'widgets_init', array('RW_widgets', 'initialize_widgets' ) );

        add_action( 'init', array('RW_shortcodes', 'initialize_shortcodes' ) );

        /**
         *  Optimise WordPress
         *  Reduce number of SQL Queries & Remove unnecessary data from html
         */
        OptimiseWP::setup();


        /**
        * Setup Timber
        * Add template folders
        */
        WPTimber::setup();

        /**
        * Setup ACF
        * Add options pages
        */
        ACF::setup();

        /**
        * WP Images
        * Add images sizes
        * Add theme support
        */
        RW_Images::setup();

        /**
        * WP Navigation
        * Register Navigation Menus
        * Add current nav class action
        */
        WPNav::setup();

        /**
        * WP Posts
        * Init custom posts
        */
        RW_Posts::setup();

    }
}
