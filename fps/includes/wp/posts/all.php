<?php

$includes_files = array_values( preg_grep( '/^((?!all.php).)*$/', glob(dirname(__FILE__)."/*.php") ) );

foreach ($includes_files as $inc_file) {
    require_once $inc_file;
}
