<?php

$single = new Controllers\Single();
$single->model->additionalPostData();
$single->model->addRelatedPosts();
// die(var_dump($single->model->post->categories));
$single->show();
