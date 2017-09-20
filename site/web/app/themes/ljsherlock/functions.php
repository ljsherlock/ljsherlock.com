<?php

$loader = require __DIR__ . '/vendor/autoload.php';

die(var_dump($loader));

Includes\Core::init();

Includes\App::init();
