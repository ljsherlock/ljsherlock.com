<?php

$c = Timber::get_context();

$post = new TimberPost();
$c['post'] = $post;

$searchBy = $_POST['search-by'];
$searchValue = $_POST['member_search'];

Timber::render( 'project_fps/_pages/page-search.twig', $c );
