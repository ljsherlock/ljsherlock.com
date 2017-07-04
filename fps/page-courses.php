<?php

// Template Name: Accordion Sections

$c = Timber::get_context();

$post = new TimberPost();
$c['post'] = $post;

/*------------------------*\
*   Breadcrumbs
\*------------------------*/
if($post->parent) {
    $breadcrumbs = array(
        array('anchor_link' => $post->parent->link, 'anchor_text' => $post->parent->name),
        array('anchor_link' => $post->link, 'anchor_text' => $post->name)
    );
}
$c['breadcrumbs'] = $breadcrumbs;


/*------------------------*\
*   Widgets
\*------------------------*/
// $widget_1 = Timber::get_widgets('courses_1');
// $widget_2 = Timber::get_widgets('courses_2');
// $c['widgets'] = array($widget_1, $widget_2);

/*------------------------*\
*   Accordion
\*------------------------*/

Timber::render( array('project_fps/_pages/page-accordions.twig'), $c );
