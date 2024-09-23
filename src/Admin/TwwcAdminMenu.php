<?php
namespace TwwcProtein\Admin;

use TwwcProtein\Includes\TwwcView;
use TwwcProtein\Options\TwwcOptions;
use TwwcProtein\Admin\TwwcBeans;

class TwwcAdminMenu {
    const PAGE_IDENTIFIER = 'twwc-protein';

    const PAGE_IDENTIFIER_PROTEIN = 'twwc-protein-calculator';

    const PAGE_TEMPLATE = 'dashboard';

    const COMMON_SETTINGS_PAGE = 'twwc-common-settings';

    const PROTEIN_CALCULATOR_SETTINGS_PAGE = 'twwc-protein-calculator-settings';

    private $option_group = 'settings';

    private $option_name = 'settings';

    private $option_group_protein = 'protein_settings';

    private $option_name_protein = 'protein_settings';

    private $prefix;

    private $settings = [];

    private $protein_settings = [];

    private $protein_settings_input = [];

    private $activity_levels = [
        'Sedentary',
        'Lightly Active',
        'Moderately Active',
        'Very Active',
        'Super Active',
    ];

    private $goals = [
        'maintain',
        'toning',
        'muscle_growth',
        'weight_loss'
    ];

    public function __construct() {
        $settings = TwwcOptions::get_option($this->option_name, []);

        $this->prefix = TwwcOptions::PREFIX;
        $this->settings = $settings ?? [];

        $protein_settings = TwwcOptions::get_option($this->option_name_protein, []);
        $this->protein_settings = $protein_settings ?? [];

        $this->option_group = $this->prefix . $this->option_group;
        $this->option_name  = $this->prefix . $this->option_name;

        $this->option_group_protein = $this->prefix . $this->option_group_protein;
        $this->option_name_protein  = $this->prefix . $this->option_name_protein;
    }

    public function register_hooks(): void {
        add_action('admin_menu', [$this, 'register_pages']);
        add_action('admin_init', [$this, 'register_common_settings']);
    }

    public function register_pages(): void {
        $manage_capability = $this->get_manage_capability();
        $page_identifier = $this->get_page_identifier();

        $menu = add_menu_page(
            'TWW Calculator: ' . __('Dashboard', 'twwc-protein'),
            'TWW Calculator',
            $manage_capability,
            $page_identifier,
            [$this, 'show_page'],
            'dashicons-heart',
            98
        );

        $submenu = add_submenu_page(
            $page_identifier,
            'TWW Calculator: ' . __('Settings', 'twwc-protein'),
            __('Settings', 'twwc-protein'),
            $manage_capability,
            self::COMMON_SETTINGS_PAGE,
            [$this, 'show_page'],
            1
        );

        $anotherSubmenu = add_submenu_page(
            $page_identifier,
            'TWW Calculator: ' . __('Protein Calculator', 'twwc-protein'),
            __('Protein Calculator', 'twwc-protein'),
            $manage_capability,
            self::PROTEIN_CALCULATOR_SETTINGS_PAGE,
            [$this, 'show_page'],
            2
        );

        add_action( 'load-' . $menu, [$this, 'do_admin_enqueue'] );
        add_action( 'load-' . $submenu, [$this, 'do_admin_enqueue'] );
        add_action( 'load-' . $anotherSubmenu, [$this, 'do_admin_enqueue'] );
    }

    public function do_admin_enqueue(): void {
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_scripts'] );
    }

    public function enqueue_admin_scripts(): void {
        wp_enqueue_style('wp-color-picker');

        $version = '1.32.5';

        wp_enqueue_style('twwc-admin-css', TWWC_PROTEIN_PLUGIN_URL . 'resources/css/twwc-admin.css', [], $version, 'all' );
        wp_enqueue_script('twwc-admin-js', TWWC_PROTEIN_PLUGIN_URL . 'resources/js/twwc-admin.js', array( 'wp-color-picker' ), $version, true );

        wp_localize_script('twwc-admin-js', 'twwc_admin_object', [
            'settings' => $this->settings,
            'protein_settings' => $this->protein_settings,
        ]);
    }

