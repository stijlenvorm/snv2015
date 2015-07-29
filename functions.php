<?php

// Security check
if (!defined('ABSPATH')) {
    exit;
}

// include some libraries (DONT REMOVE)
include get_template_directory() . '/includes/cuztom/cuztom.php';
include get_template_directory() . '/includes/snv/autoload.php';

// do you want to load most scripts in footer (probably yes)
define('SCRIPTS_IN_FOOTER', true);

// if you need to change or add a google API key somewhere use this constant (also available in javascript)
define('MAPS_API_KEY', get_option('googleAPIkey'));

if(!defined('SOCIAL_MEDIA_OPTIONS')) {
    define('SOCIAL_MEDIA_OPTIONS', implode(',', array('facebook','twitter','linkedIn','pinterest','googleplus','youtube','vimeo', 'instagram','tumblr','flickr')));
}


if(!function_exists('snvEnqueueScriptStyles')) {
    // enqueue scripts and styles here, not in Footer or Header see:
    // https://codex.wordpress.org/Function_Reference/wp_enqueue_style
    // https://codex.wordpress.org/Function_Reference/wp_enqueue_script
    function snvEnqueueScriptStyles()
    {
        wp_enqueue_style('theme', get_template_directory_uri() . '/css/style.css', array(), '1.0', 'all');
    }
    add_action('wp_enqueue_scripts', 'snvEnqueueScriptStyles', 40);
}

if(!function_exists('registerMyMenus')) {
    // register menu's here...
    function registerMyMenus()
    {
        register_nav_menus(
            array(
                'header-menu' => __('Header Menu'),
                'footer-menu' => __('Footer Menu'),
                'footer-menu-2' => __('Footer Menu 2'),
            )
        );
    }
    add_action('init', 'registerMyMenus');
}