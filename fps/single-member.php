<?php

$c = Timber::get_context();
$post = new TimberPost();

$c['post'] = $post;

$c['primary_provider'] = Redwire\Utils::wp_get_post_terms_hierarchy($post->ID, 'primary-provider');
$c['secondary_provider'] = Redwire\Utils::wp_get_post_terms_hierarchy($post->ID, 'secondary-provider');

$c['post_type'] = get_post_type_object( get_post_type($post) );



$c['google_map_query_string'] = 'http://maps.google.com/?q=' . implode(', ', array_map(function ($entry)
{
  return $entry['line'];
}, $c['fields']['member_info'][0]['address'][0]['lines']));

$current_url = esc_url_raw(add_query_arg([]));

Timber::render('project_fps/_pages/single-member.twig', $c );