    public function register_common_settings(): void {
        /**
         * Overall settings
         */
        add_settings_section(
            'twwc-common-settings-section',
            __('TWWC Settings', 'twwc-protein'),
            null,
            self::COMMON_SETTINGS_PAGE,
            []
        );

        add_settings_field(
            'twwc-theme_options',
            '<span class="required">*</span> '. __('Default Theme', 'twwc-protein'),
            [$this, 'default_theme_callback'],
            self::COMMON_SETTINGS_PAGE,
            'twwc-common-settings-section',
            []
        );

        add_settings_field(
            'twwc-plugin_colors',
            '<span class="required">*</span> '. __('Plugin Colors', 'twwc-protein'),
            [$this, 'plugin_colors_callback'],
            self::COMMON_SETTINGS_PAGE,
            'twwc-common-settings-section',
            []
        );

        /**
         * Protein Calculator Settings
         */
        add_settings_section(
            'twwc-protein-calculator-settings-section',
            __('TWWC Settings', 'twwc-protein'),
            [$this, 'protein_calculator_settings_output'],
            self::PROTEIN_CALCULATOR_SETTINGS_PAGE,
            []
        ); 
        
        add_settings_field(
            'twwc-system',
            '<span class="required">*</span> '. __('Default Units & Measurement', 'twwc-protein'),
            [$this, 'default_system_callback'],
            self::PROTEIN_CALCULATOR_SETTINGS_PAGE,
            'twwc-protein-calculator-settings-section',
            []
        );

        add_settings_field(
            'twwc-header',
            __('Header', 'twwc-protein'),
            [$this, 'header_callback'],
            self::PROTEIN_CALCULATOR_SETTINGS_PAGE,
            'twwc-protein-calculator-settings-section',
            []
        );

        add_settings_field(
            'twwc-weight',
            '<span class="required">*</span> '. __('Weight', 'twwc-protein'),
            [$this, 'weight_callback'],
            self::PROTEIN_CALCULATOR_SETTINGS_PAGE,
            'twwc-protein-calculator-settings-section',
            []
        );

        add_settings_field(
            'twwc-pregnant',
            '<span class="required">*</span> '. __('Pregnant/Lactating', 'twwc-protein'),
            [$this, 'pregnant_callback'],
            self::PROTEIN_CALCULATOR_SETTINGS_PAGE,
            'twwc-protein-calculator-settings-section',
            []
        );

        add_settings_field(
            'twwc-activity_level',
            '<span class="required">*</span> '. __('Activity Level', 'twwc-protein'),
            [$this, 'activity_level_callback'],
            self::PROTEIN_CALCULATOR_SETTINGS_PAGE,
            'twwc-protein-calculator-settings-section',
            []
        );

        register_setting('twwc-common-settings-options', $this->option_group, [$this, 'validate_common_settings']);
        register_setting('twwc-protein-calculator-options', $this->option_group_protein, [$this, 'convert_and_update_options']);
    }

    public function validate_common_settings($input): array {
        $valid_input = [];
        
        // foreach(TwwcBeans::$settings_keys_strings as $key => $value) {
        //     if('plugin_color' === $key) {
        //         foreach($value as $field_key => $default) {
        //             $value = $input[$key][$field_key] ?? $default;
        //             $valid_input[$key][$field_key] = $this->generate_value_string($value, $default);
        //         }
        //     }
        // }

        return $input;
    }

    public function generate_value_string($value, $default = ''): string {
        return $value && is_string($value) ? $value : $default;
    }

    public function generate_value_float($value): mixed {
        $value = (float) $value;
        
        return $value && 0.0 !== $value ? $value : null;
    }

    public function generate_value_array($value, $default = []): array {
        return isset($value) && is_array($value) ? $value : $default;
    }

    public function generate_valid_goal_values(array $goals = [], string $activity_level = ''): array {
        $goal_input = [];
    
        if (!$this->protein_settings_input) {
            return $goal_input;
        }
    
        $system = $this->protein_settings_input['system'];
        $main_unit  = 'imperial' === $system ? 'lbs' : 'kg';
        $mirror_unit = 'imperial' === $system ? 'kg' : 'lbs';
        $callback = 'convert_multiplier_to_' . $mirror_unit . '_value';
    
        if ($goals && $activity_level && isset($this->protein_settings_input['activity_level'])) {
            foreach ($goals as $goal_key => $default) {
                $goal_value = $this->protein_settings_input['activity_level'][$activity_level]['goal'][$goal_key] ?? $default;
    
                if (false === strpos($goal_key, $mirror_unit)) {
                    $goal_input[$goal_key] = $this->generate_value_float($goal_value) ?? $default;
                } else {
                    $goal_key_main_unit = str_replace($mirror_unit, $main_unit, $goal_key);
    
                    $value_to_convert = $this->protein_settings_input['activity_level'][$activity_level]['goal'][$goal_key_main_unit] ?? $default;
                    $value = call_user_func([$this, $callback], $value_to_convert);
                    $goal_input[$goal_key] = $this->generate_value_float($value) ?? $default;
                }
            }
        }
        
        return $goal_input;
    }

