const foodItemsCalcData = window.twwc__fitems ?? null;

const twwcFitems = {
    unitType: document.querySelector('.food-items__unit-type'),
    grams: document.querySelector('.food-items__grams input'),
};

const twwcFItemsState = {
    selectFoodItem: '',
    matchedItem: ''
}

const twwcFItemsSetState = (key, value) => {
    twwcFItemsState[key] = value;
}

const twwcFitemsGenerateUnitValue = (unitper40, gramsValue) => {
    let newAmount = (gramsValue * unitper40) / 40;
    return newAmount;
}

const twwcFitemsGenerateGramsValue = (unitPer40, amountValue) => {
    let newGrams = (40 * amountValue) / unitPer40;
    return newGrams;
}

const initFoodItemsCalculator = () => {
    const containers = document.querySelectorAll('.food-items-container');

    if (containers.length && foodItemsCalcData) {
        containers.forEach(container => {
            twwcFItemsSetState('selectFoodItem', container.querySelector('.food-items__items'))
            twwcFItemsSetState('amountInput', container.querySelector('.food-items__amount input'))
            twwcFItemsSetState('gramsInput', container.querySelector('.food-items__grams input'))
            twwcFItemsSetState('unitTypeHTML', container.querySelector('.food-items__unit-type-text'))
            twwcFItemsSetState('matchedItem', foodItemsCalcData.find(item => item.key === twwcFItemsState.selectFoodItem.value))

            if (twwcFItemsState.selectFoodItem && twwcFItemsState.amountInput && twwcFItemsState.gramsInput && twwcFItemsState.unitTypeHTML) {
                twwcFItemsState.selectFoodItem.addEventListener('change', (e) => {
                    const selectedValue = e.target.value;
                    twwcFItemsSetState('matchedItem', foodItemsCalcData.find(item => item.key === selectedValue))

                    let gramsValue = parseFloat(twwcFItemsState.gramsInput.value).toFixed(1);

                    const newUnitValue = twwcFitemsGenerateUnitValue(twwcFItemsState.matchedItem.unitPer40grams, gramsValue);
                    twwcFItemsState.unitTypeHTML.innerHTML = twwcFItemsState.matchedItem.unitType

                    twwcFItemsState.amountInput.value = parseFloat(newUnitValue).toFixed(1);
                });

                twwcFItemsState.amountInput.addEventListener('change', (e) => {
                    twwcFItemsState.gramsInput.value = parseFloat(twwcFitemsGenerateGramsValue(twwcFItemsState.matchedItem.unitPer40grams, twwcFItemsState.amountInput.value)).toFixed(1);
                });

                twwcFItemsState.gramsInput.addEventListener('change', (e) => {
                    twwcFItemsState.amountInput.value = parseFloat(twwcFitemsGenerateUnitValue(twwcFItemsState.matchedItem.unitPer40grams, twwcFItemsState.gramsInput.value)).toFixed(1);
                });
            }
        });
    }
}

const changeUnitType = (selectedValue) => {
    const unitType = twwcFitems.unitType;
    const matchedItem = foodItemsCalcData.find(item => item.key === selectedValue);

    if (matchedItem) {
        unitType.innerHTML = matchedItem.unitType;
    } else {
        unitType.innerHTML = ''; // Clear the unit type if no match is found
    }
};

const calculate = (value) => {
    return value * 2;
};

(function () {
    initFoodItemsCalculator();
})();
