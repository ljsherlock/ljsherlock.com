<?php

/**
*   Template Name: Archives
*/

$archive = new MVC\Controllers\Archive(array('post_type' => get_query_var('name')));
$archive->show();
