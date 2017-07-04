<?php

// Template Name: Content with documents aside

/*------------------------*\
*   Context
\*------------------------*/
$c = Timber::get_context();

$post = $c['post'];

// breadcrumbs
if($post->parent) {
    $c['breadcrumbs'] = array(
        array('anchor_link' => $post->parent->link, 'anchor_text' => $post->parent->name),
        array('anchor_link' => $post->link, 'anchor_text' => $post->name)
    );
}

/*------------------------*\
*   Get Post
\*------------------------*/
// Pass context to the template
Timber::render( array('project_fps/_pages/tmpl-2-col-documents.twig' ), $c );
