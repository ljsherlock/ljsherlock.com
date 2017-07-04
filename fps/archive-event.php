<?php

// Template Name: Archive Event

/*------------------------*\
*   Context
\*------------------------*/
$c = Timber::get_context();
$c['post_type'] = get_post_type_object('event');

/*------------------------*\
*   Params
\*------------------------*/
global $params;

// If date params sent, use for meta_query
// This means we can use this tmpl for month change
// with both PHP and JS/AJAX
$m = $params['m'];
$y = $params['y'];

$eventsCalendar = Redwire\Calendar::create_calendar($m, $y);

if (!is_user_logged_in())
{
    $terms = array('fps-meeting', 'industry-event');
} else {
    $terms = array('fps-meeting', 'industry-event', 'course-intake-deadline');
}

$args = array( 'taxonomy' => 'event-type', 'parent' => 0 );
$args = array( 'taxonomy' => 'event-type', 'parent' => 0, 'except');

$c['terms'] = Timber::get_terms($args);

$c['calendar'] = $eventsCalendar['calendar'];
$c['months'] = $eventsCalendar['viewData']['contents'];
$c['posts'] = $eventsCalendar['posts'];
$c['terms'] = $eventsCalendar['terms'];

Timber::render( 'project_fps/_pages/archive-event.twig', $c );
//
