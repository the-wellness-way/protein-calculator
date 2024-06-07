<?php
namespace TwwcProtein\Options;

/**
 * Main wrapper class for WordPress option functions
 *
 * [AllowDynamicProperties]
 */
class TwwcOptions {
    const PREFIX = 'twwc__';

    /**
     * Wrapper for WP's get_option
     *
     * @see https://developer.wordpress.org/reference/functions/get_option/
     * @return string
     */
    public static function get_option($option_name, $default = '', $prefix = true) {
        if($prefix) {
            $option_name = self::ensure_prefixed($option_name);
        }

        return get_option($option_name, $default);
    }

    /**
     * Wrapper for WP's update_option function
     *
     * @see https://developer.wordpress.org/reference/functions/update_option/
     * @param $option_name
     * @param $value
     * @param $autoload
     * @param $prefix
     * @return bool|void
     */
    public static function update_option($option_name, $value = '', $autoload = null, $prefix = true) {
        if(empty($option_name)) {
            return false;
        }

        if($prefix) {
            $option_name = self::ensure_prefixed($option_name);
        }

        return update_option($option_name, $value, $autoload);
    }

    /**
     * Ensure the option name is prefixed with the defined PREFIX.
     *
     * @param string $option_name
     * @return string
     */
    private static function ensure_prefixed(string $option_name): string {
        return str_starts_with($option_name, self::PREFIX) ? $option_name : self::PREFIX . $option_name;
    }
}
