<?php
/**
 * Plugin Name: TWW Protein Calculator
 * Author: The Wellness Way
 * Description: A plugin to calculate protein intake.
 * Version: 1.0.21
 * Tested up to: 6.6
 * Requires at least: 5.0
 * Requires PHP: 5.6.20
 * Author: Bluefield Identity Inc.
 * Author URI: https://www.thewellnessway.com/
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: twwc-protein
 * Domain Path: /languages/
 */
if(!defined('ABSPATH')) {
    exit;
}

if(!defined('TWWC_ASSETS_VERSION')) {
    define('TWWC_ASSETS_VERSION', '1.0.31');
}

if(!defined('TWWC_PROTEIN_PLUGIN_PATH')) {
    define('TWWC_PROTEIN_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

if(!defined('TWWC_PROTEIN_PLUGIN_URL')) {
    define('TWWC_PROTEIN_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if(!defined('TWWC_PROTEIN_ASSETS_VERSION')) {
    define('TWWC_PROTEIN_ASSETS_VERSION', '1.0.0');
}

require_once 'vendor/autoload.php';

use TwwcProtein\Options\TwwcOptions;

 class TwwcProtein {
    public function activate() {
        $plugin_settings = TwwcOptions::get_option('settings', null);
        $plugin_protein_settings = TwwcOptions::get_option('protein_settings', null);
        $food_items = new \WP_Query(
            [
                'post_type' => 'twwc_food_items',
                'post_status' => 'publish',
            ]
        );

        $twwc_install_settings = [
            'settings' => $plugin_settings ? true : false,
            'protein_settings' => $plugin_protein_settings ? true : false,
            'food_items' => $food_items->have_posts() ? true : false,
        ];

        foreach($twwc_install_settings as $wp_option => $value) {
            if($value) {
                continue;
            }

            //e.g. convert protein_settings to TwwcInstallProtein_SettingsSchema
            $install_handler_classname = 'TwwcProtein\Setup\TwwcInstall' . str_replace(' ', '_', ucwords(str_replace('_', ' ', strtolower($wp_option)))) . 'Schema';
            
            if(class_exists($install_handler_classname)) {
                $installed = $install_handler_classname::install();
            }

            if($installed) {
                $twwc_install_settings[$wp_option] = true;
                TwwcOptions::update_option('install_settings', $twwc_install_settings);
            }  
        }
    }
 }

 $twwcProtein = new TwwcProtein();
 register_activation_hook(__FILE__, [$twwcProtein, 'activate']);
 
 use TwwcProtein\Shortcodes\TwwcProteinCalculatorShortcode;
 use TwwcProtein\Shortcodes\TwwcFoodItemsCalculatorShortcode;
 use TwwcProtein\Shortcodes\TwwcBMICalculatorShortcode;

 use TwwcProtein\Admin\TwwcAdminMenu;
 use TwwcProtein\Admin\TwwcAdminFoodItems;

 add_action('init', function() {      
        $twwcOptions = new TwwcOptions();
        $twwProteinCalculatorShortcode = new TwwcProteinCalculatorShortcode();
        $twwcFoodItemsCalculatorShortcode = new TwwcFoodItemsCalculatorShortcode();
        $twwcFoodItemsCalculatorShortcode = new TwwcBMICalculatorShortcode();

        $twwAdminMenu = new TwwcAdminMenu();
        $twwAdminMenu->register_hooks();
        $twwAdminFoodItems = new TwwcAdminFoodItems();
        $twwAdminFoodItems->register_hooks();

        add_action('wp_enqueue_scripts', 'twwc_register_styles');
       // add_action('wp_enqueue_scripts', 'twwc_register_scripts');

        function twwc_register_styles() {
            if(strpos(site_url(), 'localhost') !== false) {
                $version = null;
            } else {
                $version = '1.0.78';
            }

            wp_register_style('twwc-protein', TWWC_PROTEIN_PLUGIN_URL . 'resources/css/twwc-protein.css', [], $version, 'all');
            wp_enqueue_style('twwc-protein');
        }
 });
