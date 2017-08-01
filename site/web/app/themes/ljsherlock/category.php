<?php

$archive = new MVC\Controllers\Archive( array(
    'post_type' => 'post',
    'query' => array(
        'category_name' => get_the_category()[0]->slug,
    )
));
$archive->show();
