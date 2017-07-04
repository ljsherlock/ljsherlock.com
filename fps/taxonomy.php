<?php
// Template Name: Taxonomy

/*------------------------*\
*   Context
\*------------------------*/
$c = Timber::get_context();

/*------------------------*\
*   Params
\*------------------------*/
global $params;
$taxonomy_str = $params['taxonomy'];
$term_str = $params['term'];
$taxonomy = get_taxonomy( $taxonomy_str );
$post_type_str = $taxonomy->object_type;

/*------------------------*\
*   determine page no.
\*------------------------*/
$paged = Redwire\RW_page::get_paged( $params['pg'] );

/*------------------------*\
*   Get Posts
\*------------------------*/
$args = array(
    'post_type' => 'member',
    'posts_per_page' => $c['posts_per_page'],
    'paged' => $paged,
    "orderby"   => "date",
    "order"     => "DSC",
    'tax_query' => array(
		array(
			'taxonomy' =>  $taxonomy_str,
            'field' => 'slug',
			'terms'    => $term_str,
		),
	),
);
$posts = Timber::get_posts($args);
$c['posts'] = $posts;

/*------------------------*\
*   Pagination
\*------------------------*/
$moar_pg = Redwire\RW_page::pagination( $paged, $post_type_str, wp_count_posts($posts) );
$c['pg'] = $paged;
$c['moar_pg'] = $moar_pg;
$c['prev_text'] = 'Newer ' . $taxonomy->name;
$c['next_text'] = 'Older ' . $taxonomy->name;
$c['prev'] = ($paged == 1) ? '' : 'page/' . ($paged - 1);
$c['next'] = ($moar_pg > 0) ? 'page/' . ($paged + 1)  : '';

/*------------------------*\
*   System filter
\*------------------------*/
$args = array(
    'taxonomy' => $taxonomy_str,
    'parent'   => 0
);
$terms = Timber::get_terms($args);
$c['systems'] = $terms;
$c['post'] = get_page_by_path('members');
$c['members_filter'] = get_field( 'members_filter', $page->ID);

/*------------------------*\
*   Render
\*------------------------*/
Timber::render( 'project_fps/_pages/taxonomy-' .$post->post_name. '.twig', $c );
