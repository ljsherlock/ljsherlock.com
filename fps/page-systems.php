<?php

$c = Timber::get_context();
$post = new TimberPost();

$c['post'] = $post;

$primary = Redwire\Utils::wp_get_terms_hierarchy_show_empty('primary-provider');
$secondary = Redwire\Utils::wp_get_terms_hierarchy_show_empty('secondary-provider');

$primary = $primary['sorted_terms'];
$secondary = $secondary['sorted_terms'];

$sorted_terms = [];

foreach ($primary as $key => &$parent)
{
    foreach ($parent->children as $key2 => &$term)
    {
        $members = Timber::get_posts(array(
            'tax_query' => array(
                array(
                    'taxonomy' =>  $term->taxonomy,
                    'field' => 'slug',
                    'terms'    => $term->slug,
                ),
            ),
        ));
        $secondary_members = Timber::get_posts(array(
            'tax_query' => array(
                array(
                    'taxonomy' =>  'secondary-provider',
                    'field' => 'slug',
                    'terms'    => $term->slug,
                ),
            ),
        ));

        if(count($members > 0))
        {
            $term->primary_members = $members;
        }
        if(count($secondary_members > 0))
        {
            $term->secondary_members = $secondary_members;
        }


    }
    $sorted_terms[] = $parent;
}



// var_dump($sorted_terms);

$c['systems'] = $sorted_terms;

$current_url = esc_url_raw( add_query_arg([]) );

Timber::render('project_fps/_pages/page-systems.twig', $c );
