<?php

/**
 * @package CustomPlugin
 */

namespace Inc;

use Inc\Base\BaseController;

final class Init
{
    /**
     * Store all the classes inside an array
     * @return string[]
     */
    public static function get_services()
    {
        return [
            Pages\Dashboard::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Base\CustomPostTypeController::class,
            Base\CustomTaxonomyController::class,
            Base\GalleryController::class,
            Base\TestimonialController::class,
            Base\TemplateController::class,
            Base\WidgetController::class,
            Base\MembershipController::class,
            Base\AuthController::class,
            Base\ChatController::class
        ];
    }

    /**
     * Loop through the classes, initialize them, and call the register() method.
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);

            if ( method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     * @param $class
     * @return mixed
     */
    private static function instantiate($class)
    {
        return new $class();
    }
}


// LEGACY STRUCTURE

//use Inc\Activate;
//use Inc\Deactivate;
//use Inc\Admin\Admin;
//
////require_once plugin_dir_path(__FILE__) . 'inc/Admin/AdminPages.php';
//
//class CustomPlugin
//{
//    public $plugin;
//
//    public function __construct()
//    {
//        $this->create_post_type();
//        $this->plugin = plugin_basename(__FILE__);
//    }
//
//    protected function create_post_type() {
//        add_action('init', array($this, 'custom_post_type'));
//    }
//
//    function register() {
//        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
//
//        add_action('admin_menu', array($this, 'add_admin_pages'));
//
//        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
//    }
//
//    public function settings_link($links) {
//        $settings_link = '<a href="admin.php?page=custom_plugin">Settings</a>';
//
//        array_push($links, $settings_link);
//
//        return $links;
//    }
//
//    public function add_admin_pages() {
//        add_menu_page('Custom Plugin', 'Custom', 'manage_options',
//            'custom_plugin', array($this, 'admin_index'), 'dashicons-store', 110);
//    }
//
//    public function admin_index() {
//        require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
//    }
//
//    function activate() {
////        require_once plugin_dir_path(__FILE__) . 'inc/custom-plugin-activate.php';
//        Activate::activate();
//    }
//
//    function deactivate() {
////        require_once plugin_dir_path(__FILE__) . 'inc/custom-plugin-deactivate.php';
//        Deactivate::deactivate();
//    }
//
//    function uninstall() {
//
//    }
//
//    function custom_post_type() {
//        register_post_type('book', ['public' => true, 'label' => 'Books']);
//    }
//
//    function enqueue() {
//        wp_enqueue_style('custompluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
//        wp_enqueue_script('custompluginjs', plugins_url('/assets/myscript.js', __FILE__));
//    }
//}
//
//if (class_exists('CustomPlugin')) {
//    $customPlugin = new CustomPlugin();
//    $customPlugin->register();
//}
//
//
//
//// activation
//register_activation_hook(__FILE__, array($customPlugin, 'activate'));
//
//// deactivation
//register_deactivation_hook(__FILE__, array($customPlugin, 'deactivate'));
//
//// uninstall
////register_uninstall_hook(__FILE__, array($customPlugin, 'uninstall'));