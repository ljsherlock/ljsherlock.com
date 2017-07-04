<?php

$c = Timber::get_context();

$post = new TimberPost();
$c['post'] = $post;

$term = $_POST['term'];
$c['term'] = $term;

$ids = Redwire\WPSearch::search_posts($term);

$args = array(
    'post_type' => 'any',
    'paged' => get_query_var('paged'),
    'post__in' => $ids
);
$c['posts'] = Timber::get_posts($args);
query_posts($args);

$c['pagination'] = Timber::get_pagination();
$c['prev_text'] = 'Back';
$c['next_text'] = 'More Results';

// die(var_dump( $c['pagination'] ));

Timber::render( 'project_fps/_pages/page-search.twig', $c );
