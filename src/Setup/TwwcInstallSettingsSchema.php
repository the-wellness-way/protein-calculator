<?php
namespace TwwcProtein\Setup;

use TwwcProtein\Options\TwwcOptions;

class TwwcInstallSettingsSchema {
    public static function install() {
        $settings = [
            "theme_options" => [
                "default" => "compact",
                "plugin_colors" => [
                    "primary" => "#E6F1D9",
                    "fields_color" => "#80b741"
                ]
            ]
        ];

        return TwwcOptions::update_option('twwc__settings', $settings);
    }
}