    public function convert_and_update_options(array $input): array {
        $this->set_protein_settings_input($input); 

        //So we don't have to do too many 'isset' checks
        $valid_input = array_merge($this->get_protein_settings(), $input);

    
        $system = isset($input['system']) && is_string($input['system']) ? $input['system'] : 'imperial';
        $valid_input['system'] = $system;

        foreach (TwwcBeans::$protein_keys_activity_levels_strings as $key => $fields) {
            foreach ($fields as $field_key => $default) {
                $value = $input['activity_level'][$key][$field_key] ?? '';
                $valid_input['activity_level'][$key][$field_key] = $this->generate_value_string($value, $default);
            }
        }
    
        foreach (TwwcBeans::$protein_keys_ints as $key => $default) {
            $valid_input[$key] = $this->generate_value_float($input[$key]) ?? $default;
        }
    
        foreach (TwwcBeans::$protein_keys_arrays as $key => $default) {
            $value =  $input[$key] ?? $default;
            $valid_input[$key] = $this->generate_value_array($value, $default);
        }
    
        if ('imperial' === $system) {
            foreach (TwwcBeans::$protein_keys_weight_ints as $key => $default) {
                $value = $input[$key] ?? $default;
                if (false === strpos($key, 'kg')) {
                    $valid_input[$key] = $this->generate_value_float($value) ?? $default;
                } else {
                    $key_lbs = str_replace('kg', 'lbs', $key);
                    $value = $this->convert_multiplier_to_kg_value($valid_input[$key_lbs]);
                    $valid_input[$key] = $this->generate_value_float($value) ?? $default;
                }
            }
    
            foreach (TwwcBeans::$protein_keys_activity_levels_ints as $activity_level => $fields) {
                $this->activity_level = $activity_level;

                foreach ($fields as $key => $maybe_default) {
                    if ('enable' === $key) {
                        $value = $input['activity_level'][$activity_level]['enable'] ?? 0;
                        $valid_input['activity_level'][$activity_level]['enable'] = (int) $value ?? $maybe_default;

                        continue;
                    }
    
                    if ('goal' === $key && is_array($maybe_default)) {
                        // $maybe_default is an array that contains the goals in this case, and therefore obviously not the default value
                        $valid_input['activity_level'][$activity_level]['goal'] = $this->generate_valid_goal_values($maybe_default, $activity_level);
                    } else { // example key here: m_super_active_lbs
                        $value = $input['activity_level'][$activity_level][$key] ?? $maybe_default;

                        if (false === strpos($key, 'kg')) {
                            $valid_input['activity_level'][$activity_level][$key] = $this->generate_value_float($value) ?? $maybe_default;
                        } else {
                            $key_lbs = str_replace('kg', 'lbs', $key);
                            $value = $this->convert_multiplier_to_kg_value($valid_input['activity_level'][$activity_level][$key_lbs]);

                            $valid_input['activity_level'][$activity_level][$key] = $this->generate_value_float($value) ?? $maybe_default;
                        }
                    }
                }
            }
        } else { // metric system
            foreach (TwwcBeans::$protein_keys_weight_ints as $key => $default) {
                $value = $input[$key] ?? $default;

                if (false === strpos($key, 'lbs')) {
                    $valid_input[$key] = $this->generate_value_float($value) ?? $default;
                } else {
                    $key_kg = str_replace('lbs', 'kg', $key);
                    $value = $this->convert_multiplier_to_lbs_value($valid_input[$key_kg]);
                    $valid_input[$key] = $this->generate_value_float($value) ?? $default;
                }
            }
    
            foreach (TwwcBeans::$protein_keys_activity_levels_ints as $activity_level => $fields) {
                foreach ($fields as $key => $maybe_default) {
                    if ('enable' === $key) {
                        $value = $input['activity_level'][$activity_level]['enable'] ?? 0;
                        $valid_input['activity_level'][$activity_level]['enable'] = $value;
                        
                        continue;
                    }
    
                    if ('goal' === $key && is_array($maybe_default)) {
                        // $maybe_default is an array that contains the goals in this case, and therefore obviously not the default value
                        $valid_input['activity_level'][$activity_level]['goal'] = $this->generate_valid_goal_values($maybe_default, $activity_level);
                    } else { // example key here: m_super_active_lbs
                        $value = $input['activity_level'][$activity_level][$key] ?? $maybe_default;

                        if (false === strpos($key, 'lbs')) {
                            $valid_input['activity_level'][$activity_level][$key] = $this->generate_value_float($value) ?? $maybe_default;
                        } else {
                            $key_kg = str_replace('lbs', 'kg', $key);

                            $value = $this->convert_multiplier_to_lbs_value($valid_input['activity_level'][$activity_level][$key_kg]);
                            $valid_input['activity_level'][$activity_level][$key] = $this->generate_value_float($value) ?? $maybe_default;
                        }
                    }
                }
            }
        }
    
        return $valid_input;
    }

