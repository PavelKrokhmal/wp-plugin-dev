<?php

/**
 * @package CustomPlugin
 */

namespace Inc\Pages;

use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;
use Inc\Base\BaseController;
use Inc\Api\SettingsApi;

class Dashboard extends BaseController
{
    public $settings;

    public $callbacks;
    public $callbacks_mngr;

    public $pages = array();

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();

        $this->setPages();

//        $this->setSubpages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
    }

    public function setPages()
    {
        $this->pages = array(
            array(
                'page_title' => 'Custom Plugin',
                'menu_title' => 'Custom',
                'capability' => 'manage_options',
                'menu_slug' => 'custom_plugin',
                'callback' => array( $this->callbacks, 'adminDashboard' ),
                'icon_url' => 'dashicons-store',
                'position' => 110
            )
        );
    }

    public function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'custom_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'custom_cpt',
                'callback' => array( $this->callbacks, 'adminCpt' )
            ),
            array(
                'parent_slug' => 'custom_plugin',
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomies',
                'capability' => 'manage_options',
                'menu_slug' => 'custom_taxonomies',
                'callback' => array( $this->callbacks, 'adminTaxonomy' )
            ),
            array(
                'parent_slug' => 'custom_plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Widgets',
                'capability' => 'manage_options',
                'menu_slug' => 'custom_widgets',
                'callback' => array( $this->callbacks, 'adminWidget' )
            )
        );
    }

    public function setSettings()
    {
        $args = array(
            array(
                'option_group' => 'custom_plugin_settings',
                'option_name' => 'custom_plugin',
                'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
            )
        );

        $this->settings->setSettings( $args );
    }

    public function setSections()
    {
        $args = array(
            array(
                'id' => 'custom_admin_index',
                'title' => 'Settings',
                'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
                'page' => 'custom_plugin'
            )
        );

        $this->settings->setSections( $args );
    }

    public function setFields()
    {
        $args = array();

        foreach ( $this->managers as $key => $value ) {
            $args[] = array(
                'id' => $key,
                'title' => $value,
                'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
                'page' => 'custom_plugin',
                'section' => 'custom_admin_index',
                'args' => array(
                    'option_name' => 'custom_plugin',
                    'label_for' => $key,
                    'class' => 'ui-toggle'
                )
            );
        }

        $this->settings->setFields( $args );
    }
}