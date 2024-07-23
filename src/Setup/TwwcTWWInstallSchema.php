<?php
namespace TwwcProtein\Setup;

use TwwcProtein\Options\TwwcOptions;

class TwwcTWWInstallSchema {
    public static function install() {
        self::install_settings();
        self::install_protein_settings();
    }

    public static function install_settings() {
        $settings = [
            "theme_options" => [
                "default" => "compact",
                "plugin_colors" => [
                    "primary" => "#E6F1D9"
                ]
            ]
        ];

        return TwwcOptions::update_option('twwc__settings', $settings);
    }

    public static function install_protein_settings() {
        $protein_settings = [
            "system" => "imperial",
            "pregnant" => "10",
            "pregnant_lactating" => "15",
            "defaults" => [
                "activity_level" => "lightly_active",
            ],
            "content" => [],
            "multiplier_weight_lbs" => "0.68",
            "multiplier_weight_kg" => 1.5,
            "multiplier_weight_high_lbs" => "0.82",
            "multiplier_weight_high_kg" => 1.81,
            "activity_level" => [
                "sedentary" => [
                    "label" => "",
                    "enable" => "",
                    "m_sedentary_lbs" => "",
                    "m_sedentary_kg" => "",
                    "m_sedentary_high_lbs" => "",
                    "m_sedentary_high_kg" => "",
                    "goal" => [
                        "m_maintain_lbs" => "",
                        "m_maintain_kg" => "",
                        "m_toning_lbs" => "",
                        "m_toning_kg" => "",
                        "m_muscle_growth_lbs" => "",
                        "m_muscle_growth_kg" => "",
                        "m_weight_loss_lbs" => "",
                        "m_weight_loss_kg" => "",
                        "m_maintain_high_lbs" => "",
                        "m_maintain_high_kg" => "",
                        "m_toning_high_lbs" => "",
                        "m_toning_high_kg" => "",
                        "m_muscle_growth_high_lbs" => "",
                        "m_muscle_growth_high_kg" => "",
                        "m_weight_loss_high_lbs" => "",
                        "m_weight_loss_high_kg" => "",
                    ],
                ],
                "lightly_active" => [
                    "label" => "Low (Average Person)",
                    "enable" => "1",
                    "m_lightly_active_lbs" => "",
                    "m_lightly_active_kg" => "",
                    "m_lightly_active_high_lbs" => "",
                    "m_lightly_active_high_kg" => "",
                    "goal" => [
                        "m_maintain_lbs" => "0.68",
                        "m_maintain_kg" => 1.5,
                        "m_toning_lbs" => "0.73",
                        "m_toning_kg" => 1.61,
                        "m_muscle_growth_lbs" => "0.77",
                        "m_muscle_growth_kg" => 1.7,
                        "m_weight_loss_lbs" => "0.73",
                        "m_weight_loss_kg" => 1.61,
                        "m_maintain_high_lbs" => "0.95",
                        "m_maintain_high_kg" => 2.09,
                        "m_toning_high_lbs" => "1.09",
                        "m_toning_high_kg" => 2.4,
                        "m_muscle_growth_high_lbs" => "1.13",
                        "m_muscle_growth_high_kg" => 2.49,
                        "m_weight_loss_high_lbs" => "0.91",
                        "m_weight_loss_high_kg" => 2.01,
                    ],
                ],
                "moderately_active" => [
                    "label" => "Medium (Exercise Often)",
                    "enable" => "1",
                    "m_moderately_active_lbs" => "",
                    "m_moderately_active_kg" => "",
                    "m_moderately_active_high_lbs" => "",
                    "m_moderately_active_high_kg" => "",
                    "goal" => [
                        "m_maintain_lbs" => "0.82",
                        "m_maintain_kg" => 1.81,
                        "m_toning_lbs" => "0.91",
                        "m_toning_kg" => 2.01,
                        "m_muscle_growth_lbs" => "0.95",
                        "m_muscle_growth_kg" => 2.09,
                        "m_weight_loss_lbs" => "0.77",
                        "m_weight_loss_kg" => 1.7,
                        "m_maintain_high_lbs" => "1.09",
                        "m_maintain_high_kg" => 2.4,
                        "m_toning_high_lbs" => "1.27",
                        "m_toning_high_kg" => 2.8,
                        "m_muscle_growth_high_lbs" => "1.32",
                        "m_muscle_growth_high_kg" => 2.91,
                        "m_weight_loss_high_lbs" => "0.95",
                        "m_weight_loss_high_kg" => 2.09,
                    ],
                ],
                "very_active" => [
                    "label" => "High (Athlete)",
                    "enable" => "1",
                    "m_very_active_lbs" => "",
                    "m_very_active_kg" => "",
                    "m_very_active_high_lbs" => "",
                    "m_very_active_high_kg" => "",
                    "goal" => [
                        "m_maintain_lbs" => "0.95",
                        "m_maintain_kg" => 2.09,
                        "m_toning_lbs" => "1.09",
                        "m_toning_kg" => 2.4,
                        "m_muscle_growth_lbs" => "1.13",
                        "m_muscle_growth_kg" => 2.49,
                        "m_weight_loss_lbs" => "0.82",
                        "m_weight_loss_kg" => 1.81,
                        "m_maintain_high_lbs" => "1.22",
                        "m_maintain_high_kg" => 2.69,
                        "m_toning_high_lbs" => "1.45",
                        "m_toning_high_kg" => 3.2,
                        "m_muscle_growth_high_lbs" => "1.5",
                        "m_muscle_growth_high_kg" => 3.31,
                        "m_weight_loss_high_lbs" => "0.95",
                        "m_weight_loss_high_kg" => 2.09,
                    ],
                ],
                "super_active" => [
                    "label" => "",
                    "enable" => "",
                    "m_super_active_lbs" => "",
                    "m_super_active_kg" => "",
                    "m_super_active_high_lbs" => "",
                    "m_super_active_high_kg" => "",
                    "goal" => [
                        "m_maintain_lbs" => "",
                        "m_maintain_kg" => "",
                        "m_toning_lbs" => "",
                        "m_toning_kg" => "",
                        "m_muscle_growth_lbs" => "",
                        "m_muscle_growth_kg" => "",
                        "m_weight_loss_lbs" => "",
                        "m_weight_loss_kg" => "",
                        "m_maintain_high_lbs" => "",
                        "m_maintain_high_kg" => "",
                        "m_toning_high_lbs" => "",
                        "m_toning_high_kg" => "",
                        "m_muscle_growth_high_lbs" => "",
                        "m_muscle_growth_high_kg" => "",
                        "m_weight_loss_high_lbs" => "",
                        "m_weight_loss_high_kg" => "",
                    ],
                ],
            ],
        ];

        return TwwcOptions::update_option('twwc__protein_settings', $protein_settings);
    }
}
