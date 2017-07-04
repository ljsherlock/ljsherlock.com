<?php

namespace Redwire;

class RW_page
{

    public static function get_paged( $pg )
    {
        return $paged = ( !isset($pg) || !$pg ) ? 1 : $pg ;
    }

    public static function pagination( $paged, $total_posts, $post_count )
    {

        return $total_posts - ( (($paged - 1) * 9) + $post_count );

    }
}
