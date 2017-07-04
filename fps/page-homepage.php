<?php

$c = Timber::get_context();

/**
*   Member Search @property repeater
*/
$post = new TimberPost();

/**
*   Widgets @property rendered HTML
*/

$c['post'] = $post;

// var_dump($c['fields']['hero']);

$c['home_intro_1'] = Timber::get_widgets('home_intro_1');
$c['home_intro_2'] = Timber::get_widgets('home_intro_2');
$c['home_intro_3'] = Timber::get_widgets('home_intro_3');

$c['home_find_member_1'] = Timber::get_widgets('home_find_member_1');
$c['home_find_member_2'] = Timber::get_widgets('home_find_member_2');

$c['feed_1'] = Timber::get_widgets('feed_1');
$c['feed_2'] = Timber::get_widgets('feed_2');
$c['feed_3'] = Timber::get_widgets('feed_3');
$c['feed_4'] = Timber::get_widgets('feed_4');
$c['heros'] = $c['fields']['hero'];

$c['fps_recent_posts'] = Timber::get_widgets('fps_recent_posts');


// Search items By Type
$args = array(
    'taxonomy' => 'system',
    'parent'   => 0,
    'hide_empty' => true,
    'order' => 'ASC'
);
$terms = Timber::get_terms($args);
$systems = $terms;
// var_dump($terms);

//Search items by company
$args = array(
    'posts_per_page' => 100,
    'post_type' => 'member',
    "orderby"   => "name",
    "order"     => "ASC",
    'tax_query' => array(
        array(
            'taxonomy' =>  'type',
            'operator' => 'NOT EXISTS'
        ),
    )
);
$company = Timber::get_posts($args);

$c['search_options'] = array('company' => $company, 'systems' => $systems );

// Pass context to the template
Timber::render( array('project_fps/_pages/home.twig', 'project_fps/_pages/page.twig' ), $c );
