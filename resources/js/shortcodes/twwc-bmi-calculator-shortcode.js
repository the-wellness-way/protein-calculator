const bmiState = {
    system: window.twwc_object?.protein_settings?.system ?? 'imperial',
}

const setSystem = () => {
    let system = window.twwc_object?.settings?.system ?? 'imperial';
}

const weightHealth = [
    { maxBmi: 18.5, health: 'Underweight' },
    { maxBmi: 24.9, health: 'Normal' },
    { maxBmi: 29.9, health: 'Overweight' },
    { maxBmi: 34.9, health: 'Obese' },
    { maxBmi: 39.9, health: 'Severely Obese' },
    { maxBmi: Infinity, health: 'Morbidly Obese' }
];

const calculateBMI = (heightInInches, weight) => {
    return (weight / (heightInInches * heightInInches)) * 703;
};

const determineHealthCategory = (bmi) => {
    for (const category of weightHealth) {
        if (bmi <= category.maxBmi) {
            return category.health;
        }
    }

    return 'Unknown';
};

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
                let weight = container.querySelector('.protein-calculator__weight').value;

                if(heightFeet) {
                    heightInInches = heightFeet * feetToInches;
                    console.log(heightInInches);
                }

                if(heightInches) {
                    heightInInches = heightInInches + heightInches;
                }

                if(heightInInches && weight) {
                    let bmi = calculateBMI(heightInInches, weight);
                    let healthCategory = determineHealthCategory(bmi);

                    container.querySelector('.protein-calculator--bmi-results__value .the-result').innerHTML = bmi.toFixed(1);
                    // container.querySelector('.protein-calculator__health').value = healthCategory;
                }
            });
        });
    }
}

const convert_height_to_metric = ($feet, $inches) => {

}

(function() {
    initBmiCalculator()
})();