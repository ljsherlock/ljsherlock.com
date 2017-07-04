<?php

namespace Includes\Classes;

class Scripts
{

    public static function setup()
    {
        add_action('wp_enqueue_scripts', array(__CLASS__, 'load_scripts'));
        add_action('admin_head', array(__CLASS__,'admin_css'));
    }

    /**
    *  Register & Load CSS & Scripts
    *
    *  @todo   concatenize where needed when going live
    */
    public static function load_scripts()
    {
        $in_footer = true;
        $not_in_footer = false;

        $minD = (DEVELOPING == false) ? '/min' : '';
        $minF = (DEVELOPING == false) ? '.min' : '';

        /*----------------------------------------------------
        *   CSS
        ----------------------------------------------------*/

             wp_register_style( 'style' , LJS_CSS . '/style'.$minF.'.css', false, '1.0.0' );
             wp_enqueue_style( 'style' );

         /*----------------------------------------------------
         *   JAVSCRIPT
         ----------------------------------------------------*/

             /*---------------------------
             *   POLYFILLS
             ---------------------------*/

             // MEDIA QUERIES ( vanilla )
             wp_register_script('respond', LJS_JS . $minD. '/respond'.$minF.'.js', false, null, $not_in_footer);
             wp_script_add_data('respond', 'conditional', 'lt IE 9');
             wp_enqueue_script('respond');

             // SVG ( vanilla )
             wp_register_script('svgxuse', LJS_JS .$minD. '/svgxuse'.$minF.'.js', false, null, $not_in_footer);
             wp_enqueue_script('svgxuse');


             /*---------------------------
             *   LIBRARY
             ---------------------------*/

             // If browser does not cut the mustard, these libraries will not wor
            if( _MUSTARD == 'true' )
            {
                //	Use latest jQuery release
                if( !is_admin() )
                {
                    wp_deregister_script('jquery');
                    wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '');
                    wp_enqueue_script('jquery');
                }

                // Backstretch.js for slideshow
                wp_register_script('backstretch', LJS_JS. '/lib/jquery.backstretch.min.js', array('jquery'), '2.0', $in_footer);
                wp_enqueue_script('backstretch');

                wp_register_script('tweenMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js', false, '1.19.1', $in_footer);
                wp_enqueue_script('tweenMax');

                wp_register_script('scroll_reveal', LJS_JS . '/lib/scrollreveal.min.js', false, '3.3.1', $in_footer);
                wp_enqueue_script('scroll_reveal');
            }

            /*---------------------------
            *   CORE
            ---------------------------*/

            // JS Utility methods.
            wp_register_script('utility', LJS_JS . $minD . '/utility'.$minF.'.js', false , '1.0.0', $in_footer);
            wp_enqueue_script( 'utility' );

            // Cut the mustard.
            wp_register_script('mustard', LJS_JS . $minD . '/mustard'.$minF.'.js', array( 'utility' ) , '1.0.0', $in_footer);
            wp_enqueue_script( 'mustard' );

            // Core
            wp_register_script( 'core', LJS_JS . $minD . '/core'.$minF.'.js', array( 'mustard', 'utility' ), '1.0.0', $in_footer);
            wp_enqueue_script( 'core' );

            // Project specific functionality
            // Will not initialize without indication from mustard.
            wp_register_script( 'app', LJS_JS . $minD . '/app'.$minF.'.js', array( 'mustard', 'utility', 'core' ), '1.0.0', $in_footer);
            wp_localize_script( 'app', 'localized', array('BASE' => home_url()) );
            wp_enqueue_script( 'app' );

    }

    public static function admin_css()
    {
    //   echo '<style>
    //   li#menu-posts.menu-top-first {
    //       display: none;
    //   }
    //   </style>';
    }
}
