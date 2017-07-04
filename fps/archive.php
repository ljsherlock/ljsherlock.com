<?php

// Template Name: Archive

/*------------------------*\
*   Context
\*------------------------*/
$c = Timber::get_context();

$post = new TimberPost();
$c['post'] = $post;

/*------------------------*\
*   Params
\*------------------------*/
global $params;

$c['breadcrumbs'][0] = array('anchor_text' => 'News & Views', 'anchor_link' => '/news-views');
$post_type_str = (!isset($params['name']) || !$params['name']) ? get_post_type() : $params['name'];

/*------------------------*\
*   Get posts
\*------------------------*/

$args = array(
    'post_type' => $post_type_str,
    'posts_per_page' => $c['posts_per_page'],
    'paged' => $params['pg'],
    "orderby"   => "date",
    "order"     => "DSC"
);
$posts = Timber::get_posts($args);

/*------------------------*\
*   Pagination
\*------------------------*/
query_posts($args);
$c['pagination'] = TImber::get_pagination();

/*------------------------*\
*   Terms
\*------------------------*/
$c['terms'] = wp_get_post_terms();

/*------------------------*\
*   append new Context
\*------------------------*/
$c['post_type'] = get_post_type_object($post_type_str);
$c['global_hero'] = $post_type_str;
$c['name'] = $post_type_str;
$c['posts'] = $posts;
$c['post_type_str'] = $post_type_str;

Timber::render( 'project_fps/_pages/archive.twig' , $c );
