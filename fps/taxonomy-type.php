<?php

// Template Name: Archive Associate Members

/*------------------------*\
*   Context
\*------------------------*/
$c = Timber::get_context();

/*------------------------*\
*   Params
\*------------------------*/
global $params;
$post_type_str = 'member';

/*------------------------*\
*   Get posts
\*------------------------*/

$tax_terms = get_terms(array(
    'taxonomy' => get_query_var('taxonomy'),
    'orderby' => 'name',
    'childless' => true ));
$posts = [];

foreach ($tax_terms as $key => $term) {
    $args = array(
        'post_type' => get_query_var('post-type'),
        'posts_per_page' => 9,
        'paged' => get_query_var('paged'),
        "orderby"   => "post_title",
        "order"     => "ASC",
        'tax_query' => array(
            array(
                'taxonomy' =>  get_query_var('taxonomy'),
                'field' => 'slug',
                'terms' => $term,
            ),
        ),
    );
    $posts[$key]['term_name'] = $term->name;
    $posts[$key]['posts'] = Timber::get_posts($args);
}


/*------------------------*\
*   Pagination
\*------------------------*/
query_posts($args);
$c['pagination'] = TImber::get_pagination();

/*------------------------*\
*   append new Context
\*------------------------*/
$c['name'] = $post_type_str;
$c['posts'] = $posts;
$c['post_type_str'] = $post_type_str;

Timber::render( 'project_fps/_pages/archive-associate-members.twig', $c );