    public function get_page_identifier(): string
    {
        return self::PAGE_IDENTIFIER;
    }

    public function get_manage_capability(): string
    {
        return 'manage_options';
    }

    public function show_page(): void
    {
        require_once TWWC_PROTEIN_PLUGIN_PATH . 'pages/' . self::PAGE_TEMPLATE . '.php';
    }

    /**
     * Overall Settings
     * 
     * 
     */
    public function default_theme_callback(): void {
        $options = TwwcOptions::get_option($this->option_name);
        $value = isset($options['theme_options']['default']) ? $options['theme_options']['default'] : 'compact';

        echo "
        <div class='default-system'>
            <input id='theme_options_compact' class='protein-calculator__units-measurement' type='radio' name='" . esc_attr($this->option_name) . "[theme_options][default]' value='compact' " . ('compact' === $value ? 'checked' : '') . ">Compact</input>

            <input id='theme_options_large' class='protein-calculator__units-measurement' type='radio' name='" . esc_attr($this->option_name) . "[theme_options][default]' value='large' " . ('large' ===  $value ? 'checked' : '') . ">Large</input>
        </div>
        ";
    }

    public function plugin_colors_callback(): void {
        $options = TwwcOptions::get_option($this->option_name);
        $value = isset($options['theme_options']['plugin_colors']['primary']) && !empty($options['theme_options']['plugin_colors']['primary']) ? $options['theme_options']['plugin_colors']['primary'] : '#E6F1D9';
        $fields_color_value = isset($options['theme_options']['plugin_colors']['fields_color']) && !empty($options['theme_options']['plugin_colors']['fields_color']) ? $options['theme_options']['plugin_colors']['fields_color'] : '#80b741';
        $results_text_color_value = isset($options['theme_options']['plugin_colors']['results_text_color']) && !empty($options['theme_options']['plugin_colors']['results_text_color']) ? $options['theme_options']['plugin_colors']['results_text_color'] : '#000000';

        echo '
            <div class="plugin-colors form-group">
                <label for="plugin-color-primary">Brand Primary</label>
                <input class="twwc-plugin-colors" type="text" name="' . esc_attr($this->option_name) . '[theme_options][plugin_colors][primary]" value="' . esc_attr($value) . '" />
            </div>
            <div class="plugin-colors form-group">
                <label for="plugin-color-fields">Fields Color</label>
                <input class="twwc-plugin-colors" type="text" name="' . esc_attr($this->option_name) . '[theme_options][plugin_colors][fields_color]" value="' . esc_attr($fields_color_value) . '" />
            </div>
            <div class="plugin-colors form-group">
                <label for="plugin-color-fields">Results Text Color</label>
                <input class="twwc-plugin-colors" type="text" name="' . esc_attr($this->option_name) . '[theme_options][plugin_colors][results_text_color]" value="' . esc_attr($results_text_color_value) . '" />
            </div>
        ';
    }

    /*
     * Protein Calculator settings
     *
     *
     *
     */
    public function protein_calculator_settings_output(): void {
        echo '
        <p>Embed shortcode: <span id="embed-shortcode" class="twwc_embed_shortcode" data-clipboard-text="[twwc_protein_calculator]">&lt;/&gt; [twwc_protein_calculator]</span></p>
        <p><a class="protein-calculator__default" target="_blank" href="#">Populate Demo Data</a> - <a class="protein-calculator__clear" target="_blank" href="#">Clear Data</a>';
    }

