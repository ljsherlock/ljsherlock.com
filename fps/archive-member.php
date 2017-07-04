<?php

// Template Name: Archive Members

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
*   Post
\*------------------------*/
$post = get_page_by_path('members-content');
$post = new \TimberPost($post->ID);
$c['post'] = $post;

/*------------------------*\
*   Fields
\*------------------------*/
$c['members_filter'] = get_field( 'members_filter', $c['post']->ID);

/*------------------------*\
*   System filter
\*------------------------*/
$args = array(
    'taxonomy' => 'system',
    'parent'   => 0
);
$terms = Timber::get_terms($args);
$c['systems'] = $terms;

/*------------------------*\
*   Get posts
\*------------------------*/
$args = array(
    'post_type' => 'member',
    'posts_per_page' => 30,
    'paged' => get_query_var('paged'),
    "orderby"   => "name",
    "order"     => "ASC",
    'tax_query' => array(
        array(
            'taxonomy' =>  'type',
            'operator' => 'NOT EXISTS'
        ),
    )
);

$posts = Timber::get_posts($args);

/*------------------------*\
*   Pagination
\*------------------------*/
//make our query the default query to utilize Timber::get_pagination
query_posts($args);
$c['pagination'] = TImber::get_pagination();
$c['prev_text'] = 'Previous';
$c['next_text'] = 'More Members';
/*------------------------*\
*   append new Context
\*------------------------*/
$c['name'] = $post_type_str;
$c['posts'] = $posts;
$c['post_type_str'] = $post_type_str;

Timber::render( 'project_fps/_pages/page-members.twig', $c );
