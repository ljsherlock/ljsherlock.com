<?php
// Template Name: Taxonomy System

/*------------------------*\
*   Context
\*------------------------*/
$c = Timber::get_context();

/*------------------------*\
*   Params
\*------------------------*/
global $params;
$taxonomy_str = 'system';
$term_str = $params['term'];
$taxonomy = get_taxonomy( $taxonomy_str );
$post_type_str = $taxonomy->object_type[0];

/*------------------------*\
*   determine page no.
\*------------------------*/

/*------------------------*\
*   Get Posts
\*------------------------*/

$args = array(
    'post_type' => 'member',
    'posts_per_page' => 30,
    'paged' => get_query_var('paged'),
    "orderby"   => "post_title",
    "order"     => "ASC",
    'tax_query' => array(
		array(
			'taxonomy' =>  get_query_var('taxonomy'),
            'field' => 'slug',
			'terms'    => get_query_var('term'),
		),
        array(
            'taxonomy' =>  'type',
            'operator' => 'NOT EXISTS'
        ),
	),
);
$posts = Timber::get_posts($args);
$c['posts'] = $posts;

/*------------------------*\
*   Pagination
\*------------------------*/
//make our query the default query to utilize Timber::get_pagination
query_posts($args);
$c['pagination'] = TImber::get_pagination();
$c['prev_text'] = 'Previous';
$c['next_text'] = 'More Members';

/*------------------------*\
*   System filter
\*------------------------*/
$args = array(
    'taxonomy' => $taxonomy_str,
    'parent'   => 0,
    'hide_empty' => true,
);
$terms = Timber::get_terms($args);
$c['systems'] = $terms;
$c['post'] = get_page_by_path('members-content');
$c['members_filter'] = get_field( 'members_filter', $c['post']->ID);

/*------------------------*\
*   Render
\*------------------------*/
Timber::render( 'project_fps/_pages/page-members.twig', $c );
