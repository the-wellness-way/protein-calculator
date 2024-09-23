const twwc_calcData = {
    system: window.twwc_object?.protein_settings?.system ?? 'imperial',
    useRange: window.twwc_object?.protein_settings?.use_range ?? true,
    weight: '',
    pregnant: 'No',
    activeLevel: '',
    goal: '',
    converting: false,
    defaultSystem: window.twwc_object.system ?? 'metric',
    pregnant: document.querySelector('.protein-calculator__pregnant:checked') && document.querySelector('.protein-calculator__pregnant:checked').value ? document.querySelector('.protein-calculator__pregnant:checked').value : 'No',
};

const twwc_calcSettings = window.twwc_object;

const twwc_ui = {
    proteinForm: document.querySelector('.protein-calculator-form'),
    unitsMeasurement: document.querySelectorAll('.protein-calculator__units-measurement'),
    toggleEls: document.querySelectorAll('.protein-calculator__toggle-units'),
    submitBtn: document.querySelector('.protein-calculator__submit'),
    results: document.querySelector('.protein-calculator--results__value span.the-result'),
    pregnant: document.querySelectorAll('.protein-calculator__pregnant'),
    goals: document.querySelectorAll('.protein-calculator__goal'),
    goal: document.querySelectorAll('.protein-calculator__goal') && document.querySelectorAll('.protein-calculator__goal:checked') ? document.querySelectorAll('.protein-calculator__goal:checked') : null,
    pregnantFields: document.querySelectorAll('.protein-calculator__pregnant-fields'),
    notPregnantFields: document.querySelectorAll('.protein-calculator__not-pregnant-fields'),
    activeLevel: document.querySelector('.protein-calculator__active-level'),
    weight: document.querySelector('.protein-calculator__weight'),
    resultsHighEnd: document.querySelector('.protein-calculator--results__high-end span.the-result-high'),
    
    //Theme Compact
    weightToggles: document.querySelectorAll('.protein-calculator__weight-toggle'),
    goalSelect: document.querySelector('.protein-calculator__goal-select'),
}

const twwc_setCalcData = (key, value) => {
    if (twwc_calcData.hasOwnProperty(key)) {
        twwc_calcData[key] = value;
    }
};

const twwc_initWeightToggles = () => {
    containers = document.querySelector('.protein-calculator-container');
    containers.forEach((container) => {
        //find the weight toggle
        const weightToggle = container.querySelectorAll('.protein-calculator__weight-toggle');

        if(weightToggle) {
            weightToggle.forEach((toggle) => {
                toggle.addEventListener('click', (e) => {
                    let system = e.target.value;

                    // if(system === 'imperial') {
                    //     document.getElementById('weight_lbs').classList.remove('hide');
                    //     document.getElementById('weight_kg').classList.add('hide');
                    // } else {            
                    //     document.getElementById('weight_kg').classList.remove('hide');
                    //     document.getElementById('weight_lbs').classList.add('hide');
                    // }

                    twwc_convertToSystem(system);
                });
            });
        }
    });
}
    
const twwc_initUnitsAndMeasures = () => {
    if(twwc_ui.unitsMeasurement.length === 0) return;
    if(twwc_ui.toggleEls.length === 0) return;
    
    twwc_ui.unitsMeasurement.forEach((unit) => {    
        unit.addEventListener('click', (e) => {          
            twwc_setCalcData('converting', true);
            const system = document.querySelector('.protein-calculator__units-measurement:checked').value;
            twwc_ui.toggleEls.forEach((el) => {
                if(el.classList.contains('hide')) {
                    el.classList.remove('hide');
                } else {
                    el.classList.add('hide');
                }
            });

            twwc_convertToSystem(system);
        });
    });
};

