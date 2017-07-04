<?php

$c = Timber::get_context();

$post = get_page_by_path('page-not-found');

$c['post'] = $post;

// Render Page
Timber::render( array('404.twig' ), $c );
exit();
