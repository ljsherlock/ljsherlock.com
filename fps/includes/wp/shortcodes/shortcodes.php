<?php

$includes_files = array_values( preg_grep( '/^((?!all.php).)*$/', glob(dirname(__FILE__)."/*.php") ) );

foreach ($includes_files as $inc_file) {
    require_once $inc_file;
}

Class RW_shortcodes {
    public static function initialize_shortcodes() {
        add_shortcode('button', 'button_shortcode');
        add_shortcode('the_video', 'video_shortcode');
    }
}
