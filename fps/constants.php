<?php

define('DEVELOPING', true);

define('PROJECT_VERSION', '0.0.0');

// CUTTING THE MUSTARD
if( isset( $_COOKIE['FPS_cuts-the-mustard'] ) )
{
    define('_MUSTARD', $_COOKIE['FPS_cuts-the-mustard']);
} else {
    define('_MUSTARD', false);
}

// Base locations
define('RW_ROOT', dirname(__FILE__));
define('RW_URL', get_stylesheet_directory_uri());
define('RW_TEXT_DOMAIN', 'fps');

// Server side
define('RW_INC', RW_ROOT . '/includes');
define('RW_LIB',  RW_INC .'/lib');
define('RW_PATTERNS_DIR', RW_ROOT . '/_patterns');

//Client Side
define('RW_ASSETS_DIR', RW_ROOT . '/assets');
define('RW_ASSETS', RW_URL . '/assets');

define('RW_CSS_DIR', RW_ASSETS_DIR . '/css');
define('RW_CSS', RW_ASSETS . '/css');
define('RW_JS_DIR', RW_ASSETS_DIR . '/js');
define('RW_JS', RW_ASSETS . '/js');

define('RW_MEDIA_DIR', RW_ASSETS_DIR . '/media');
define('RW_MEDIA', RW_ASSETS . '/media');

define('RW_SVG_DIR', RW_MEDIA_DIR . '/svg');
define('RW_SVG', RW_MEDIA . '/svg');

define('RW_ICONS_DIR', RW_MEDIA_DIR . '/icons');
define('RW_ICONS', RW_MEDIA . '/icons');

define('RW_FAV', RW_ICONS . '/favicon');

define('RW_AJAXURL', admin_url('admin-ajax.php'));
//define('RW_TEXT_DOMAIN', 'Homesick-project_name');

if (!defined('RW_ASSET_LOADING_ENABLE_CACHE_BUSTING')) {
    define('RW_ASSET_LOADING_ENABLE_CACHE_BUSTING', false);
}

if ( ! is_admin() ) {
    define('RW_CACHE', 600);
}

/**
 *  Used in \Homesick\maybeGetMinified()
 *  Whether or not to use a minified version of
 *  an asset when available
 */
if (!defined('RW_ASSET_MINIFIED')) {
    define('RW_ASSET_MINIFIED', true);
}