    public function default_system_callback(): void {
        $options = TwwcOptions::get_option($this->option_name_protein);
        $value = isset($options['system']) ? $options['system'] : 'imperial';
        echo " 
            <div class='default-system'>
                <input class='protein-calculator__units-measurement' type='radio' name='" . esc_attr($this->option_name_protein) . "[system]' value='imperial'" . ('imperial' === $value ? 'checked' : '') . ">Imperial</input> 
                <input class='protein-calculator__units-measurement' type='radio' name='" . esc_attr($this->option_name_protein) . "[system]' value='metric'" . ('metric' ===  $value ? 'checked' : '') . ">Metric</input>
            </div>
        ";
    }

    public function header_callback() {
        $options = TwwcOptions::get_option($this->option_name_protein);
        $value = isset($options['header']) ? $options['header'] : '';
        $header_tag = isset($options['header_tag']) ? $options['header_tag'] : 'h2';
        echo " 
            <div class='protein-calculator__form-group'>
                <p><span>If left blank, the header will not be generated.</span></p>
                <div class='header-cb' style='display: flex;'>
                    <input style='width: 400px;' class='protein-calculator__header' type='text' name='" . esc_attr($this->option_name_protein) . "[header]' value='".$value."' /> 
                    <select name='" . esc_attr($this->option_name_protein) . "[header_tag]'>
                        <option value='h1' " . selected($header_tag, 'h1', false) . ">H1</option>
                        <option value='h2' " . selected($header_tag, 'h2', false) . ">H2</option>
                        <option value='h3' " . selected($header_tag, 'h3', false) . ">H3</option>
                        <option value='h4' " . selected($header_tag, 'h4', false) . ">H4</option>
                        <option value='p' " . selected($header_tag, 'p', false) . ">Paragraph</option>
                    </select>
                </div>
            </div>
        ";
    }

    public function pregnant_callback(): void {
        $settings = TwwcOptions::get_option($this->option_name_protein, []);

        $value = isset($settings['pregnant']) ? $settings['pregnant'] : '';
        $l_value = isset($settings['pregnant_lactating']) ? $settings['pregnant_lactating'] : '';
        echo "
            <div class='pregnant'>
                <div class='protein-calculator__form-group'>
                <span>Add an additional</span>
                <input width='75' class='protein-calculator__pregnant' type='number' name='" . esc_attr($this->option_name_protein) . "[pregnant]' value='".esc_attr($value)."'> <span>grams if pregnant</span>
                </div>
                <div class='protein-calculator__form-group'>
                <span>Add an additional</span>
                <input width='75' class='protein-calculator__pregnant' type='number' name='" . esc_attr($this->option_name_protein) . "[pregnant_lactating]' value='".esc_attr($l_value)."'>
                <span>grams if breastfeeding</span>
                </div>
            </div>
        ";
    }

    public function weight_callback(): void {
        $options = TwwcOptions::get_option($this->option_name_protein);
        
        $value = isset($options['multiplier_weight_lbs']) ? $options['multiplier_weight_lbs'] : '';
        $class = !empty($value) ? 'has-value' : 'required-value-missing-notice';

        echo "
        <div class='protein-calculator__form-group'>
        <input class='protein-calculator__imperial-input' style='width: 100px' class='".esc_attr($class)."' class='protein-calculator__weight' id='weight-lbs' name='".esc_attr($this->option_name_protein)."[multiplier_weight_lbs]' type='number' step='.001' value='" . esc_attr($value) . "' /> <span>g/lb</span>
        ";
    
        $value = isset($options['multiplier_weight_kg']) ? $options['multiplier_weight_kg'] : '';
        $class = !empty($value) ? 'has-value' : 'required-value-missing-notice';

        echo "
        <input class='protein-calculator__metric-input' style='width: 100px' class='".esc_attr($class)."' class='protein-calculator__weight' id='weight-kg' name='".esc_attr($this->option_name_protein)."[multiplier_weight_kg]' type='number' step='.001' value='" . esc_attr($value) . "' /> <span>g/kg</span>";

        //High values
        $value = isset($options['multiplier_weight_high_lbs']) ? $options['multiplier_weight_high_lbs'] : '';
        $class = !empty($value) ? 'has-value' : 'required-value-missing-notice';

        echo "
        <input class='protein-calculator__imperial-input' style='width: 100px' class='".esc_attr($class)."' class='protein-calculator__weight' id='weight-lbs' name='".esc_attr($this->option_name_protein)."[multiplier_weight_high_lbs]' type='number' step='.001' value='" . esc_attr($value) . "' /> <span>g/lb (high)</span>
        ";

        $value = isset($options['multiplier_weight_high_kg']) ? $options['multiplier_weight_high_kg'] : '';
        $class = !empty($value) ? 'has-value' : 'required-value-missing-notice';

        echo "
        <input class='protein-calculator__metric-input' style='width: 100px' class='".esc_attr($class)."' class='protein-calculator__weight' id='weight-kg' name='".esc_attr($this->option_name_protein)."[multiplier_weight_high_kg]' type='number' step='.001' value='" . esc_attr($value) . "' /> <span>g/kg (high)</span>
        </div>
        ";
    }

