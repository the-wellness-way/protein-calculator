<?php
namespace TwwcProtein\Shortcodes;

class TwwcFoodItemsCalculatorShortcode extends TwwcShortcodes {
    public function set_sc_settings() {
        $this->sc_settings = [
            'name' => 'twwc_food_items',
            'handle' => 'twwc-food-items-shortcode',
            'css_handle' => 'twwc-food-items-shortcode',
        ];
    }

    public function render_shortcode($atts, $content = null) {
        static $shortcode_counter = 0;
        $shortcode_counter++;

        if($this->sc_settings['css_handle']) {
            wp_enqueue_style($this->sc_settings['css_handle']);
        }

        if($this->sc_settings['handle']) {
            wp_enqueue_script($this->sc_settings['handle']);
        }

        $atts = shortcode_atts([
            'justify' => 'flex-start',
            'post_id' => get_the_ID(),
            'redirect_url' => home_url(),
        ], $atts);
        
        ob_start();
        include TWWC_PROTEIN_PLUGIN_PATH . 'templates/food-items.php';
        return ob_get_clean();
    }
}