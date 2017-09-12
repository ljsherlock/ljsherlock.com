<?php

namespace MVC\Models;

use Includes\Classes\CMB2 as CMB2;

class Frontpage extends Page
{
    /**
    * __construct
    * @param array $args Model arguments
    */
    public function __construct( $args )
    {
        parent::__construct( $args );
    }

    public function get()
    {
        // Work Posts: most recent.
        $archive = new \MVC\Models\Archive(array());
        $args = array( 'post_type' => 'work', 'query' => array( 'posts_per_page' => 1 ) );
        $work = $archive->query($args)[0];

        $this->timber->addContext( array(
            'work' => array('post' => $work, 'terms' => $archive->get_hierachical_terms($work, 'stats')['overview'] ),
            'captions ' => array(
                // 'instagram' => $this->instagram(),
                'left' => get_post_meta( $this->post->ID, CMB2::$prefix . 'hero_caption_left', true ),
                'right' => get_post_meta( $this->post->ID, CMB2::$prefix . 'hero_caption_right', true )
            ),
        ) );

        return parent::get();
    }

    private function instagram()
    {
        $access_token = CMB2::myprefix_get_option( 'instagram_at' );

        $recents = json_decode( file_get_contents('https://api.instagram.com/v1/users/self/media/recent/?access_token='. $access_token) );
        $images = array();

        foreach ($recents->data as $key => $item)
        {
            # code...
            $image = json_decode( file_get_contents('https://api.instagram.com/v1/media/'.$item->id.'?access_token='. $access_token) );
            array_push($images, array( 'url' => $image->data->images->standard_resolution->url, 'caption' => $item->caption->text ));
        }

        return $images;
    }

}
