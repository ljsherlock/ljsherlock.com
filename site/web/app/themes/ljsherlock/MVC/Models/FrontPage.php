<?php

namespace MVC\Models;

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


        $single = new \MVC\Models\Single(array());
        $this->timber->addContext( array(
            'work' => array('post' => $work, 'terms' => $single->terms($work) ),
            'instagram' => $this->instagram(),
        ));

        return parent::get();
    }

    private function instagram()
    {
        $recents = json_decode( file_get_contents('https://api.instagram.com/v1/users/self/media/recent/?access_token='. LJS_INSTAGRAM_AT) );
        $images = array();

        foreach ($recents->data as $key => $item)
        {
            # code...
            $image = json_decode( file_get_contents('https://api.instagram.com/v1/media/'.$item->id.'?access_token='. LJS_INSTAGRAM_AT) );
            array_push($images, array( 'url' => $image->data->images->standard_resolution->url, 'caption' => $item->caption->text ));
        }

        return $images;
    }

}
