<?php
$bg_color = isset($settings['theme_options']['plugin_colors']) && isset($settings['theme_options']['plugin_colors']['primary']) ? $settings['theme_options']['plugin_colors']['primary'] : '#E6F1D9';
$system = $protein_settings['system'] ?? null;
$activity_level = $protein_settings['activity_level'] ?? null;
$activity_level_default = $protein_settings['defaults'] && $protein_settings['defaults']['activity_level'] ? $protein_settings['defaults']['activity_level'] : null;
$results_content = isset($protein_settings['content']) && isset($protein_settings['content']['results']) ? $protein_settings['content']['results'] : null;
?>

<div class="protein-calculator protein-calculator--compact">
    <div class="protein-calculator-inner">
        <form class="protein-calculator-form">
            <div class="protein-calculator__form-group protein-calculator__form-group--radio">
                <div class="protein-calculator__label">
                    <label class="main-label" for="Units">Goal Weight</label>
                </div>

                <!-- here we will have a radio toggle for the units after the input -->
                <div class="protein-calculator__inputs ">
                    <input class="protein-calculator__weight protein-calculator__weight--lbs <?php echo 'metric' === $system ? 'hide' : '';  ?>" type="number" id="weight_lbs" name="weight_lbs" placeholder="Pounds">
                    <input class="protein-calculator__weight protein-calculator__weight--kg <?php echo 'imperial' === $system ? 'hide' : '';  ?>" type="number" id="weight_kg" name="weight_kg" placeholder="Kilograms">

                    <div class="protein-calculator__inputs--radio-reg-label"> 
                        <div>
                            <input step=".001" class="protein-calculator__weight-toggle protein-calculator__units-measurement"  type="radio" id="imperial" name="units" value="imperial" <?php echo 'imperial' === $system ? 'checked' : '';  ?>>
                            <label  for="imperial">lbs</label>
                        </div>
                        <div>
                            <input step=".001" class="protein-calculator__weight-toggle protein-calculator__units-measurement" type="radio" id="metric" name="units" value="metric" <?php echo 'metric' === $system ? 'checked' : '';  ?>>
                            <label for="metric">kg</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Activity Level -->
            <div class="protein-calcualtor__form-group">
                <div class="protein-calculator__label">
                    <label class="main-label" for="activity">How active are you?</label>
                </div>

                <div class="protein-calculator__inputs protein-calculator__inputs--select">
                    <?php $activity_level = $protein_settings['activity_level'] ?? null; ?>
                    <select class="protein-calculator__active-level" name="activity" id="activity">
                        <?php if(!$activity_level_default || 0 == $protein_settings['activity_level'][$activity_level_default]['enable']) : ?>
                            <option default value="">-- Choose Activity Level --</option>
                        <?php endif; ?>

                        <?php foreach($activity_level as $key => $value) : ?>
                            <?php $label = $value['label'] ? $value['label'] : ucwords(str_replace('_', ' ', $key)); ?>

                            <?php if($value['enable']) :?>
                                <option <?php echo $key === $activity_level_default ? 'default' : '' ; ?> value="<?php echo $key; ?>"><?php echo $label; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>     
            </div>

            <!-- Goals -->
            <div class="protein-calculator__form-group">   
                <div class="protein-calculator__label"><label class="main-label" for="activity">What is your fitness goal?</label></div>
                <div class="protein-calculator__inputs protein-calculator__inputs--select">
                    <select class="protein-calculator__goal-select" name="goal" id="goal">
                        <option value="weight_loss">Lose Weight</option>
                        <option value="maintain">Maintain</option>
                        <option value="toning">Tone Up</option>
                        <option value="muscle_growth">Build Muscle</option>
                    </select>
                </div>
            </div>  
        </form>
        <?php
            $background_color = $protein_settings['results']['style']['background_color'] ?? '#E6F1D9';
            $border_radius = $protein_settings['results']['style']['border_radius'] ?? '20px';
            $padding = $protein_settings['results']['style']['padding'] ?? '40px 20px';

            $styles = [
                'background-color' => $background_color,
                'border-radius' => $border_radius,
                'padding' => $padding
            ];

            //format style string to echo in the div
            $style_string = '';
            foreach($styles as $key => $value) {
                if($key && $value) {
                    $style_string .= $key . ':' . $value . ';';
                }
            }
        ?>
        <div class="protein-calculator--results">
            <div class="protein-calculator--results-inner protein-calculator--results-range" style="background-color: <?php echo $bg_color; ?>">
                <div class="protein-calculator--results-default">
                    <div class="protein-calculator--results-low-end">
                        <div class="protein-calculator--results__label">
                            <label class="results-header" for="protein" style="text-align: center; color: black; margin-bottom: 25px; display: block; font-weight: 200;">Your Optimal Protein Intake</label>
                            <div class="protein-calculator--results__value">
                                <span style="text-align: center; color: black; margin-bottom: 15px; display: block;" class='the-result'>&mdash;</span> 
                                <p style="text-align: center; margin-top: 3px; font-size: 18px; padding-bottom: 0;  display: block;">grams/day</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Closing tag for protein-calculator--results-inner -->
        </div> <!-- Closing tag for protein-calculator--results -->
    </div><!-- Closing tag for protein-calculator-inner -->
</div> <!-- Closing tag for protein-calculator -->