const twwc_convertToSystem = (system) => {
    if(!system) return;

    twwc_setCalcData('converting', true);

    const weight_lbs = document.querySelector('.protein-calculator__weight--lbs').value;
    const weight_kg = document.querySelector('.protein-calculator__weight--kg').value;
    let value = '';
    
    //now we need to convert the value in weight to the selected system
    if('metric' === system) {
        value = Math.round((weight_lbs / 2.20462) * 100) / 100;
        value = 0 === value ? '' : value;
       document.querySelector('.protein-calculator__weight--kg').value = value;
       twwc_setCalcData('converting', false);
    } else if('imperial' === system) {
        value = Math.round((weight_kg * 2.20462) * 100) / 100;
        value = 0 === value ? '' : value;
        document.querySelector('.protein-calculator__weight--lbs').value = value;
        twwc_setCalcData('converting', false);
    }    
}

const twwc_initPregnant = () => {
    if(!twwc_ui.pregnant.length) return;

    twwc_ui.pregnant.forEach((pregnant) => {
        pregnant.addEventListener('click', (e) => {
            twwc_setCalcData('pregnant', e.target.value);

            if('No' === e.target.value) {
                twwc_ui.notPregnantFields.forEach((field) => {
                    field.classList.remove('hide');
                });
            } else {
                twwc_ui.notPregnantFields.forEach((field) => {
                    field.classList.add('hide');
                });
            }
        });
    });
}

const twwc_initGoal = () => {
    if(!twwc_ui.goals.length) return;

    twwc_ui.goals.forEach((goal) => {
        goal.addEventListener('click', (e) => {
            twwc_setCalcData('goal', e.target.value);
        });
    });
}
        
const twwc_initCalculation = () => {
    if(!twwc_ui.proteinForm) return;

    twwc_ui.proteinForm.addEventListener('input', (e) => {
        if(twwc_calcData.converting) return;

        let totalProtein = null;
        let totalProteinHigh = null;

        const system = document.querySelector('.protein-calculator__units-measurement:checked').value;
        const weight = twwc_getWeight(system);
        const pregnant_and_lactating = twwc_calcData.pregnant;
        const activeLevel = twwc_ui.activeLevel.value;

        let goal = '';
        if(weight > 10) {
            if(twwc_ui.goalSelect && twwc_ui.goalSelect.length) {
                goal = twwc_ui.goalSelect.value;
                twwc_setCalcData('goal', goal);
            } else {
                goal = twwc_calcData.goal;
            }
    
            if(system && 'No' !== pregnant_and_lactating) {
                totalProtein = twwc_pregnant(system, weight, pregnant_and_lactating);
            } else if (system && weight) {
                const baseProtein = twwc_basicProteinCalculation(system, weight, activeLevel, goal);
                const baseProteinHigh = twwc_basicProteinCalculationHigh(system, weight, activeLevel, goal);
    
                totalProteinHigh = baseProteinHigh;
                totalProtein = baseProtein;
            }
        } else if(weight === 0 || weight === ''){
            totalProtein = '';
            totalProteinHigh = '';
        } else {
            totalProtein = weight;
            totalProteinHigh = weight;
        }

        totalProtein = parseInt(totalProtein) || '';
        totalProteinHigh = parseInt(totalProteinHigh) || '';

        if(twwc_calcData.useRange) {
            if((undefined !== totalProteinHigh && totalProteinHigh > 0) && (undefined !== totalProtein && totalProtein > 0)) {
                twwc_ui.results.innerHTML = twwc_resultsRange(totalProtein, totalProteinHigh);
            }

            if('' === totalProtein) {
                // we want an m-dash to show that the field is empty
                twwc_ui.results.innerHTML = '&mdash;';
                twwc_ui.resultsHighEnd.innerHTML = '';
            }
        } else {        
            twwc_ui.results.innerHTML = totalProtein;
            twwc_ui.resultsHighEnd.innerHTML = totalProteinHigh;
        }  
    });
}

const twwc_initActiveLevel = () => {
    if(!twwc_ui.activeLevel.length) return;

    twwc_ui.activeLevel.forEach((level) => {
        level.addEventListener('click', (e) => {
            twwc_calcData.activeLevel = e.target.value;
        });
    });
}

