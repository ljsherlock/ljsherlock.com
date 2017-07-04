<?php

namespace Redwire;

class press_release
{

    const POST_TYPE     = "press-release";
    const POST_TAXONOMY = "press-release-category";

    public static function setup()
    {
        self::registerPostType();
        self::registerTaxonomy();

    }

    /**
     *  Register Case Study Post Type
     */
    public static function registerPostType()
    {
        $singular = 'Press Release';
        $plural = "Press Releases";

        $labels = array(
            'name'               => _x($plural, 'post type general name', RW_TEXT_DOMAIN),
            'singular_name'      => _x($singular, 'post type singular name', RW_TEXT_DOMAIN),
            'menu_name'          => _x($plural, 'admin menu', RW_TEXT_DOMAIN),
            'name_admin_bar'     => _x($singular, 'add new on admin bar', RW_TEXT_DOMAIN),
            'add_new'            => _x('Add New', 'post', RW_TEXT_DOMAIN),
            'add_new_item'       => __("Add New {$singular}", RW_TEXT_DOMAIN),
            'new_item'           => __("New {$singular}", RW_TEXT_DOMAIN),
            'edit_item'          => __("Edit {$singular}", RW_TEXT_DOMAIN),
            'view_item'          => __("View {$singular}", RW_TEXT_DOMAIN),
            'all_items'          => __("All {$plural}", RW_TEXT_DOMAIN),
            'search_items'       => __("Search {$plural}", RW_TEXT_DOMAIN),
            'parent_item_colon'  => __("Parent {$plural}:", RW_TEXT_DOMAIN),
            'not_found'          => __("No {$plural} found.", RW_TEXT_DOMAIN),
            'not_found_in_trash' => __("No {$plural} found in Trash.", RW_TEXT_DOMAIN)
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'news-views/' . self::POST_TYPE ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'menu_icon'          => 'dashicons-admin-post'
        );

        register_post_type( self::POST_TYPE , $args );

    }

    /**
     *  Register Case Study category Taxonomy
     */
    public static function registerTaxonomy()
    {

        register_taxonomy(
            self::POST_TAXONOMY,
            self::POST_TYPE,
            array(
                'label' => __('FPS Press Release Category', RW_TEXT_DOMAIN),
                'hierarchical' => true,
            )
        );

    }


        /**
         *  Register all FPS Thoughts by status ( Approved, Unapproved, Disapproved )
         *
         *  @return array
         */
        public static function getAllByStatus( $status = null )
        {

        	$meta_query 	= false;
        	if ( isset( $status ) )
        	{

        		$meta_query = array(
                                "key"   => "status",
                                "value" => $status,
    		                );

        	}

            return array(

                "post_type" 	 => self::POST_TYPE,
                "post_status"    => "publish",
                "meta_query"     => array( $meta_query ),
                "orderby"        => "date",
                "order"          => "DESC",

            );

        }


        /**
         *  Display all FPS Thoughts
         *
         *  @return array
         */
        public static function displayByStatus( $status = null )
        {
        	$output  = "";

        	$e = self::getAllByStatus( $status );

        	if ( $e->have_posts() ) :

    			$output 	.= "<table class='data large'>"
    							."<tbody>"
    						   		."<tr>"
    									."<th>Name</th>"
    									."<th>Date of endorsement</th>"
    									."<th>Valid until</th>"
    									."<th>Action</th>"
    							 	."</tr>";



    			while ( $e->have_posts() ) : $e->the_post();

    				$output .= "<tr>"
    							."<td>" .get_the_title() ."</td>"
    							."<td>" .get_field( "date_of_endorsement" ) ."</td>"
    							."<td>" .get_field( "valid_until" ) ."</td>"
    							."<td><a href='" .get_permalink() ."'>View details</a></td>"
    						  ."</tr>";


    			endwhile;

        		$output 	.= "</tbody>"
        				   	  ."</table>";

        	endif;

        	return $output;

        }

}
