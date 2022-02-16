<?php

/**
 * @package CustomPlugin
 */

namespace Inc\Base;

class Activate
{
    public static function activate() {
        flush_rewrite_rules();

        if ( ! get_option( 'custom_plugin' ) ) {
            update_option( 'custom_plugin', array() );
        }

        if ( ! get_option( 'custom_plugin_cpt' ) ) {
            update_option( 'custom_plugin_cpt',  array() );
        }

        if ( ! get_option( 'custom_plugin_tax' ) ) {
            update_option( 'custom_plugin_tax', array() );
        }

    }
}