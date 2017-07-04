<?php

if (!is_user_logged_in())
{
    wp_redirect("/user-login");
    exit();
}

$c = Timber::get_context();

Timber::render( array('project_fps/_pages/single-document.twig'), $c );
