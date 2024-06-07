const twwc_ui_two = {
    weight: document.getElementById('weight'),
    weightToggles: document.querySelectorAll('.weight-toggle'),
}

const twwc_weightToggles = () => {
    twwc_ui_two.weightToggles.forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            let system = e.target.value;

            if(system === 'imperial') {
                document.getElementById('weight_lbs').classList.remove('hide');
            } else {            
                document.getElementById('weight_kg').classList.remove('hide');
            }
        });
    });
}
