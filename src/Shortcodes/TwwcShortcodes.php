<?php
namespace TwwcProtein\Shortcodes;

use MatthiasMullie\Minify\CSS;

abstract class TwwcShortcodes {
    const JS_RESOURCE_BASE = 'resources/js/shortcodes';
    const CSS_RESOURCE_BASE = 'resources/css/shortcodes';

    protected $sc_settings = [
        'name' => null,
        'handle' => null,
        'capability' => null,
        'permission_callback' => null,
    ];

    public function __construct() {
        $this->set_sc_settings();
        $this->boot();
    }

    abstract protected function set_sc_settings();

    abstract public function render_shortcode($atts, $content = null);

    public function boot() {
        $sc_name = $this->sc_settings['name'] ?? null;
        $sc_script_handle = $this->sc_settings['handle'] ?? null;
        $sc_style_handle = $this->sc_settings['css_handle'] ?? null;

        if ($sc_name) {
            add_shortcode($sc_name, [$this, 'render_shortcode']);

            if (null !== $sc_script_handle) {
                $this->register_script($sc_script_handle);
            }

            if (null !== $sc_style_handle) {
                $this->register_style($sc_style_handle);
            }
        }
    }

    public function register_script() {
        $handle = $this->sc_settings['handle'] ?? null;

        if(null !== $handle) {
            try {
                $resource = $this->get_js_resource($handle);
            } catch (\Exception $exception) {
                throw $exception;
            }

            wp_register_script(
                $handle,
                $resource,
                ['jquery'],
                TWWC_PROTEIN_ASSETS_VERSION,
                true
            );
        }
    }

    public function register_style() {
        $handle = $this->sc_settings['css_handle'] ?? null;

        if(null !== $handle) {
            try {
                $resource = $this->get_css_resource($handle);
            } catch (\Exception $exception) {
                throw $exception;
            }

            wp_register_style(
                $handle,
                $resource,
                [],
                TWWC_PROTEIN_ASSETS_VERSION,
                'all'
            );
        }
    }

    public function validate_user(\WP_User $user, $default = true) {
        $callback = $this->sc_settings['permission_callback'] ?? null;
        $capability = $this->sc_settings['capability'] ?? null;

        if ($callback && is_callable([$this, $callback])) {
            return call_user_func([$this, $callback], $user);
        } elseif($capability) {
            return current_user_can($capability);
        }

        return $default;
    }

    public function is_user_logged_in() {
        return is_user_logged_in();
    }

    /**
     * Javascript Resources
     * 
     * 
     * 
     */

    public function get_js_resource(string $handle = null) {
        if(null === $handle) {
            throw new \Exception('Missing resource handle.');
        }

        $resource_file_path = $this->get_js_resource_path() . $handle . '.js';
        $resource_file = trailingslashit(TWWC_PROTEIN_PLUGIN_PATH) . $resource_file_path;

        if(!file_exists($resource_file)) {
            throw new \Exception('Resource file ' . $resource_file . ' does not exist.');
        }

        $resource = trailingslashit(TWWC_PROTEIN_PLUGIN_URL) . $resource_file_path;

        return $resource;
    }

    public function get_js_resource_path(string $path = null) {
        if(null !== $path && !is_string($path)) {
            throw \Exception('Path must be a valid string');
        }

        return $path ?? trailingslashit(self::JS_RESOURCE_BASE);
    }

    /**
     * CSS Resources
     * 
     * 
     * 
     */
    public function get_css_resource(string $handle = null) {
        if(null === $handle) {
            throw new \Exception('Missing resource handle.');
        }

        $resource_file_path = $this->get_css_resource_path() . $handle . '.css';
        $resource_file = trailingslashit(TWWC_PROTEIN_PLUGIN_PATH) . $resource_file_path;

        if(!file_exists($resource_file)) {
            throw new \Exception('Resource file ' . $resource_file . ' does not exist.');
        }

        $resource = trailingslashit(TWWC_PROTEIN_PLUGIN_URL) . $resource_file_path;

        return $resource;
    }

    public function get_css_resource_path(string $path = null) {
        if(null !== $path && !is_string($path)) {
            throw \Exception('Path must be a valid string');
        }

        return $path ?? trailingslashit(self::CSS_RESOURCE_BASE);
    }
}