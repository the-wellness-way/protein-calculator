const bmiState = {
    system: window.twwc_object?.protein_settings?.system ?? 'imperial',
}

const setSystem = (system) => {
    bmiState.system = system;
}

const weightHealth = [
    { maxBmi: 18.5, health: 'Underweight' },
    { maxBmi: 24.9, health: 'Normal' },
    { maxBmi: 29.9, health: 'Overweight' },
    { maxBmi: 34.9, health: 'Obese' },
    { maxBmi: 39.9, health: 'Severely Obese' },
    { maxBmi: Infinity, health: 'Morbidly Obese' }
];

const calculateBMI = (height, weight, system = 'imperial') => {
    if (system === 'imperial') {
        // BMI calculation for imperial units (height in inches, weight in pounds)
        return (weight / (height * height)) * 703;
    } else {
        // BMI calculation for metric units (height in centimeters, weight in kilograms)
        const heightInMeters = height / 100;
        return weight / (heightInMeters * heightInMeters);
    }
};

const determineHealthCategory = (bmi) => {
    for (const category of weightHealth) {
        if (bmi <= category.maxBmi) {
            return category.health;
        }
    }

    return 'Unknown';
};

const twwc_initBMIWeightToggles = () => {
    containers = document.querySelectorAll('.protein-calculator-bmi-wrapper');
    containers.forEach((container) => {
        const weightToggles = container.querySelectorAll('.protein-calculator__bmi-units-measurement');

        if(weightToggles) {
            weightToggles.forEach((toggle) => {
                toggle.addEventListener('click', (e) => {
                    let system = e.target.value;

                    setSystem(system);

                    let imperialMeasurements = container.querySelectorAll('.protein-calculator__imperial');
                    let metricMeasurements = container.querySelectorAll('.protein-calculator__metric');

                    if('imperial' === bmiState.system) {
                        imperialMeasurements.forEach((measurement) => {
                            measurement.classList.remove('hide');
                        });
                        metricMeasurements.forEach((measurement) => {
                            measurement.classList.add('hide');
                        });
                    } else {          
                        imperialMeasurements.forEach((measurement) => {
                            measurement.classList.add('hide');
                        });
                        metricMeasurements.forEach((measurement) => {
                            measurement.classList.remove('hide');
                        });
                    }

                    twwc_BmiConvertToSystem(system);
                });
            });
        }
    });
}

const twwc_BmiConvertToSystem = (system) => {
    if (!system) return;

    const weight_lbs = document.querySelector('.protein-calculator__weight-lbs').value;
    const weight_kg = document.querySelector('.protein-calculator__weight-kg').value;

    // Height fields
    const height_feet = document.querySelector('.protein-calculator__height-feet').value;
    const height_inches = document.querySelector('.protein-calculator__height-inches').value;
    const height_cm = document.querySelector('.protein-calculator__height-centimeters').value;

    let weightValue = '';
    let heightValue = '';

    if ('metric' === system) {
        // Convert weight from lbs to kg
        weightValue = Math.round((weight_lbs / 2.20462) * 100) / 100;
        weightValue = 0 === weightValue ? '' : weightValue;
        document.querySelector('.protein-calculator__weight-kg').value = weightValue;

        // Convert height from feet and inches to cm
        const totalInches = (parseInt(height_feet) || 0) * 12 + (parseInt(height_inches) || 0);
        heightValue = Math.round((totalInches * 2.54) * 100) / 100;
        heightValue = 0 === heightValue ? '' : heightValue;
        document.querySelector('.protein-calculator__height-centimeters').value = heightValue;

        twwc_setCalcData('converting', false);
    } else if ('imperial' === system) {
        // Convert weight from kg to lbs
        weightValue = Math.round((weight_kg * 2.20462) * 100) / 100;
        weightValue = 0 === weightValue ? '' : weightValue;
        document.querySelector('.protein-calculator__weight-lbs').value = weightValue;

        // Convert height from cm to feet and inches
        const totalCm = parseInt(height_cm) || 0;
        const totalInches = Math.round(totalCm / 2.54);
        let feet = Math.floor(totalInches / 12);
        let inches = totalInches % 12;

        feet = 0 === feet ? '' : feet;
        inches = 0 === inches ? '' : inches;

        document.querySelector('.protein-calculator__height-feet').value = feet;
        document.querySelector('.protein-calculator__height-inches').value = inches;
    }
}


const initBmiCalculator = (e) => {
    const bmiContainers = document.querySelectorAll('.protein-calculator-bmi-wrapper');

    if(bmiContainers.length) {
        bmiContainers.forEach(container => {
            let form = container.querySelector('.protein-calculator__form');
            
            form.addEventListener('input', (e) => {
                const selectedValue = e.target.value;
                let feetToInches = 12;
                let heightInInches = 0;
                let heightFeet = parseInt(container.querySelector('.protein-calculator__height-feet').value);
                let heightInches = parseInt(container.querySelector('.protein-calculator__height-inches').value);
                let heightCentimeters = parseInt(container.querySelector('.protein-calculator__height-centimeters').value);
                let weight = container.querySelector('.protein-calculator__weight-lbs').value;
                let weightKg = container.querySelector('.protein-calculator__weight-kg').value;

                if ('metric' === bmiState.system && heightCentimeters && weightKg) {
                    // Metric system calculation (height in centimeters, weight in kilograms)
                    let bmi = calculateBMI(heightCentimeters, weightKg, 'metric');
                    let healthCategory = determineHealthCategory(bmi);
                    container.querySelector('.protein-calculator--bmi-results__value .the-result').innerHTML = bmi.toFixed(1);
                } else if ('imperial' === bmiState.system  && weight) {
                    // Imperial system calculation (height in feet and inches, weight in pounds)
                    if (heightFeet) {
                        heightInInches = heightFeet * 12; // Convert feet to inches
                    }
                    if (heightInches) {
                        heightInInches += heightInches; // Add the inches
                    }

                    if (heightInInches) {
                        let bmi = calculateBMI(heightInInches, weight, 'imperial');
                        let healthCategory = determineHealthCategory(bmi);
                        container.querySelector('.protein-calculator--bmi-results__value .the-result').innerHTML = bmi.toFixed(1);
                    }
                }
            });
        });
    }
}

const convert_height_to_metric = ($feet, $inches) => {

}

(function() {
    initBmiCalculator()
    twwc_initBMIWeightToggles();
})();