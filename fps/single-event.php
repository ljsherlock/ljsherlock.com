<?php

$c = Timber::get_context();
$post = new TimberPost();

$c['post'] = $post;
$c['post_type'] = get_post_type_object($post->post_type);
$c['logo'] = Redwire\RW_Images::serve_image( $c['fields']['logo'], 'tile', false );

Timber::render( array('project_fps/_pages/single-' . $post->post_name . '.twig', 'project_fps/_pages/single-' . $post->post_type . '.twig', 'project_fps/_pages/single.twig' ), $c );
