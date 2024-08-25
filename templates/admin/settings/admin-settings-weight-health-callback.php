<div class='protein-calculator__weight-health-main'>
    <div class='protein-calculator__multi-wrapper-inner-label'>
        <label for='underweight'>Underweight</label>
        <label for='normal-weight' class='active'>Normal Weight</label>
        <label for='overweight'>Overweight</label>
        <label for='obese'>Obese</label>
        <label for='severely-obese'>Severely Obese</label>
    </div>
    <div id="main-underweight">
        <input type="number" name="underweight" value="<?php echo $protein_settings['underweight'] ?? ''; ?>" placeholder="Underweight">
    </div>
    <div id="main-normal-weight">
        <input type="number" name="normal-weight" value="<?php echo $protein_settings['normal-weight'] ?? ''; ?>" placeholder="Normal Weight">
    </div>  
    <div id="main-overweight">
        <input type="number" name="overweight" value="<?php echo $protein_settings['overweight'] ?? ''; ?>" placeholder="Overweight">
    </div>
    <div id="main-obese">
        <input type="number" name="obese" value="<?php echo $protein_settings['obese'] ?? ''; ?>" placeholder="Obese">
    </div>
</div>