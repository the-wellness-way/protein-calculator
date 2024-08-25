<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$primary_color = isset($settings['theme_options']['plugin_colors']) && isset($settings['theme_options']['plugin_colors']['primary']) ? $settings['theme_options']['plugin_colors']['primary'] : '#E6F1D9';
$fields_color_value = isset($settings['theme_options']['plugin_colors']) && isset($settings['theme_options']['plugin_colors']['fields_color']) ? $settings['theme_options']['plugin_colors']['fields_color'] : '#80b741';
$system = $protein_settings['system'] ?? null;
$activity_level = $protein_settings['activity_level'] ?? null;
$activity_level_default = $protein_settings['defaults'] && $protein_settings['defaults']['activity_level'] ? $protein_settings['defaults']['activity_level'] : null;
$results_content = isset($protein_settings['content']) && isset($protein_settings['content']['results']) ? $protein_settings['content']['results'] : null;
?>

<div class="protein-calculator-bmi-wrapper">
    <div class="protein-calculator protein-calcualtor--bmi protein-calculator--compact">
        <div class="protein-calculator-bmi protein-calculator-inner">
            <form class="protein-calculator__form">
                <div class="protein-calculator__form-group">
                    <div class="protein-calculator__label">
                        <label>Height</label>
                    </div>
                    <div class="protein-calculator__inputs protein-calculator__inputs--number-small">
                        <div class="protein-calculator__toggle-units <?php echo 'metric' === $protein_settings['system'] ? 'hide' : ''; ?>">
                            <div class="input-group">
                                <input class="protein-calculator__height-feet" type="number" name="height_feet" value="" placeholder="Feet"/>
                                <input class="protein-calculator__height-inches" type="number" name="height_inches" value="" placeholder="Inches"/>
                            </div>
                        </div>
                        <div class="protein-calculator__toggle-units <?php echo 'imperial' === $protein_settings['system'] ? 'hide' : ''; ?>">
                            <div class="input-group">
                                <input type="number" name="height_centimeters" value="" placeholder="Centimeters" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="protein-calculator__form-group">
                    <div class="protein-calculator__label">
                        <label>Weight</label>
                    </div>
                    <div class="protein-calculator__inputs protein-calculator__inputs--number-small">
                        <div class="protein-calculator__toggle-units <?php echo 'metric' === $protein_settings['system'] ? 'hide' : ''; ?>">
                            <div class="input-group"><input step=".01" class="protein-calculator__weight protein-calculator__weight--lbs" type="number" name="weight_lbs" placeholder="Pounds"></div>
                        </div>
                        <div class="protein-calculator__toggle-units <?php echo 'imperial' === $protein_settings['system'] ? 'hide' : ''; ?>" >
                            <div class="input-group"><input step=".01" class="protein-calculator__weight protein-calculator__weight--kg" type="number" name="weight_kg" placeholder="Kilograms"></div>
                        </div>
                    </div>
                </div>  
            </form> 

            <div class="protein-calculator--results">
                <div class="protein-calculator--results-inner protein-calculator--results-range" style="background-color: <?php echo esc_attr($primary_color); ?>">
                    <div class="protein-calculator--results-default">
                        <div class="protein-calculator--results-low-end">
                            <div class="protein-calculator--results__label">
                                <label class="results-header" for="protein" style="text-align: center; color: black; margin-bottom: 25px; display: block; font-weight: 200;">Your BMI</label>
                                <div class="protein-calculator--bmi-results__value">
                                    <span style="text-align: center; color: black; margin-bottom: 15px; display: block;" class='the-result'>&mdash;</span> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Closing tag for protein-calculator--results-inner -->
            </div> <!-- Closing tag for protein-calculator--results -->
        </div>       
    </div>
</div>