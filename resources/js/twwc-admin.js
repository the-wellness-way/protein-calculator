const calcData = {
    system: window.twwc_admin_object?.protein_settings?.system ?? 'imperial',
    weight: '',
    pregnant: 'No',
    activeLevel: '',
    goal: ''
};

const setCalcData = (key, value) => {
  if (calcData.hasOwnProperty(key)) {
      calcData[key] = value;
  }
};

const ui = {
    system: document.querySelectorAll('.protein-calculator__units-measurement'),
    weight: document.querySelector('.protein-calculator__weight'),
    metricInputs: document.querySelectorAll('.protein-calculator__metric-input'),
    imperialInputs: document.querySelectorAll('.protein-calculator__imperial-input'),
};

const initSystem = () => {
    ui.system.forEach(system => {
        system.addEventListener('click', (e) => {
            setCalcData('system', e.target.value);
            convertToSystem();
        });
    });

    convertToSystem(); // Run on initialization to set up correct state
};

const convertToSystem = () => {
    const useMetric = calcData.system === 'metric';
    ui.metricInputs.forEach(input => input.disabled = !useMetric);
    ui.imperialInputs.forEach(input => input.disabled = useMetric);
};

//add class twwc_embed_shortcode-clicked to twwc_embed_shortcode when clicked
const initclickToCopyToClipboard = () => {
    const copyText = document.getElementById('embed-shortcode');

    if(copyText) {
        copyText.addEventListener('click', (e) => {
          copyText.classList.add('twwc_embed_shortcode-clicked');
          //then set timeout of 2 seconds to remove it
          setTimeout(() => {
              copyText.classList.remove('twwc_embed_shortcode-clicked');
          }, 2000);

          //now copy to clipboard embed-shortcode data-clipboard-text to clipboard
          //[twwc_protein_calculator]
          const el = document.createElement('textarea');
          el.value = copyText.getAttribute('data-clipboard-text');
          el.style.position = 'absolute';
          el.style.opacity = '0';
          document.body.appendChild(el);
          el.select();
          document.execCommand('copy');
          document.body.removeChild(el);
      });
    }
};

(function() {
    if (ui.system.length > 0) {
        initSystem();
    }

    initclickToCopyToClipboard(); // Uncomment or define initclickToCopyToClipboard as needed.
    //initCalculation(); // Uncomment or define initCalculation as needed.
})();

