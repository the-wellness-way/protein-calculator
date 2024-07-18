<?php
/**
 * Plugin Name: TWW Protein Calculator
 * Author: The Wellness Way
 * Description: A plugin to calculate protein intake.
 * Version: 1.0.0
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
    define('TWWC_ASSETS_VERSION', '1.0.3');
}

if(!defined('TWWC_PROTEIN_PLUGIN_PATH')) {
    define('TWWC_PROTEIN_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

iF(!defined('TWWC_PROTEIN_PLUGIN_URL')) {
    define('TWWC_PROTEIN_PLUGIN_URL', plugin_dir_url(__FILE__));
}

require_once 'vendor/autoload.php';

use TwwcProtein\Options\TwwcOptions;
use TwwcProtein\Setup\TwwcInstallSchema;

 class TwwcProtein {
    public function activate() {
        $installed_settings = TwwcOptions::get_option('settings');
        if(!$installed_settings) {
            $install_settings = TwwcInstallSchema::install_settings();
        }

        $installed_protein_settings = TwwcOptions::get_option('protein_settings');
        if(!$installed_protein_settings) {
            $install_protein_settings = TwwcInstallSchema::install_protein_settings();
        }
    }
 }

 $twwcProtein = new TwwcProtein();
 register_activation_hook(__FILE__, [$twwcProtein, 'activate']);
 register_deactivation_hook(__FILE__, [$twwcProtein, 'deactivate']);
 
 use TwwcProtein\Shortcodes\TwwcProteinCalculatorShortcode;

 use TwwcProtein\Admin\TwwcAdminMenu;

 add_action('init', function() {      
        $twwcOptions = new TwwcOptions();
        $twwcroteinCalculatorShortcode = new TwwcProteinCalculatorShortcode();
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

            wp_register_style('twwc-protein', TWWC_PROTEIN_PLUGIN_URL . 'resources/css/twwc-protein.css', [], $version, 'all');
            wp_enqueue_style('twwc-protein');
        }
 });

 