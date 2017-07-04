<?php

if (!is_user_logged_in())
{
    wp_redirect("/user-login");
    exit();
}

$c = Timber::get_context();

$menu = Redwire\Utils::wp_get_terms_hierarchy('document-category');


$post = new TimberPost();
$c['post'] = $post;

// Render
Timber::render( 'project_fps/_pages/documents.twig' , $c );
