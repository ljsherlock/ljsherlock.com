<?php

namespace Redwire;

class Ajax
{
    public static function setup()
    {
        // Ajax slides
        add_action('wp_ajax_get_images', array(__CLASS__, 'get_images') );
        add_action('wp_ajax_nopriv_get_images', array(__CLASS__, 'get_images') );

        add_action('wp_ajax_get_calendar', array(__CLASS__, 'get_calendar') );
        add_action('wp_ajax_nopriv_get_calendar', array(__CLASS__, 'get_calendar') );
    }

    /*
    * Return slide urls for slideshow
    */
    public function get_images($id)
    {
        /**
        * @todo: this is a slideshow. Hero describes a
        *  slideshow located at the top of a page
        */

        $image_key = $_GET['image_key'];
        $id = $_GET['id'];
        $parent_id = $_GET['parent_id'];
        $global_hero = $_GET['global_hero'];
        $retina = $_GET['retina'];

        if( !empty( $id ) && get_field( 'hero', $id) != NULL )
        {
            $heros = get_field( 'hero', $id);

            if($heros == NULL)
            {
                if( $postype = get_post_type_object(get_post_type($id)) )
                {
                    $heros = get_field($postype . '_hero');
                }
            }
        }
        elseif( !empty( $global_hero ) )
        {
            if( $global_hero == 'members' ) {
                $options = get_fields('options');
                $heros = $options['members_hero_image']['hero'];
            } else {
                $heros = get_field( $global_hero . '_hero' , 'options');
                // $heros = $heros['hero'];
            }
        }
        else
        {
            $heros = get_field( 'hero', $parent_id);
        }

        $slides = [];

        foreach($heros as $key => $field)
        {
            $slide = RW_Images::serve_image( $field['hero__item_image'], $image_key, true, $retina );
            array_push( $slides, $slide );
        }

        $response = $slides;

        echo json_encode( $slides );
        die();
    }

    public static function get_calendar()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        // die(var_dump($data));

        if( (isset( $data->m ) && !empty( $data->m )) && isset( $data->y ) && !empty( $data->y ) )
        {
            $m = $data->m;
            $y = $data->y;
        } else {
            echo json_encode( 'No date given' );
            die();
        }

        $eventsCalendar = Calendar::create_calendar($m, $y);

        $c['calendar'] = $eventsCalendar['calendar'];
        $c['months'] = $eventsCalendar['viewData']['contents'];
        $c['posts'] = $eventsCalendar['posts'];
        $c['ajax'] = true;

        $html = \Timber::compile( 'archive-event.twig', $c );

        echo $html;
        die();
    }
}
