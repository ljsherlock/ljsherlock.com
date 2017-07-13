<?php

namespace Includes\Classes;

class ACF
{

    public static function setup()
    {
        self::register_options_pages();

        // Add option page
        if( function_exists('acf_add_options_page') ) {
        	acf_add_options_page();
        }
    }

    /**
     *  Register ACF Options Pages
     */
    public static function register_options_pages()
    {
        if (!function_exists('acf_add_options_sub_page')) {
            return false;
        }

        acf_add_options_sub_page('Main');

    }

    /**
     * [list_searcheable_acf list all the custom fields we want to include in our search query]
     * @return [array] [list of custom fields]
     */
    public static function list_searcheable_fields()
    {
      $list_searcheable_acf = array("accordion" );

      return $list_searcheable_acf;
    }

}
