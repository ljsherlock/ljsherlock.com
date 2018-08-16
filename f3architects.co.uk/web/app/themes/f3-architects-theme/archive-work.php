<?php
$args = array('query' => array('posts_per_page' => 17 ));

$archive = new Controllers\Archive($args);
$archive->template = 'archive--work';
$archive->show();

// $typeTerms => $this->get_hierachical_terms('type' , null, array('hide_empty' => false));
//
// array_walk($typeTerms, function($term, $key) {
//     if($term->slug === 'commercial') {
//
//     }
// });