const Defaults = {
    "settings": [],
    "protein_settings": {
      "system": "metric",
      "pregnant": "10",
      "pregnant_lactating": "14",
      "defaults": {
        "activity_level": "sedentary"
      },
      "content": [],
      "multiplier_weight_kg": "1.3",
      "multiplier_weight_lbs": 0.59,
      "multiplier_weight_high_kg": "1.5",
      "multiplier_weight_high_lbs": 0.68,
      "activity_level": {
        "sedentary": {
          "label": "Sedentary Label Test",
          "enable": "1",
          "m_sedentary_kg": "1.2",
          "m_sedentary_lbs": 0.54,
          "m_sedentary_high_kg": "1.45",
          "m_sedentary_high_lbs": 0.66,
          "goal": {
            "m_maintain_kg": "1.3",
            "m_maintain_lbs": 0.59,
            "m_toning_kg": "1.4",
            "m_toning_lbs": 0.64,
            "m_muscle_growth_kg": "1.5",
            "m_muscle_growth_lbs": 0.68,
            "m_weight_loss_kg": "1.2",
            "m_weight_loss_lbs": 0.54,
            "m_maintain_high_kg": "1.55",
            "m_maintain_high_lbs": 0.7,
            "m_toning_high_kg": "1.65",
            "m_toning_high_lbs": 0.75,
            "m_muscle_growth_high_kg": "1.75",
            "m_muscle_growth_high_lbs": 0.79,
            "m_weight_loss_high_kg": "1.35",
            "m_weight_loss_high_lbs": 0.61
          }
        },
        "lightly_active": {
          "label": "lightly_active Label Test",
          "enable": "1",
          "m_lightly_active_kg": "1.4",
          "m_lightly_active_lbs": 0.64,
          "m_lightly_active_high_kg": "1.76",
          "m_lightly_active_high_lbs": 0.8,
          "goal": {
            "m_maintain_kg": "1.4",
            "m_maintain_lbs": 0.64,
            "m_toning_kg": "1.5",
            "m_toning_lbs": 0.68,
            "m_muscle_growth_kg": "1.6",
            "m_muscle_growth_lbs": 0.73,
            "m_weight_loss_kg": "1.2",
            "m_weight_loss_lbs": 0.54,
            "m_maintain_high_kg": "1.77",
            "m_maintain_high_lbs": 0.8,
            "m_toning_high_kg": "1.85",
            "m_toning_high_lbs": 0.84,
            "m_muscle_growth_high_kg": "1.9",
            "m_muscle_growth_high_lbs": 0.86,
            "m_weight_loss_high_kg": "1.45",
            "m_weight_loss_high_lbs": 0.66
          }
        },
        "moderately_active": {
          "label": "moderately_active Label Test",
          "enable": 0,
          "m_moderately_active_kg": "1.5",
          "m_moderately_active_lbs": 0.68,
          "m_moderately_active_high_kg": "1.65",
          "m_moderately_active_high_lbs": 0.75,
          "goal": {
            "m_maintain_kg": "1.5",
            "m_maintain_lbs": 0.68,
            "m_toning_kg": "1.6",
            "m_toning_lbs": 0.73,
            "m_muscle_growth_kg": "1.8",
            "m_muscle_growth_lbs": 0.82,
            "m_weight_loss_kg": "1.2",
            "m_weight_loss_lbs": 0.54,
            "m_maintain_high_kg": "1.65",
            "m_maintain_high_lbs": 0.75,
            "m_toning_high_kg": "1.75",
            "m_toning_high_lbs": 0.79,
            "m_muscle_growth_high_kg": "2.0",
            "m_muscle_growth_high_lbs": 0.91,
            "m_weight_loss_high_kg": "1.55",
            "m_weight_loss_high_lbs": 0.7
          }
        },
        "very_active": {
          "label": "very_active Label Test",
          "enable": 0,
          "m_very_active_kg": "1.8",
          "m_very_active_lbs": 0.82,
          "m_very_active_high_kg": "1.95",
          "m_very_active_high_lbs": 0.88,
          "goal": {
            "m_maintain_kg": "1.8",
            "m_maintain_lbs": 0.82,
            "m_toning_kg": "1.9",
            "m_toning_lbs": 0.86,
            "m_muscle_growth_kg": "2.0",
            "m_muscle_growth_lbs": 0.91,
            "m_weight_loss_kg": "1.3",
            "m_weight_loss_lbs": 0.59,
            "m_maintain_high_kg": "2.0",
            "m_maintain_high_lbs": 0.91,
            "m_toning_high_kg": "2.1",
            "m_toning_high_lbs": 0.95,
            "m_muscle_growth_high_kg": "2.25",
            "m_muscle_growth_high_lbs": 1.02,
            "m_weight_loss_high_kg": "1.65",
            "m_weight_loss_high_lbs": 0.75
          }
        },
        "super_active": {
          "label": "super_active Label Test",
          "enable": 0,
          "m_super_active_kg": "2.0",
          "m_super_active_lbs": 0.91,
          "m_super_active_high_kg": "2.25",
          "m_super_active_high_lbs": 1.02,
          "goal": {
            "m_maintain_kg": "2.0",
            "m_maintain_lbs": 0.91,
            "m_toning_kg": "2.25",
            "m_toning_lbs": 1.02,
            "m_muscle_growth_kg": "2.5",
            "m_muscle_growth_lbs": 1.13,
            "m_weight_loss_kg": "1.4",
            "m_weight_loss_lbs": 0.64,
            "m_maintain_high_kg": "2.25",
            "m_maintain_high_lbs": 1.02,
            "m_toning_high_kg": "2.65",
            "m_toning_high_lbs": 1.2,
            "m_muscle_growth_high_kg": "2.75",
            "m_muscle_growth_high_lbs": 1.25,
            "m_weight_loss_high_kg": "1.75",
            "m_weight_loss_high_lbs": 0.79
          }
        }
      }
    }
  }

  //onclick we want to populate the default values for the protein calculator. Each input has a name that corresponds to the key in the calcData object. For example twwc__protein_settings[activity_level][sedentary][goal][m_maintain_kg] would be a name of the input but not the key in the calcData object. The key in the calcData object would depend on the name of the input. So we need to get the name of the input and then get the value from the calcData object that corresponds to that key. Then we set the value of the input to the value from the calcData object.

  const defaultButton = document.querySelector('.protein-calculator__default');

  const populateDefaults = () => {
    const inputs = document.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        const name = input.getAttribute('name');
        let key = name.replace('twwc__protein_settings', '');

        // this will give us key like [activity_level][very_active][goal][m_muscle_growth_high_lbs] in string format. We need to convert it to an array so we can access the value from the calcData object.
        key = key.split('[').join('.').split(']').join('').split('.').filter(Boolean);

        // now we need to get the value from the calcData object that corresponds to the key
        let value = Defaults.protein_settings;
        key.forEach(k => {
            value = value[k];
        });

        // now we set the value of the input to the value from the calcData object
        input.value = value;
    });
  }

  // now we want a clear button that will clear all the inputs
  const clearButton = document.querySelector('.protein-calculator__clear');

  const initClearButton = () => {
    clearButton.addEventListener('click', (e) => {
        e.preventDefault();
        const inputs = document.querySelectorAll('input[type="number"]');
        inputs.forEach(input => {
            input.value = '';
        });
    });
  }

  const initButton = () => {
    if (defaultButton) {
      defaultButton.addEventListener('click', (e) => {
          e.preventDefault();
          populateDefaults();
      });
    }
  }

(function() {
    if(defaultButton) {
        initButton();
    }

    if(clearButton) {
        initClearButton();
    }
})();


jQuery(document).ready(function($){
  $('.twwc-plugin-colors').wpColorPicker();
});