    public function activity_level_callback(): void {
        $option_name_protein = $this->option_name_protein;
        $options = TwwcOptions::get_option($option_name_protein);

        $class = !empty($value) ? 'has-value' : 'required-value-missing-notice';
        $system = isset($options['system']) ? $options['system'] : 'imperial';

        $activity_level_value = $options['activity_level'] ?? [];

        /// I want to make the following echo a for each loop for the activity levels
        foreach($this->activity_levels as $activity_level) {
            $activity_level = str_replace(' ', '_', strtolower($activity_level));

            $activity_level_label = $activity_level_value[$activity_level]['label'] ?? null;

            //initially enable it
            $activity_level_enabled = isset($activity_level_value[$activity_level]['enable']) ? $activity_level_value[$activity_level]['enable'] : 1;

            $activity_level_default = $options['defaults']['activity_level'] ?? '';

            $activity_level_value_lbs = $activity_level_value[$activity_level]['m_'. $activity_level .'_lbs'] ?? '';
            $activity_level_value_kg = $activity_level_value[$activity_level]['m_'. $activity_level .'_kg'] ?? '';
            $activity_level_value_high_kg = $activity_level_value[$activity_level]['m_'. $activity_level .'_high_kg'] ?? '';
            $activity_level_value_high_lbs = $activity_level_value[$activity_level]['m_'. $activity_level .'_high_lbs'] ?? '';

            $maintain_value_lbs = $activity_level_value[$activity_level]['goal']['m_maintain_lbs'] ?? '';
            $maintain_value_kg = $activity_level_value[$activity_level]['goal']['m_maintain_kg'] ?? '';
            $toning_value_lbs = $activity_level_value[$activity_level]['goal']['m_toning_lbs'] ?? '';
            $toning_value_kg = $activity_level_value[$activity_level]['goal']['m_toning_kg'] ?? '';
            $muscle_growth_value_lbs = $activity_level_value[$activity_level]['goal']['m_muscle_growth_lbs'] ?? '';
            $muscle_growth_value_kg = $activity_level_value[$activity_level]['goal']['m_muscle_growth_kg'] ?? '';
            $weight_loss_value_lbs = $activity_level_value[$activity_level]['goal']['m_weight_loss_lbs'] ?? '';
            $weight_loss_value_kg = $activity_level_value[$activity_level]['goal']['m_weight_loss_kg'] ?? '';

            $maintain_value_high_lbs = $activity_level_value[$activity_level]['goal']['m_maintain_high_lbs'] ?? '';
            $maintain_value_high_kg = $activity_level_value[$activity_level]['goal']['m_maintain_high_kg'] ?? '';
            $toning_value_high_lbs = $activity_level_value[$activity_level]['goal']['m_toning_high_lbs'] ?? '';
            $toning_value_high_kg = $activity_level_value[$activity_level]['goal']['m_toning_high_kg'] ?? '';
            $muscle_growth_value_high_lbs = $activity_level_value[$activity_level]['goal']['m_muscle_growth_high_lbs'] ?? '';
            $muscle_growth_value_high_kg = $activity_level_value[$activity_level]['goal']['m_muscle_growth_high_kg'] ?? '';
            $weight_loss_value_high_lbs = $activity_level_value[$activity_level]['goal']['m_weight_loss_high_lbs'] ?? '';
            $weight_loss_value_high_kg = $activity_level_value[$activity_level]['goal']['m_weight_loss_high_kg'] ?? '';

            echo "
            <div class='protein-calculator__form-group'>
                <div class='protein-calculator__label'>
                    <div class='protein-calculator__enable'>
                        <label for='activity-level'>".esc_html($activity_level)."</label>
                        <input id='enabled-".$activity_level."' class='protein-calculator__activity-level-enable' type='checkbox' name='".esc_attr($this->option_name_protein)."[activity_level][" . esc_attr($activity_level) ."][enable]' value='".$activity_level_enabled."' ".(isset($activity_level_enabled) && 1 == $activity_level_enabled ? 'checked' : '')." /> <span>Enable</span>
                        <input type='radio' name='".esc_attr($this->option_name_protein)."[defaults][activity_level]' value='".esc_html($activity_level)."' ".($activity_level_default == $activity_level ? 'checked' : '')." /> <span>Set as Default</span>
                    </div>
                    <div class='protein-calculator__activity-level-label'>
                        <label>Option Name</label>
                        <input id='acitivity_level_label' class='protein-calculator__activity-level-option-name' style='width: 275px;' width='275' type='text' name='".esc_attr($this->option_name_protein)."[activity_level][" . esc_attr($activity_level) ."][label]' value='".esc_html($activity_level_label)."' />
                    </div>  
                </div>
                <div class='protein-calculator__inputs protein-calculator__inputs--number-small'>
                    <input style='width: 100px' class='".esc_attr($class)." protein-calculator__imperial-input' class='protein-calculator__weight' id='activity-level' name='".esc_attr($this->option_name_protein)."[activity_level][" . esc_attr($activity_level) ."][m_".esc_html($activity_level)."_lbs]' type='number' step='.001' value='" . esc_attr($activity_level_value_lbs) . "' /> <span>g/lb</span>
                    <input style='width: 100px' class='".esc_attr($class)." protein-calculator__metric-input' class='protein-calculator__weight' id='activity-level' name='".esc_attr($this->option_name_protein)."[activity_level][" . esc_attr($activity_level) ."][m_".esc_html($activity_level)."_kg]' type='number' step='.001' value='" . esc_attr($activity_level_value_kg) . "' /> <span>g/kg</span>
                    <!-- add the high value here -->
                    <input style='width: 100px' class='".esc_attr($class)." protein-calculator__imperial-input' class='protein-calculator__weight' id='activity-level' name='".esc_attr($this->option_name_protein)."[activity_level][" . esc_attr($activity_level) ."][m_".esc_html($activity_level)."_high_lbs]' type='number' step='.001' value='" . esc_attr($activity_level_value_high_lbs) . "' /> <span>g/lb (high)</span>
                    <input style='width: 100px' class='".esc_attr($class)." protein-calculator__metric-input' class='protein-calculator__weight' id='activity-level' name='".esc_attr($this->option_name_protein)."[activity_level][" . esc_attr($activity_level) ."][m_".esc_html($activity_level)."_high_kg]' type='number' step='.001' value='" . esc_attr($activity_level_value_high_kg) . "' /> <span>g/kg (high)</span>
                    
                    <div class='protein-calculator__multi-wrapper'>
                    ";
                    
                    TwwcView::render('admin-settings-goals', get_defined_vars(), 'templates/admin/settings');

                    echo "
                    </div>
                </div>
            </div>
            ";
        }
    }

    public function convert_multiplier_to_lbs_value($multiplier): mixed {
        if(!$multiplier) {
            return '';
        }

        // Convert grams per kg to grams per pound
        return round($multiplier * 0.453592, 2);
    }

    public function convert_multiplier_to_kg_value($multiplier): mixed {
        if(!$multiplier) {
            return '';
        }

        // Convert grams per pound to grams per kg
        return round($multiplier / 0.453592, 2);
    } 

    public function set_protein_settings_input(array $settings = []): void {
        $this->protein_settings_input = $settings;
    }

    public function get_protein_settings_input(): array {
        return $this->protein_settings_input;
    }

    public function get_protein_settings(): array {
        return $this->protein_settings && is_array($this->protein_settings) ? $this->protein_settings : [];
    }

    public static function get_settings_page(): string {
        return self::COMMON_SETTINGS_PAGE;
    }

    public static function get_tab_two(): string {
        return self::PROTEIN_CALCULATOR_SETTINGS_PAGE;
    }
}
