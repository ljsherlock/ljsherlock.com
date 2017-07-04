<?php

if (!is_user_logged_in())
{
    wp_redirect("/user-login");
    exit();
}

$c = Timber::get_context();

$post = new TimberPost();
$c['post'] = $post;

$term = $_POST['term'];
$c['term'] = $term;
$c['global_hero'] = 'members';
$c['posts'] = Redwire\WPSearch::search_documents($term);
// die(var_dump($c['posts']));

Timber::render( 'project_fps/_pages/documents-search.twig', $c );
