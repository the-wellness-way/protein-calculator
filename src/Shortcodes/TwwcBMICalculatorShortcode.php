<?php
namespace TwwcProtein\Shortcodes;

use TwwcProtein\Options\TwwcOptions;

class TwwcBMICalculatorShortcode extends TwwcShortcodes {
    public function set_sc_settings() {
        $this->sc_settings = [
            'name' => 'twwc_bmi_calculator',
            'handle' => 'twwc-bmi-calculator-shortcode',
            'css_handle' => 'twwc-bmi-calculator-shortcode',
        ];
    }

    public function render_shortcode($atts, $content = null) {
        $theme = 'compact';

        if($this->sc_settings['handle']) {
            wp_enqueue_script($this->sc_settings['handle']);

            $settings = TwwcOptions::get_option('settings', null);
            $protein_settings = TwwcOptions::get_option('protein_settings', null); 

            if($settings && is_array($settings) && count($settings)) {
                $theme = $settings['theme_options']['default'] ?? 'compact';
                $settings = [
                    'theme_options' => $settings['theme_options'],
                    'protein_settings' => $protein_settings
                ];
        
                wp_localize_script($this->sc_settings['handle'], 'twwc_object' , $settings );
            }

            require TWWC_PROTEIN_PLUGIN_PATH . 'templates/bmi-calculator-compact.php';
        }    
    }
}