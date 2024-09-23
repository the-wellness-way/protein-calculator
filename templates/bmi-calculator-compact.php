<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$primary_color = isset($settings['theme_options']['plugin_colors']) && isset($settings['theme_options']['plugin_colors']['primary']) ? $settings['theme_options']['plugin_colors']['primary'] : '#E6F1D9';
$fields_color_value = isset($settings['theme_options']['plugin_colors']) && isset($settings['theme_options']['plugin_colors']['fields_color']) ? $settings['theme_options']['plugin_colors']['fields_color'] : '#80b741';
$results_text_color_value = isset($settings['theme_options']['plugin_colors']) && isset($settings['theme_options']['plugin_colors']['results_text_color']) ? $settings['theme_options']['plugin_colors']['results_text_color'] : '#000000';
$system = $protein_settings['system'] ?? null;
$activity_level = $protein_settings['activity_level'] ?? null;
$activity_level_default = $protein_settings['defaults'] && $protein_settings['defaults']['activity_level'] ? $protein_settings['defaults']['activity_level'] : null;
$results_content = isset($protein_settings['content']) && isset($protein_settings['content']['results']) ? $protein_settings['content']['results'] : null;
?>

<div class="protein-calculator-bmi-wrapper">
                <style>
                    .protein-calculator-bmi-wrapper .protein-calculator--compact .protein-calculator-inner {
                        justify-content: space-between;
                    }
                    .protein-calculator__inputs--bmi-radio input[type="radio"] + label {
                        <?php echo "border-color: ".$fields_color_value." !important;"; ?>
                        <?php echo "color: ".$fields_color_value." !important;"; ?>
                    }

                    .protein-calculator__inputs--bmi-radio input[type="radio"]:checked + label,
                    .protein-calculator__inputs--radio-reg-label input[type="radio"]:checked + label {
                        <?php echo "background-color: ".$fields_color_value." !important;"; ?>
                        <?php echo "color: white !important;"; ?>
                    }

                    .protein-calculator-bmi-wrapper .protein-calculator__imperial,
                    .protein-calculator-bmi-wrapper .protein-calculator__metric,
                    .protein-calculator-bmi-wrapper .protein-calculator__metric .input-group,
                    .protein-calculator-bmi-wrapper .protein-calculator__imperial .input-group {
                        width: 100%;
                    }

                    .protein-calculator-bmi-wrapper .protein-calculator__inputs--number-small input {
                            max-width: 135px !important;
                    }

                    .protein-calculator-bmi-wrapper .protein-calculator__imperial .input-group span {
                        margin: 0 10px;
                        font-style: italic;
                        display: inline-block;
                    }

                    @media (max-width: 767px) {
                        
                        .protein-calculator-bmi-wrapper .protein-calculator__imperial .input-group {
                            width: 100%;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }

                        .protein-calculator-bmi-wrapper .protein-calculator__imperial .input-group div {
                            width: 100%;
                            display: flex;
                            justify-content: flex-start;
                            align-items: center;    
                        }

                        .protein-calculator-bmi-wrapper .protein-calculator__imperial .input-group input {
                            width: 45%;
                        }

                        .protein-calculator-bmi-wrapper .protein-calculator__metric .input-group input {
                            width: 45%;
                        }
                    }
                </style>

    <div class="protein-calculator protein-calcualtor--bmi protein-calculator--compact">
        <div class="protein-calculator-bmi protein-calculator-inner">
            <form class="protein-calculator__form">
                <div class="protein-calculator__form-group protein-calculator__form-group--radio">
                    <div class="protein-calculator__label">
                        <label class="main-label" for="Units">Units & Measurement</label>
                    </div>

                    <div class="protein-calculator__inputs protein-calculator__inputs--radio protein-calculator__inputs--bmi-radio">
                        <input class="protein-calculator__bmi-units-measurement protein-calculator__radio" type="radio" id="bmi-imperial" name="bmi-units" <?php echo 'imperial' === $protein_settings['system'] ? 'checked' : ''; ?>  value="imperial">
                        <label for="bmi-imperial">Imperial</label>
                        <input class="protein-calculator__bmi-units-measurement protein-calculator__radio" type="radio" id="bmi-metric" name="bmi-units" <?php echo 'metric' === $protein_settings['system'] ? 'checked' : ''; ?> value="metric">
                        <label for="bmi-metric">Metric</label>
                    </div>
                </div>
                <div class="protein-calculator__form-group">
                    <div class="protein-calculator__label">
                        <label>Height</label>
                    </div>
                    <div class="protein-calculator__inputs protein-calculator__inputs--number-small">
                        <div class="protein-calculator__imperial protein-calculator__bmi-toggle-units <?php echo 'metric' === $protein_settings['system'] ? 'hide' : ''; ?>">
                            <div class="input-group">
                                <input class="protein-calculator__height-feet" type="number" name="height_feet" value="" placeholder="Feet"/> <span>ft</span>
                                <input class="protein-calculator__height-inches" type="number" name="height_inches" value="" placeholder="Inches"/> <span>in</span>
                            </div>
                        </div>
                        <div class="protein-calculator__metric protein-calculator__bmi-toggle-units <?php echo 'imperial' === $protein_settings['system'] ? 'hide' : ''; ?>">
                            <div class="input-group">
                                <input class="protein-calculator__height-centimeters" type="number" name="height_centimeters" value="" placeholder="Centimeters" /> <span>cm</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="protein-calculator__form-group">
                    <div class="protein-calculator__label">
                        <label>Weight</label>
                    </div>
                    <div class="protein-calculator__inputs protein-calculator__inputs--number-small">
                        <div class="protein-calculator__imperial protein-calculator__bmi-toggle-units <?php echo 'metric' === $protein_settings['system'] ? 'hide' : ''; ?>">
                            <div class="input-group">
                                <div>
                                    <input step=".01" class="protein-calculator__weight protein-calculator__weight-lbs" type="number" name="bmi_weight_lbs" placeholder="Pounds"> <span>lbs</span>
                                </div>
                            </div>
                        </div>
                        <div class="protein-calculator__metric protein-calculator__bmi-toggle-units <?php echo 'imperial' === $protein_settings['system'] ? 'hide' : ''; ?>" >
                            <div class="input-group">
                                <div>
                                    <input step=".01" class="protein-calculator__weight protein-calculator__weight-kg" type="number" name="bmi_weight_kg" placeholder="Kilograms"> <span>kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </form> 

            <div class="protein-calculator--results">
                <div class="protein-calculator--results-inner protein-calculator--results-range" style="background-color: <?php echo esc_attr($primary_color); ?>">
                    <div class="protein-calculator--results-default">
                        <div class="protein-calculator--results-low-end">
                            <div class="protein-calculator--results__label">
                                <label class="results-header" for="protein" style="text-align: center; color: <?php echo esc_attr($results_text_color_value); ?>; margin-bottom: 25px; display: block; font-weight: 200;">Your BMI</label>
                                <div class="protein-calculator--bmi-results__value">
                                    <span style="text-align: center; color: <?php echo esc_attr($results_text_color_value); ?>; margin-bottom: 15px; display: block;" class='the-result'>&mdash;</span> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Closing tag for protein-calculator--results-inner -->
            </div> <!-- Closing tag for protein-calculator--results -->
        </div>       
    </div>
</div>