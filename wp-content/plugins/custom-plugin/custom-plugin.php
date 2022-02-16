<?php

/**
 * @package CustomPlugin
 */

/*
 Plugin Name: Custom Plugin
 Plugin URI:
 Description: My custom plugin
 Version: 1.0.0
 Author: Pavel Krokhmal
 Author URI:
 Licence: GPLv2
 Text Domain: custom-plugin
 */

// SECURITY

//if ( !defined('ABSPATH')) {
//    die();
//}

//
//if(!function_exists('add_action')) {
//    echo 'You can\`t access this file!';
//    exit;
//}

use Inc\Base\Activate;
use Inc\Base\Deactivate;

defined('ABSPATH') or die('You can\`t access this file!');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

//define('PLUGIN', plugin_basename(__FILE__));
//define('PLUGIN_PATH', plugin_dir_path(__FILE__));
//define('PLUGIN_URL', plugin_dir_url(__FILE__));

function activate_custom_plugin() {
    Activate::activate();
}

// Activation
register_activation_hook(__FILE__, 'activate_custom_plugin');

function deactivate_custom_plugin() {
    Deactivate::deactivate();
}

// Deactivation
register_deactivation_hook(__FILE__, 'deactivate_custom_plugin');


if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}
