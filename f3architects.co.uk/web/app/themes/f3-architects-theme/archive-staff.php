<?php

$args = array('slug' => 'people-content');
$page = new Controllers\Single($args);

$people = new Controllers\People();
$people->model->post = $page->returnData()['post'];
$people->template = 'pages/people';
$people->show();
