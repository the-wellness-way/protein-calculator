<?php
namespace TwwcProtein\Setup;

use TwwcProtein\Options\TwwcOptions;

class TwwcInstallSchema {
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

        return TwwcOptions::update_option('settings', $settings);
    }

    public static function install_protein_settings() {
        $protein_settings = [
            "system" => "metric",
            "activity_level" => [
                "sedentary" => [
                    "enable" => "1",
                    "label" => "",
                    "m_sedentary_kg" => 0.8,
                    "m_sedentary_high_kg" => 1.3,
                    "goal" => [
                        "m_maintain_lbs" => 0.36,
                        "m_maintain_kg" => 0.8,
                        "m_maintain_high_lbs" => 0.59,
                        "m_maintain_high_kg" => 1.3,
                        "m_toning_lbs" => 0.39,
                        "m_toning_kg" => 0.85,
                        "m_toning_high_lbs" => 0.61,
                        "m_toning_high_kg" => 1.35,
                        "m_muscle_growth_lbs" => 0.43,
                        "m_muscle_growth_kg" => 0.95,
                        "m_muscle_growth_high_lbs" => 0.66,
                        "m_muscle_growth_high_kg" => 1.45,
                        "m_weight_loss_lbs" => 0.36,
                        "m_weight_loss_kg" => 0.8,
                        "m_weight_loss_high_lbs" => 0.54,
                        "m_weight_loss_high_kg" => 1.2,
                    ],
                    "m_sedentary_lbs" => 0.36,
                    "m_sedentary_high_lbs" => 0.59,
                ],
                "lightly_active" => [
                    "enable" => "1",
                    "label" => "",
                    "m_lightly_active_kg" => 1.1,
                    "m_lightly_active_high_kg" => 1.35,
                    "goal" => [
                        "m_maintain_lbs" => 0.54,
                        "m_maintain_kg" => 1.2,
                        "m_maintain_high_lbs" => 0.61,
                        "m_maintain_high_kg" => 1.35,
                        "m_toning_lbs" => 0.59,
                        "m_toning_kg" => 1.3,
                        "m_toning_high_lbs" => 0.66,
                        "m_toning_high_kg" => 1.45,
                        "m_muscle_growth_lbs" => 0.68,
                        "m_muscle_growth_kg" => 1.5,
                        "m_muscle_growth_high_lbs" => 0.73,
                        "m_muscle_growth_high_kg" => 1.6,
                        "m_weight_loss_lbs" => 0.43,
                        "m_weight_loss_kg" => 0.95,
                        "m_weight_loss_high_lbs" => 0.57,
                        "m_weight_loss_high_kg" => 1.25,
                    ],
                    "m_lightly_active_lbs" => 0.5,
                    "m_lightly_active_high_lbs" => 0.61,
                ],
                "moderately_active" => [
                    "enable" => "1",
                    "label" => "",
                    "m_moderately_active_kg" => 1.35,
                    "m_moderately_active_high_kg" => 1.55,
                    "goal" => [
                        "m_maintain_lbs" => 0.61,
                        "m_maintain_kg" => 1.35,
                        "m_maintain_high_lbs" => 0.7,
                        "m_maintain_high_kg" => 1.55,
                        "m_toning_lbs" => 0.64,
                        "m_toning_kg" => 1.4,
                        "m_toning_high_lbs" => 0.73,
                        "m_toning_high_kg" => 1.6,
                        "m_muscle_growth_lbs" => 0.75,
                        "m_muscle_growth_kg" => 1.65,
                        "m_muscle_growth_high_lbs" => 0.82,
                        "m_muscle_growth_high_kg" => 1.8,
                        "m_weight_loss_lbs" => 0.5,
                        "m_weight_loss_kg" => 1.1,
                        "m_weight_loss_high_lbs" => 0.61,
                        "m_weight_loss_high_kg" => 1.35,
                    ],
                    "m_moderately_active_lbs" => 0.61,
                    "m_moderately_active_high_lbs" => 0.7,
                ],
                "very_active" => [
                    "enable" => "1",
                    "label" => "",
                    "m_very_active_kg" => 1.6,
                    "m_very_active_high_kg" => 1.75,
                    "goal" => [
                        "m_maintain_lbs" => 0.73,
                        "m_maintain_kg" => 1.6,
                        "m_maintain_high_lbs" => 0.79,
                        "m_maintain_high_kg" => 1.75,
                        "m_toning_lbs" => 0.86,
                        "m_toning_kg" => 1.9,
                        "m_toning_high_lbs" => 0.95,
                        "m_toning_high_kg" => 2.1,
                        "m_muscle_growth_lbs" => 0.91,
                        "m_muscle_growth_kg" => 2,
                        "m_muscle_growth_high_lbs" => 1.02,
                        "m_muscle_growth_high_kg" => 2.25,
                        "m_weight_loss_lbs" => 0.59,
                        "m_weight_loss_kg" => 1.3,
                        "m_weight_loss_high_lbs" => 0.75,
                        "m_weight_loss_high_kg" => 1.65,
                    ],
                    "m_very_active_lbs" => 0.73,
                    "m_very_active_high_lbs" => 0.79,
                ],
                "super_active" => [
                    "enable" => "1",
                    "label" => "",
                    "m_super_active_kg" => 2,
                    "m_super_active_high_kg" => 2.25,
                    "goal" => [
                        "m_maintain_lbs" => 0.91,
                        "m_maintain_kg" => 2,
                        "m_maintain_high_lbs" => 1.02,
                        "m_maintain_high_kg" => 2.25,
                        "m_toning_lbs" => 1.02,
                        "m_toning_kg" => 2.25,
                        "m_toning_high_lbs" => 1.2,
                        "m_toning_high_kg" => 2.65,
                        "m_muscle_growth_lbs" => 1.13,
                        "m_muscle_growth_kg" => 2.5,
                        "m_muscle_growth_high_lbs" => 1.25,
                        "m_muscle_growth_high_kg" => 2.75,
                        "m_weight_loss_lbs" => 0.64,
                        "m_weight_loss_kg" => 1.4,
                        "m_weight_loss_high_lbs" => 0.79,
                        "m_weight_loss_high_kg" => 1.75,
                    ],
                    "m_super_active_lbs" => 0.91,
                    "m_super_active_high_lbs" => 1.02,
                ],
            ],
            "pregnant" => 10,
            "pregnant_lactating" => 15,
            "content" => [],
            "defaults" => [
                "activity_level" => "sedentary",
            ],
            "multiplier_weight_lbs" => 0.36,
            "multiplier_weight_kg" => 0.8,
            "multiplier_weight_high_lbs" => 0.59,
            "multiplier_weight_high_kg" => 1.3,
        ];

        return TwwcOptions::update_option('protein_settings', $protein_settings);
    }
}
