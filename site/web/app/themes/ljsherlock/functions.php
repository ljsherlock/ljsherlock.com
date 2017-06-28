<?php

require_once 'includes/include.php';

Redwire\App::setup();

add_action('wp_ajax_archivesFilterSearch', array('Redwire\ArchivesFilter', 'search_ajax') );
add_action('wp_ajax_nopriv_archivesFilterSearch', array('Redwire\ArchivesFilter', 'search_ajax') );

?>
