<?php

class RW_Scripts
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

             wp_register_style( 'style' , RW_CSS . '/style'.$minF.'.css', false, '1.0.0' );
             wp_enqueue_style( 'style' );

         /*----------------------------------------------------
         *   JAVSCRIPT
         ----------------------------------------------------*/

             /*---------------------------
             *   POLYFILLS
             ---------------------------*/

             // MEDIA QUERIES ( vanilla )
             wp_register_script('respond', RW_JS . $minD. '/lib/respond'.$minF.'.js', false, null, $not_in_footer);
             wp_script_add_data('respond', 'conditional', 'lt IE 9');
             wp_enqueue_script('respond');

             // SVG ( vanilla )
            //  wp_register_script('svgxuse', RW_JS .$minD. '/svgxuse'.$minF.'.js', false, null, $not_in_footer);

             // FLEXBOX
            //  wp_register_script('flexibility', RW_JS. '/lib/flexibility.js', false, null, $not_in_footer);
            //  wp_enqueue_script('flexibility');

             // CLASSLIST
            //  wp_register_script('polyfills', RW_JS. '/lib/polyfills.js', false, null, $not_in_footer);
            //  wp_enqueue_script('polyfills');

             // MATCHES and CLOSEST
            //  wp_register_script('closets', RW_JS. '/lib/closest.js', false, null, $not_in_footer);
            //  wp_enqueue_script('closets');

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
                // wp_register_script('backstretch', RW_JS. '/lib/jquery.backstretch.min.js', array('jquery'), '2.0', $in_footer);
                //
                // // OwlCarousel for carousel (testimonials)
                // wp_register_script('owl-carousel', RW_JS . '/lib/owl.carousel.min.js', false, '1.3.3', $in_footer);
                //
                // wp_enqueue_script('backstretch');
                // wp_enqueue_script('owl-carousel');
                //
                // wp_register_script('scroll_reveal', RW_JS . '/lib/scrollreveal.min.js', false, '3.3.1', $in_footer);
                // wp_enqueue_script('scroll_reveal');
                wp_register_script('lib', RW_JS . '/min' . '/lib.min.js', false, '1.0', $in_footer);
                wp_enqueue_script('lib');
            }

            /*---------------------------
            *   CORE
            ---------------------------*/

            // JS Utility methods.
            // wp_register_script('utility', RW_JS . $minD . '/utility'.$minF.'.js', false , '1.0.0', $in_footer);
            //
            // // Cut the mustard.
            // wp_register_script('mustard', RW_JS . $minD . '/mustard'.$minF.'.js', array( 'utility' ) , '1.0.0', $in_footer);
            //
            // // Core
            // wp_register_script( 'core', RW_JS . $minD . '/core'.$minF.'.js', array( 'mustard', 'utility' ), '1.0.0', $in_footer);
            //
            // // Main
            // wp_register_script( 'app', RW_JS . $minD . '/app'.$minF.'.js', array( 'mustard', 'utility', 'core' ), '1.0.0', $in_footer);



            // Project specific functionality
            // Will not initialize without indication from mustard.
            wp_register_script( 'app', RW_JS . '/min' . '/app.min.js', false, '1.00', $in_footer);
            wp_localize_script( 'app', 'localized', array('BASE' => home_url(), 'js' => RW_JS ) );
            wp_enqueue_script( 'app' );

    }

    public static function admin_css() {
      echo '<style>
      li#menu-posts.menu-top-first {
          display: none;
      }
      </style>';
    }
}
