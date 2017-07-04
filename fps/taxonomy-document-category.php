<?php
// Template Name: Taxonomy Documents

if (!is_user_logged_in())
{
    wp_redirect("/user-login");
    exit();
}

/*------------------------*\
*   Context
\*------------------------*/
$c = Timber::get_context();

$post = new TimberPost();
$post->post_type = get_query_var( 'post_type' );

/*------------------------*\
*   Params
\*------------------------*/
global $params;
$taxonomy_str = 'document-category';
$term_str = $params['term'];
$taxonomy = get_taxonomy( $taxonomy_str );
$post_type_str = 'document';

/*------------------------*\
*   determine page no.
\*------------------------*/


/*------------------------*\
*   Get posts
\*------------------------*/
$args = array(
    'post_type' => get_query_var( 'post_type' ),
    'posts_per_page' => $c['posts_per_page'],
    "orderby"   => "date",
    "order"     => "DSC",
    'tax_query' => array(
		array(
			'taxonomy' =>  get_query_var( 'taxonomy' ),
            'field' => 'slug',
			'terms'    => get_query_var( 'term' ),
		),
	),
);
$posts = Timber::get_posts($args);
// die(var_dump($posts));
$c['posts'] = $posts;

/*------------------------*\
*   Pagination
\*------------------------*/
$c['pagination'] = Timber::get_pagination();


$c['global_hero'] = 'members';

/*------------------------*\
*   Render
\*------------------------*/
Timber::render( 'project_fps/_pages/documents.twig', $c );
