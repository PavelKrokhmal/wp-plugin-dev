<?php

/**
 * @package CustomPlugin
 */

namespace Inc\Base;

class Deactivate
{
    public static function deactivate() {
        flush_rewrite_rules();

        delete_option('custom_plugin');
        delete_option('custom_plugin_cpt');
        delete_option('custom_plugin_tax');
    }
}