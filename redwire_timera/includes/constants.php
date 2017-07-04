<?php

define('DEVELOPING', true);

// Wordpress Unique text domain
define('LJS_TEXT_DOMAIN', 'ljsherlock');

define('PROJECT_VERSION', '0.0.0');

// CUTTING THE MUSTARD
if( isset( $_COOKIE['cuts-the-mustard'] ) )
{
    define('_MUSTARD', $_COOKIE['cuts-the-mustard']);
} else {
    define('_MUSTARD', false);
}

// Base locations
define('LJS_ROOT', dirname(__FILE__));
define('LJS_URL', get_stylesheet_directory_uri());

// Server side
define('LJS_INC', LJS_ROOT . '/includes');

//Client Side
define('LJS_ASSETS_DIR', LJS_ROOT . '/View/Assets');
define('LJS_ASSETS', LJS_URL . '/View/Assets');

define('LJS_CSS_DIR', LJS_ASSETS_DIR . '/CSS');
define('LJS_CSS', LJS_ASSETS . '/CSS');
define('LJS_JS_DIR', LJS_ASSETS_DIR . '/Scripts');
define('LJS_JS', LJS_ASSETS . '/Scripts');
define('LJS_MEDIA_DIR', LJS_ASSETS_DIR . '/media');
define('LJS_MEDIA', LJS_ASSETS . '/media');

define('LJS_SVG_DIR', LJS_MEDIA_DIR . '/Assets/svg');
define('LJS_SVG', LJS_MEDIA . '/Assets/svg');
define('LJS_ICONS_DIR', LJS_MEDIA_DIR . '/Assets/icons');
define('LJS_ICONS', LJS_MEDIA . '/Assets/icons');

define('LJS_FAV', LJS_ICONS . '/favicon');

define('LJS_AJAXURL', admin_url('admin-ajax.php'));

if (!defined('LJS_ASSET_LOADING_ENABLE_CACHE_BUSTING')) {
    define('LJS_ASSET_LOADING_ENABLE_CACHE_BUSTING', false);
}

if ( ! is_admin() ) {
    define('LJS_CACHE', 600);
}
