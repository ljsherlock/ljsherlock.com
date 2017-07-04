<?php
/**
 * TEMPLATE NAME: Blog Archive
 */

get_header(); ?>

<?php
    // all client facing information
    $ArchivesFilter = new Redwire\ArchivesFilter();

    // Context
    $c['tags'] = $ArchivesFilter->tags;
    $c['cats'] = $ArchivesFilter->cats;
    $c['years'] = $ArchivesFilter->years;

    if( isset($_POST) && !empty($_POST) )
    {
        $filters = $_POST;
        // var_dump($filters);
        $results = $ArchivesFilter->filterQuery($filters, $filters['paged']);
        $c['posts'] = $results['posts'];
        $c['pagination'] = $results['pagination'];
        $c['paged'] = $posts['pagination']['current'];
    }

    // Render the template with registered context.
    Timber::render('_pages/blog-archive/blog-archive.twig', $c );
?>

<?php get_footer(); ?>