const twwc_basicProteinCalculation = (system, weight, activeLevel, goal, multiplier = 1.2) => {
    multiplier = 'imperial' !== system ? parseFloat(twwc_calcSettings?.protein_settings?.multiplier_weight_kg) : parseFloat(twwc_calcSettings?.protein_settings?.multiplier_weight_lbs);
    let prefix = 'm_';
    let suffix = 'imperial' !== system ? '_kg' : '_lbs';
    let goalField = prefix + goal + suffix;

    if (activeLevel) { 
        multiplier = parseFloat(twwc_calcSettings?.protein_settings?.activity_level[activeLevel][prefix + activeLevel + suffix]);
    }

    if(activeLevel && goal && twwc_calcSettings?.protein_settings?.activity_level[activeLevel].goal[goalField] !== undefined) {

        multiplier = parseFloat(twwc_calcSettings?.protein_settings?.activity_level[activeLevel].goal[goalField]);
    }
    
    const value = weight * multiplier;

    return value;
}

const twwc_basicProteinCalculationHigh = (system, weight, activeLevel, goal, multiplier = 1.2) => {
    multiplier_high = 'imperial' !== system ? parseFloat(twwc_calcSettings?.protein_settings?.multiplier_weight_high_kg) : parseFloat(twwc_calcSettings?.protein_settings?.multiplier_weight_high_lbs);
    let prefix = 'm_';
    let suffix = 'imperial' !== system ? '_high_kg' : '_high_lbs';
    let goalFieldHighEnd = prefix + goal + suffix;

    if(activeLevel) {
        multiplier_high = parseFloat(twwc_calcSettings?.protein_settings?.activity_level[activeLevel][prefix + activeLevel + suffix]);
    }

   if(activeLevel &&  goal && twwc_calcSettings?.protein_settings?.activity_level[activeLevel].goal[goalFieldHighEnd] !== undefined) {
        multiplier_high = parseFloat(twwc_calcSettings?.protein_settings?.activity_level[activeLevel].goal[goalFieldHighEnd]);
    } else {
        //remove _high from the goal field
        goalField = goalFieldHighEnd.replace('_high', '');
        if(activeLevel && goal && twwc_calcSettings?.protein_settings?.activity_level[activeLevel].goal[goalField] !== undefined) {
            multiplier_high = 0;
        }
    }

    const value = weight * multiplier_high;

    return value;
}

const twwc_pregnant = (system, weight, pregnant_and_lactating) => {
    if(!weight) return;

    const multiplier = 'imperial' !== system ? parseFloat(twwc_calcSettings?.protein_settings?.multiplier_weight_kg) : parseFloat(twwc_calcSettings?.protein_settings?.multiplier_weight_lbs);
    let baseProtein = weight * multiplier; 

    if ('I am pregnant' === pregnant_and_lactating) {
        // Ensure we add numbers, not strings
        const pregnantValue = parseFloat(twwc_calcSettings?.protein_settings?.pregnant);
        baseProtein += pregnantValue; // Perform addition before formatting
    }

    if('I am nursing' === pregnant_and_lactating) {
        // Ensure we add numbers, not strings
        const nursingValue = parseFloat(twwc_calcSettings?.protein_settings?.pregnant_lactating);
        baseProtein += nursingValue; // Perform addition before formatting
    }

    // If you need to output baseProtein elsewhere with 3 decimal places
   return baseProtein;
}

const twwc_getWeight = (system) => {
    if('metric' === system) {
        return document.querySelector('.protein-calculator__weight--kg').value;
    } else if('imperial' === system) {
        return document.querySelector('.protein-calculator__weight--lbs').value;
    }
}

const twwc_getHeight = (system) => {
    if('metric' === system) {
        return document.querySelector('.protein-calculator__height--cm').value;
    } else if('imperial' === system) {        
        return height.feet * 12 + height.inches;
    }
}

const twwc_resultsRange = (results, resultsHighEnd) => {
    if(results && resultsHighEnd) {
        return results + ' - ' + resultsHighEnd;
    }
}

// Initialize the calculator
(function () { 
    twwc_initUnitsAndMeasures();
    twwc_initPregnant();
    twwc_initGoal();
    twwc_initCalculation();
    twwc_initWeightToggles();
})();
