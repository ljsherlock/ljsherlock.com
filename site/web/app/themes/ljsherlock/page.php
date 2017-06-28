<?php
/**
 * TEMPLATE NAME: Blog Archive
 */

get_header(); ?>

<?php
    // $c = Timber::get_context();

    // all client facing information
    $ArchivesFilter = new Redwire\ArchivesFilter();

    // Context
    $c['tags'] = $ArchivesFilter->tags;
    $c['cats'] = $ArchivesFilter->cats;
    $c['years'] = $ArchivesFilter->years;

    if( isset($_POST) && !empty($_POST) )
    {
        $filters = $_POST;
        $c['posts'] = $ArchivesFilter->search($filters);
    }

    // Render the template with registered context.
    Timber::render('_pages/blog-archive/blog-archive.twig', $c );
?>

<?php get_footer(); ?>
