<?php

// Template Name: Archive FPS Officers

/*------------------------*\
*   Context
\*------------------------*/
$c = Timber::get_context();

/*------------------------*\
*   Params
\*------------------------*/
global $params;
$post_type_str = 'fps-officer';

/*------------------------*\
*   determine page no.
\*------------------------*/
$paged = Redwire\RW_page::get_paged( $params['pg'] );

/*------------------------*\
*   Get posts
\*------------------------*/
$args = array(
    'post_type' => $post_type_str,
    'paged' => $paged,
    "orderby"   => "date",
    "order"     => "ASC",
    'tax_query' => array(
        array(
            'taxonomy' =>  'officer-type',
            'field' => 'slug',
            'terms'    => 'officer',
        ),
    ),
);
$officers = Timber::get_posts($args);
$terms = array('chairman' => array(), 'vice-chairman' => array() , 'past-chairman' => array(), 'effc-officer' => array(), 'secretary' => array());
$sorted_officers = array();
foreach( $officers as $off )
{
    $p_terms = wp_get_post_terms($off->ID, 'position');
    foreach ($terms as $key => $term)
    {
        if ($p_terms[0]->slug == $key)
        {
            $terms[$key][] = $off;
        }
    }
}
foreach ($terms as $key => $term)
{
    array_push($sorted_officers, $term[0]);
}
$c['officers'] = $sorted_officers;
$c['officers_term'] = get_term_by('slug', 'officer', 'officer-type');

$args = array(
    'post_type' => $post_type_str,
    'paged' => $paged,
    "orderby"   => "date",
    "order"     => "DSC",
    'tax_query' => array(
        array(
            'taxonomy' =>  'officer-type',
            'field' => 'slug',
            'terms'    => 'committee-chairman',
        ),
    ),
);
$c['committee_chairmen'] = Timber::get_posts($args);
$c['committee_chairmen_term'] = get_term_by('slug', 'committee-chairman', 'officer-type');

// die(var_dump($c['committee_chairmen_term']));

/*------------------------*\
*   Pagination
\*------------------------*/
// $moar_pg = Redwire\RW_page::pagination( $paged, $post_type_str, count($posts) );

/*------------------------*\
*   append new Context
\*------------------------*/
$c['name'] = $post_type_str;
$c['post_type_str'] = $post_type_str;

Timber::render( 'project_fps/_pages/page-fps-officers.twig', $c );
