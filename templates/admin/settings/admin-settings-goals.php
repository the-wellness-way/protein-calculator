<div class='protien-calculator__goals'>
    <div class='protein-calculator__goal'>
            <label>Maintain</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_maintain_lbs]' value='<?php echo esc_attr($maintain_value_lbs); ?>' /> <span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_maintain_kg]' value='<?php echo esc_attr($maintain_value_kg); ?>' /> <span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_maintain_high_lbs]' value='<?php echo esc_attr($maintain_value_high_lbs); ?>' /> <span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_maintain_high_kg]' value='<?php echo esc_attr($maintain_value_high_kg); ?>' /> <span>g/kg (high)</span>
            </div>
        </div>
        <div class='protein-calculator__goal'>
            <label>Tone Up</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_toning_lbs]' value='<?php echo esc_attr($toning_value_lbs); ?>' /><span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_toning_kg]' value='<?php echo esc_attr($toning_value_kg); ?>' /><span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_toning_high_lbs]' value='<?php echo esc_attr($toning_value_high_lbs); ?>' /><span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_toning_high_kg]' value='<?php echo esc_attr($toning_value_high_kg); ?>' /><span>g/kg (high)</span>
            </div>
        </div>
        <div class='protein-calculator__goal'>
            <label>Build Muscle</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_muscle_growth_lbs]' value='<?php echo esc_attr($muscle_growth_value_lbs); ?>' /><span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_muscle_growth_kg]' value='<?php echo esc_attr($muscle_growth_value_kg); ?>' /><span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_muscle_growth_high_lbs]' value='<?php echo esc_attr($muscle_growth_value_high_lbs); ?>' /><span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_muscle_growth_high_kg]' value='<?php echo esc_attr($muscle_growth_value_high_kg); ?>' /><span>g/kg (high)</span>
            </div>
        </div>       
        <div class='protein-calculator__goal protein-calculator__goal--static'>
            <label>Lose Weight</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_weight_loss_lbs]' value='<?php echo esc_attr($weight_loss_value_lbs ); ?>' /> <span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_weight_loss_kg]' value='<?php echo esc_attr($weight_loss_value_kg ); ?>' /> <span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_weight_loss_high_lbs]' value='<?php echo esc_attr($weight_loss_value_high_lbs ); ?>' /> <span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][goal][m_weight_loss_high_kg]' value='<?php echo esc_attr($weight_loss_value_high_kg ); ?>' /> <span>g/kg (high)</span>
            </div>
        </div>
    </div>
    <div id="overweight" class="protein-calculator__weight-health overweight">
        <div class='protein-calculator__goal'>
            <label>Maintain</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_maintain_lbs]' value='<?php echo esc_attr($maintain_value_lbs); ?>' /> <span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_maintain_kg]' value='<?php echo esc_attr($maintain_value_kg); ?>' /> <span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_maintain_high_lbs]' value='<?php echo esc_attr($maintain_value_high_lbs); ?>' /> <span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_maintain_high_kg]' value='<?php echo esc_attr($maintain_value_high_kg); ?>' /> <span>g/kg (high)</span>
            </div>
        </div>
        <div class='protein-calculator__goal'>
            <label>Tone Up</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_toning_lbs]' value='<?php echo esc_attr($toning_value_lbs); ?>' /><span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_toning_kg]' value='<?php echo esc_attr($toning_value_kg); ?>' /><span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_toning_high_lbs]' value='<?php echo esc_attr($toning_value_high_lbs); ?>' /><span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_toning_high_kg]' value='<?php echo esc_attr($toning_value_high_kg); ?>' /><span>g/kg (high)</span>
            </div>
        </div>
        <div class='protein-calculator__goal'>
            <label>Build Muscle</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_muscle_growth_lbs]' value='<?php echo esc_attr($muscle_growth_value_lbs); ?>' /><span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_muscle_growth_kg]' value='<?php echo esc_attr($muscle_growth_value_kg); ?>' /><span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_muscle_growth_high_lbs]' value='<?php echo esc_attr($muscle_growth_value_high_lbs); ?>' /><span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_muscle_growth_high_kg]' value='<?php echo esc_attr($muscle_growth_value_high_kg); ?>' /><span>g/kg (high)</span>
            </div>
        </div>       
        <div class='protein-calculator__goal protein-calculator__goal--static'>
            <label>Lose Weight</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_weight_loss_lbs]' value='<?php echo esc_attr($weight_loss_value_lbs ); ?>' /> <span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_weight_loss_kg]' value='<?php echo esc_attr($weight_loss_value_kg ); ?>' /> <span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_weight_loss_high_lbs]' value='<?php echo esc_attr($weight_loss_value_high_lbs ); ?>' /> <span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][overweight][goal][m_weight_loss_high_kg]' value='<?php echo esc_attr($weight_loss_value_high_kg ); ?>' /> <span>g/kg (high)</span>
            </div>
        </div>
    </div>
    <div id="obese" class="protein-calculator__weight-health obese">
        <div class='protein-calculator__goal'>
            <label>Maintain</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_maintain_lbs]' value='<?php echo esc_attr($maintain_value_lbs); ?>' /> <span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_maintain_kg]' value='<?php echo esc_attr($maintain_value_kg); ?>' /> <span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_maintain_high_lbs]' value='<?php echo esc_attr($maintain_value_high_lbs); ?>' /> <span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_maintain_high_kg]' value='<?php echo esc_attr($maintain_value_high_kg); ?>' /> <span>g/kg (high)</span>
            </div>
        </div>
        <div class='protein-calculator__goal'>
            <label>Tone Up</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_toning_lbs]' value='<?php echo esc_attr($toning_value_lbs); ?>' /><span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_toning_kg]' value='<?php echo esc_attr($toning_value_kg); ?>' /><span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_toning_high_lbs]' value='<?php echo esc_attr($toning_value_high_lbs); ?>' /><span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_toning_high_kg]' value='<?php echo esc_attr($toning_value_high_kg); ?>' /><span>g/kg (high)</span>
            </div>
        </div>
        <div class='protein-calculator__goal'>
            <label>Build Muscle</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_muscle_growth_lbs]' value='<?php echo esc_attr($muscle_growth_value_lbs); ?>' /><span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_muscle_growth_kg]' value='<?php echo esc_attr($muscle_growth_value_kg); ?>' /><span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_muscle_growth_high_lbs]' value='<?php echo esc_attr($muscle_growth_value_high_lbs); ?>' /><span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_muscle_growth_high_kg]' value='<?php echo esc_attr($muscle_growth_value_high_kg); ?>' /><span>g/kg (high)</span>
            </div>
        </div>       
        <div class='protein-calculator__goal protein-calculator__goal--static'>
            <label>Lose Weight</label>
            <div class='protein-calculator__multipliers'>
                <input class='protein-calculator__imperial-input' width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_weight_loss_lbs]' value='<?php echo esc_attr($weight_loss_value_lbs ); ?>' /> <span>g/lb</span>
                <input class='protein-calculator__metric-input' width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_weight_loss_kg]' value='<?php echo esc_attr($weight_loss_value_kg ); ?>' /> <span>g/kg</span>
                <!-- add the high value here -->
                <input class='protein-calculator__imperial-input  width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_weight_loss_high_lbs]' value='<?php echo esc_attr($weight_loss_value_high_lbs ); ?>' /> <span>g/lb (high)</span>
                <input class='protein-calculator__metric-input' width='75' id='sedentary-muscle-growth' type='number' step='.001' name='<?php echo esc_attr($option_name_protein); ?>[activity_level][<?php echo esc_html($activity_level); ?>][obese][goal][m_weight_loss_high_kg]' value='<?php echo esc_attr($weight_loss_value_high_kg ); ?>' /> <span>g/kg (high)</span>
            </div>
        </div>
</div>
