<?php

require 'vendor/autoload.php';

Includes\Core::init();

Includes\App::init();

die(var_dump('Hey this deployed'));
