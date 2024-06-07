<?php
namespace TwwcProtein\Shortcodes;

use TwwcProtein\Options\TwwcOptions;
/**
 * Shortcode for the protein calculator form
 */
class TwwcProteinCalculatorShortcode {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
        add_shortcode('twwc_protein_calculator', [$this, 'render_shortcode']);
    }

    public function render_shortcode($atts, $content = null) {
        ob_start();
        $settings = TwwcOptions::get_option('settings', null);
        $protein_settings = TwwcOptions::get_option('protein_settings', null);

        $theme = $settings['theme_options']['default'] ?? 'compact';

        $settings = [
            'theme_options' => $settings['theme_options'],
            'protein_settings' => $protein_settings
        ];

        $version = '1.0.1';
        
        wp_enqueue_script('twwc-protein-object');

        if($settings && is_array($settings) && count($settings)) {
            wp_localize_script('twwc-protein-object', 'twwc_object' , $settings );
        }

        wp_enqueue_script('tww-protein-main');
        wp_enqueue_script('tww-theme-compact-js');

        if($protein_settings && is_array($protein_settings) && count($protein_settings)) {
            if('compact' === $theme) {
                require_once TWWC_PROTEIN_PLUGIN_PATH . 'templates/protein-calculator-compact.php';
            } elseif('large' === $theme) {
                require_once TWWC_PROTEIN_PLUGIN_PATH . 'templates/protein-calculator-large.php';
            }
        } else {
            echo 'Calculator settings are empty. Please check the settings page.';
        }
        
        return ob_get_clean();
    }

    public function register_scripts() {
            $version = '1.0.78';

            wp_register_script('twwc-protein-object', TWWC_PROTEIN_PLUGIN_URL . 'resources/js/vars.js',  [], $version, true);
            wp_register_script('tww-protein-main', TWWC_PROTEIN_PLUGIN_URL . 'resources/js/main.js', [], $version, true);
            wp_register_script('tww-theme-compact-js', TWWC_PROTEIN_PLUGIN_URL . 'resources/js/theme-compact.js', [], $version, true);
    }
}