<?php
namespace TwwcProtein\Admin;
class TwwcBeans {
    public static $goal_keys = [
        'maintain',
        'toning',
        'muscle_growth',
        'weight_loss',     
    ];

    public static $settings_keys_strings = [
        'plugin_colors' => [
            'primary'=> '#E6F1D9',
        ]
    ];

    public static $protein_keys_strings = [
        'system' => 'imperial'
    ];
    
    public static $protein_keys_ints = [
        'pregnant' => '',
        'pregnant_lactating' => ''
    ];

    public static $protein_keys_arrays = [
        'content' => [],
        'defaults' => []
    ];

    public static $protein_keys_weight_ints = [
        'multiplier_weight_lbs' => '',
        'multiplier_weight_kg' => '',
        'multiplier_weight_high_lbs' => '',
        'multiplier_weight_high_kg' => ''
    ];

    public static $protein_keys_activity_levels_ints = [
        'sedentary' => [
            'enable' => 1,
            'm_sedentary_lbs' => '',
            'm_sedentary_kg' => '',
            'm_sedentary_high_lbs' => '',
            'm_sedentary_high_kg' => '',
            'goal' => [
                'm_maintain_lbs' => '',
                'm_maintain_kg' => '',
                'm_maintain_high_lbs' => '',
                'm_maintain_high_kg' => '',
                'm_toning_lbs' => '',
                'm_toning_kg' => '',
                'm_toning_high_lbs' => '',
                'm_toning_high_kg' => '',
                'm_muscle_growth_lbs' => '',
                'm_muscle_growth_kg' => '',
                'm_muscle_growth_high_lbs' => '',
                'm_muscle_growth_high_kg' => '',
                'm_weight_loss_lbs' => '',
                'm_weight_loss_kg' => '',
                'm_weight_loss_high_lbs' => '',
                'm_weight_loss_high_kg' => ''
            ]
        ],
        'lightly_active' => [
            'enable' => 1,
            'm_lightly_active_lbs' => '',
            'm_lightly_active_kg' => '',
            'm_lightly_active_high_lbs' => '',
            'm_lightly_active_high_kg' => '',
            'goal' => [
                'm_maintain_lbs' => '',
                'm_maintain_kg' => '',
                'm_maintain_high_lbs' => '',
                'm_maintain_high_kg' => '',
                'm_toning_lbs' => '',
                'm_toning_kg' => '',
                'm_toning_high_lbs' => '',
                'm_toning_high_kg' => '',
                'm_muscle_growth_lbs' => '',
                'm_muscle_growth_kg' => '',
                'm_muscle_growth_high_lbs' => '',
                'm_muscle_growth_high_kg' => '',
                'm_weight_loss_lbs' => '',
                'm_weight_loss_kg' => '',
                'm_weight_loss_high_lbs' => '',
                'm_weight_loss_high_kg' => ''
            ]
        ],
        'moderately_active' => [
            'enable' => 1,
            'm_moderately_active_lbs' => '',
            'm_moderately_active_kg' => '',
            'm_moderately_active_high_lbs' => '',
            'm_moderately_active_high_kg' => '',
            'goal' => [
                'm_maintain_lbs' => '',
                'm_maintain_kg' => '',
                'm_maintain_high_lbs' => '',
                'm_maintain_high_kg' => '',
                'm_toning_lbs' => '',
                'm_toning_kg' => '',
                'm_toning_high_lbs' => '',
                'm_toning_high_kg' => '',
                'm_muscle_growth_lbs' => '',
                'm_muscle_growth_kg' => '',
                'm_muscle_growth_high_lbs' => '',
                'm_muscle_growth_high_kg' => '',
                'm_weight_loss_lbs' => '',
                'm_weight_loss_kg' => '',
                'm_weight_loss_high_lbs' => '',
                'm_weight_loss_high_kg' => ''
            ]
        ],
        'very_active' => [
            'enable' => 1,
            'm_very_active_lbs' => '',
            'm_very_active_kg' => '',
            'm_very_active_high_lbs' => '',
            'm_very_active_high_kg' => '',
            'goal' => [
                'm_maintain_lbs' => '',
                'm_maintain_kg' => '',
                'm_maintain_high_lbs' => '',
                'm_maintain_high_kg' => '',
                'm_toning_lbs' => '',
                'm_toning_kg' => '',
                'm_toning_high_lbs' => '',
                'm_toning_high_kg' => '',
                'm_muscle_growth_lbs' => '',
                'm_muscle_growth_kg' => '',
                'm_muscle_growth_high_lbs' => '',
                'm_muscle_growth_high_kg' => '',
                'm_weight_loss_lbs' => '',
                'm_weight_loss_kg' => '',
                'm_weight_loss_high_lbs' => '',
                'm_weight_loss_high_kg' => ''
            ]
        ],
        'super_active' => [
            'enable' => 1,
            'm_super_active_lbs' => '',
            'm_super_active_kg' => '',
            'm_super_active_high_lbs' => '',
            'm_super_active_high_kg' => '',
            'goal' => [
                'm_maintain_lbs' => '',
                'm_maintain_kg' => '',
                'm_maintain_high_lbs' => '',
                'm_maintain_high_kg' => '',
                'm_toning_lbs' => '',
                'm_toning_kg' => '',
                'm_toning_high_lbs' => '',
                'm_toning_high_kg' => '',
                'm_muscle_growth_lbs' => '',
                'm_muscle_growth_kg' => '',
                'm_muscle_growth_high_lbs' => '',
                'm_muscle_growth_high_kg' => '',
                'm_weight_loss_lbs' => '',
                'm_weight_loss_kg' => '',
                'm_weight_loss_high_lbs' => '',
                'm_weight_loss_high_kg' => ''
            ]
        ]
    ];

    public static $protein_keys_activity_levels_strings = [
        'sedentary' => [
            'label' => ''
        ],
        'lightly_active' => [
            'label' => ''
        ],
        'moderately_active' => [
            'label' => ''
        ],
        'very_active' => [
            'label' => ''
        ],
        'super_active' => [
            'label' => ''
        ]
    ];
}