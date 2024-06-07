<div class="protein-calculator-wrapper">
    <div class="protein-calculator protein-calculator--large">
        <form class="protein-calculator-form">
            <div class="protein-calculator__form-group protein-calculator__form-group--radio">
                <div class="protein-calculator__label">
                    <label class="main-label" for="Units">Units & Measurement</label>
                </div>

                <div class="protein-calculator__inputs protein-calculator__inputs--radio">
                    <input class="protein-calculator__units-measurement protein-calculator__radio" type="radio" id="imperial" name="units" <?php echo 'imperial' === $protein_settings['system'] ? 'checked' : ''; ?>  value="imperial">
                    <label for="imperial">Imperial</label>
                    <input class="protein-calculator__units-measurement protein-calculator__radio" type="radio" id="metric" name="units" <?php echo 'metric' === $protein_settings['system'] ? 'checked' : ''; ?> value="metric">
                    <label for="metric">Metric</label>
                </div>
            </div>

            <div class="protein-calculator__step protein-calculator__pregnant-fields">
                <!-- Pregnant or Nursing -->
                <div class="protein-calculator__form-group protein-calculator__form-group--radio">
                    <div class="protein-calculator__label">
                        <label class="main-label" for="pregnant">Are you pregnant or nursing?</label>
                    </div>

                    <div class="protein-calculator__inputs protein-calculator__inputs--radio">
                        <input id="preg-1" class="protein-calculator__radio protein-calculator__pregnant" type="radio" name="pregnant" value="No" checked>
                        <label for="preg-1">No</label>
                        <input id="preg-2" class="protein-calculator__radio protein-calculator__pregnant" type="radio" name="pregnant" value="I am pregnant">
                        <label for="preg-2">I am pregnant</label>
                        <input id="preg-3" class="protein-calculator__radio protein-calculator__pregnant" type="radio" name="pregnant" value="I am nursing">
                        <label for="preg-3">I am nursing</label>
                    </div>
                </div>

                <!-- Weight -->
                <div class="protein-calculator__form-group">
                    <div class="protein-calculator__label">
                        <label class="main-label" for="weight">Weight</label>
                    </div>

                    <div class="protein-calculator__inputs protein-calculator__inputs--number-small">
                        <div class="protein-calculator__toggle-units <?php echo 'metric' === $protein_settings['system'] ? 'hide' : ''; ?>">
                            <div class="input-group"><input step=".01" class="protein-calculator__weight protein-calculator__weight--lbs" type="number" name="weight_lbs" placeholder="Pounds"><span>lbs</span></div>
                        </div>
                        <div class="protein-calculator__toggle-units <?php echo 'imperial' === $protein_settings['system'] ? 'hide' : ''; ?>" >
                            <div class="input-group"><input step=".01" class="protein-calculator__weight protein-calculator__weight--kg" type="number" name="weight_kg" placeholder="Kilograms"><span>kg</span></div>
                        </div>
                    </div>            
                </div>
            </div>

            <div class="protein-calculator__step protein-calculator__not-pregnant-fields">    
                <!-- How Active Are You? -->
                <div class="protein-calculator__form-group">
                    <div class="protein-calculator__label">
                        <label for="workouts">How active are you?</label>
                    </div>

                    <div class="protein-calculator__inputs protein-calculator__inputs--select">
                        <?php $activity_level = $protein_settings['activity_level'] ?? null; ?>
                        <select class="protein-calculator__active-level" name="activity" id="activity">
                            <?php foreach($activity_level as $key => $value) : ?>
                                <?php $label = $value['label'] ? $value['label'] : ucwords(str_replace('_', ' ', $key)); ?>

                                <?php if($value['enable']) :?>
                                    <option value="<?php echo $key; ?>"><?php echo $label; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>  
                </div>    

                <!-- Fitness Goal -->
                <div class="protein-calculator__form-group protein-calculator__form-group--radio">
                    <div class="protein-calculator__label">
                        <label class="main-label" for="goal">Fitness goal</label>
                    </div>

                    <div class="protein-calculator__inputs protein-calculator__inputs--radio">
                        <input id="goal-1" class="protein-calculator__radio protein-calculator__goal" type="radio" name="fitness_goal" value="maintain" checked>
                        <label class="goal-label" for="goal-1">Maintain</label>
                        <input id="goal-3" class="protein-calculator__radio protein-calculator__goal" type="radio" name="fitness_goal" value="toning">
                        <label class="goal-label" for="goal-3">Toning</label>
                        <input id="goal-2" class="protein-calculator__radio protein-calculator__goal" type="radio" name="fitness_goal" value="muscle_growth">
                        <label class="goal-label" for="goal-2">Muscle Growth</label>    
                        <input id="goal-4" class="protein-calculator__radio protein-calculator__goal" type="radio" name="fitness_goal" value="weight_loss">
                        <label class="goal-label" for="goal-4">Weight Loss</label>
                    </div>
                </div>
            </div>
        </form>

        <div class="protein-calculator--results protein-calculator--results-range">
            <div class="protein-calculator--results-inner">     
                <div class="protein-calculator--results-low-end">
                    <div class="protein-calculator--results__label">
                        <label for="protein">Your Optimal Protein Intake</label>
                    </div>
                    <div class="protein-calculator--results__value">
                        <span class='the-result'>&mdash;</span><span id="calculator-system-suffix">g</span>
                    </div>
                </div>

                <div class="protein-calculator--results-high-end">
                    <div class="protein-calculator--results__label">
                        <label for="protein">Protein Intake <br />  (High End)</label>
                    </div>
                    <div class="protein-calculator--results__high-end">
                        <span class='the-result-high'>&mdash;</span><span id="calculator-system-suffix">g</span>
                    </div>
                </div>

                <div class="protein-message" style="margin-top: 20px;">
                    <div class="protein-data-requirements" style="font-size: 13px;">
                        <span>*</span> Weight is required.
                    </div>
                </div>
            </div>
        </div><!-- Close protein-calculator--results -->
    </div><!-- Close protein-calculator -->
</div><!-- Close protein-calculator-wrapper -->
