<?php
/**
 * Plugin Name: TWW Protein Calculator
 * Author: The Wellness Way
 * Description: A plugin to calculate protein intake.
 * Version: 1.0.0
 */
if(!defined('ABSPATH')) {
    exit;
}

if(!defined('TWWC_ASSETS_VERSION')) {
    define('TWWC_ASSETS_VERSION', '1.0.2');
}

if(!defined('TWWC_PROTEIN_PLUGIN_PATH')) {
    define('TWWC_PROTEIN_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

iF(!defined('TWWC_PROTEIN_PLUGIN_URL')) {
    define('TWWC_PROTEIN_PLUGIN_URL', plugin_dir_url(__FILE__));
}

require_once 'vendor/autoload.php';

 class TwwcProtein {}
 
 use TwwcProtein\Shortcodes\TwwcProteinCalculatorShortcode;

 use TwwcProtein\Admin\TwwcAdminMenu;
 use TwwcProtein\Options\TwwcOptions;

 add_action('init', function() {      
        $twwcOptions = new TwwcOptions();
        $twwcroteinCalculatorShortcode = new TwwcProteinCalculatorShortcode();
        $twwcrotein = new TwwcProtein();
        $twwAdminMenu = new TwwcAdminMenu();
        $twwAdminMenu->register_hooks();

        add_action('wp_enqueue_scripts', 'twwc_register_styles');
       // add_action('wp_enqueue_scripts', 'twwc_register_scripts');

        function twwc_register_styles() {
            if(strpos(site_url(), 'localhost') !== false) {
                $version = null;
            } else {
                $version = '1.0.77';
            }

            wp_register_style('tww-protein', TWWC_PROTEIN_PLUGIN_URL . 'resources/css/tww-protein.css', [], $version, 'all');
            wp_enqueue_style('tww-protein');
        }
 });

 