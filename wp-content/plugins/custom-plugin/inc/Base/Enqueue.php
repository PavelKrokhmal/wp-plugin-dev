<?php


/**
 * @package CustomPlugin
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function enqueue() {
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();

        wp_enqueue_style('custompluginstyle', $this->plugin_url . 'assets/mystyle.min.css');
        wp_enqueue_script('custompluginjs', $this->plugin_url . 'assets/myscript.min.js');

        add_filter("script_loader_tag", array($this, "add_type_module_js_script"), 10, 3);
    }

    function add_type_module_js_script($tag, $handle, $src)
    {
        if ("custompluginjs" === $handle) {
            $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        }

        return $tag;
    }
}