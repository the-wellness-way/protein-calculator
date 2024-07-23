const foodItemsCalcData = [
    {
        id: 1,
        title: 'Grass-Fed Ground Beef',
        key: 'grass-fed-ground-beef',
        unitType: 'oz',
        unitPer40grams: '6'
    },
    {
        id: 2,
        title: 'Grass-Fed Beef Liver',
        key: 'grass-fed-beef-liver',
        unitType: 'oz',
        unitPer40grams: '6.5'
    },
    {
        id: 3,
        title: 'Grass-Fed Lamb',
        key: 'grass-fed-lamb',
        unitType: 'oz',
        unitPer40grams: '5.5'
    },
    {
        id: 4,
        title: 'Pasture Raised Chicken Eggs',
        key: 'pasture-raised-chicken-eggs',
        unitType: 'eggs',
        unitPer40grams: '6'
    },
    {
        id: 5,
        title: 'Chickpeas',
        key: 'chickpeas',
        unitType: 'cups',
        unitPer40grams: '3'
    },
    {
        id: 6,
        title: 'Grass-Fed Whole Milk Kefir',
        key: 'grass-fed-whole-milk-kefir',
        unitType: 'cups',
        unitPer40grams: '4'
    },
    {
        id: 7,
        title: 'Fermented Cow Cheeses',
        key: 'fermented-cow-cheeses',
        unitType: 'cups',
        unitPer40grams: '2.75'
    },
    {
        id: 8,
        title: 'Pasture-Raised Chicken Breast',
        key: 'pasture-raised-chicken-breast',
        unitType: 'oz',
        unitPer40grams: '4.5'
    },
    {
        id: 9,
        title: 'Wild-Caught Salmon',
        key: 'wild-caught-salmon',
        unitType: 'oz',
        unitPer40grams: '5.5'
    },
    {
        id: 10,
        title: 'Pasture-Raised Turkey',
        key: 'pasture-raised-turkey',
        unitType: 'oz',
        unitPer40grams: '5.5'
    },
    {
        id: 11,
        title: 'Duck Eggs',
        key: 'duck-eggs',
        unitType: 'eggs',
        unitPer40grams: '4.5'
    },
    {
        id: 12,
        title: 'Black Beans',
        key: 'black-beans',
        unitType: 'cups',
        unitPer40grams: '2.5'
    },
    {
        id: 13,
        title: 'Plain Goat Milk Yogurt',
        key: 'plain-goat-milk-yogurt',
        unitType: 'cups',
        unitPer40grams: '5'
    },
    {
        id: 14,
        title: 'Goat Cheese',
        key: 'goat-cheese',
        unitType: 'oz',
        unitPer40grams: '8'
    },
    {
        id: 15,
        title: 'Grass-Fed Steak',
        key: 'grass-fed-steak',
        unitType: 'oz',
        unitPer40grams: '5.5'
    },
    {
        id: 16,
        title: 'Grass-Fed Venison',
        key: 'grass-fed-venison',
        unitType: 'oz',
        unitPer40grams: '4.5'
    },
    {
        id: 17,
        title: 'TWW Bone Broth Protein Powder',
        key: 'tww-bone-broth-protein-powder',
        unitType: 'scoops',
        unitPer40grams: '2'
    },
    {
        id: 18,
        title: 'Lentils',
        key: 'lentils',
        unitType: 'cups',
        unitPer40grams: '2.5'
    },
    {
        id: 19,
        title: 'Pinto Beans',
        key: 'pinto-beans',
        unitType: 'cups',
        unitPer40grams: '2.5'
    },
    {
        id: 20,
        title: 'Grass-Fed Whole Milk Yogurt',
        key: 'grass-fed-whole-milk-yogurt',
        unitType: 'cups',
        unitPer40grams: '4.5'
    },
    {
        id: 21,
        title: 'Sheep Cheese (Manchengo)',
        key: 'sheep-cheese-manchengo',
        unitType: 'cups',
        unitPer40grams: '2.5'
    }
];

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

    if (containers.length) {
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
