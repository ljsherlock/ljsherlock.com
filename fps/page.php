<?php

$c = Timber::get_context();

$post = new TimberPost();
$c['post'] = $post;

// breadcrumbs
if($post->parent) {
    $breadcrumbs = array(
        array('anchor_link' => $post->parent->link, 'anchor_text' => $post->parent->name),
        array('anchor_link' => $post->link, 'anchor_text' => $post->name)
    );
}

$c['breadcrumbs'] = $breadcrumbs;

Timber::render( array('project_fps/_pages/page-'. $post->post_name .'.twig',
                    'project_fps/_pages/page-' .$post->parent->slug.'.twig',
                    'project_fps/_pages/page.twig'
), $c );
