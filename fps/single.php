<?php

$c = Timber::get_context();
$post = new TimberPost();

$c['post'] = $post;

$c['post_type'] = get_post_type_object($post->post_type);

array_unshift($c['breadcrumbs'], array('anchor_text' => 'News & Views', 'anchor_link' => '#'));

Timber::render( array('project_fps/_pages/single-' . $post->post_name . '.twig', 'project_fps/_pages/single-' . $post->post_type . '.twig', 'project_fps/_pages/single.twig' ), $c );
