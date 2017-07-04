<?php

/*------------------------*\
*   Context
\*------------------------*/

$c = Timber::get_context();

/*------------------------*\
*   Get Post
\*------------------------*/
$post = new TimberPost();
$c['post'] = $post;
// die(var_dump($post));

/*------------------------*\
*   Widgets
\*------------------------*/
$c['careers_1'] = Timber::get_widgets('careers_1');
$c['careers_2'] = Timber::get_widgets('careers_2');
$c['careers_3'] = Timber::get_widgets('careers_3');
$c['careers_4'] = Timber::get_widgets('careers_4');


$c['fps_recent_posts'] = Timber::get_widgets('fps_recent_posts');


// Pass context to the template
Timber::render( array('project_fps/_pages/page-careers.twig' ), $c );
