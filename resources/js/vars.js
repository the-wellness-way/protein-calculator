calcData = {
    defaultSystem: window.twwc_object.system ?? 'metric',
    pregnant: document.querySelector('.protein-calculator__pregnant:checked') && document.querySelector('.protein-calculator__pregnant:checked').value ? document.querySelector('.protein-calculator__pregnant:checked').value : 'No',
    goal: '',
}

setCalcData = (key, value) => {
    calcData[key] = value;
}
