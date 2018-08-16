<?php

$single = new Controllers\Single__Work();
$single->model->additionalPostData();
$single->model->addRelatedPosts();
$single->show();
