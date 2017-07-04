<?php

$c = Timber::get_context();

// Hide breadcrumbs for this page
// $c['breadcrumbs'][0]['anchor_link'] = '';

Timber::render( array('project_fps/_pages/single-document.twig', 'project_fps/_pages/page.twig' ), $c );
